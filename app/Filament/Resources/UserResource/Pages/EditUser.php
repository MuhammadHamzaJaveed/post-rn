<?php

namespace App\Filament\Resources\UserResource\Pages;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Enums\Status\Status;
use App\Helpers\MediaHelper;
use Livewire\WithFileUploads;
use Filament\Pages\Actions\Action;
use Spatie\Activitylog\Models\Activity;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Services\UserServices\UserServices;
use App\Services\MediaServices\MediaServices;

class EditUser extends EditRecord
{
    use WithFileUploads;

    public $cnic;

    public $image;

    protected $userServices;

    protected $mediaServices;

    /**
     * @param  UserServices  $userServices
     * @param  MediaServices $mediaServices
     * @return void
     */
    public function boot(UserServices $userServices, MediaServices $mediaServices): void
    {
        $this->userServices = $userServices;
        $this->mediaServices = $mediaServices;
    }

    public function mount($record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();

        if ($this->record->userChallanImage) {
            $this->cnic = MediaHelper::GetImageUrl($this->record->userChallanImage->path);

        }

        if ($this->record->image) {
            $this->image = MediaHelper::GetImageUrl($this->record->image->path);
        }
    }

    /**
     * @param  array  $data
     * @return array
     */
    public function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['uploadImage'])) {
            $image = $data['uploadImage'];

            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => $this->record->userChallanImage?->id
            ], $this->formatImageData($image, 'userChallanImage'));
        }

        if (isset($data['uploadImage2'])) {
            $image2 = $data['uploadImage2'];

            $this->mediaServices->updateOrCreateUserProfileImage([
                'id' => $this->record->image?->id
            ], $this->formatImageData2($image2));
        }
        return $data;
    }

    /**
     * @param $image
     * @param $collection
     * @return array
     */
    private function formatImageData($image, $collection): array
    {

        return [
            'imageName'  => time(). '_' .Str::random(8) . '.' . $image->extension(),
            /*'imagePath'  => 'NFS-UHS/'.$image->storeAs(strtolower($this->record->name) . '_' . $this->record->id . '_images', $image->getClientOriginalName(), 'public'),*/
            'imagePath'  => $image->storeAs(strtolower($this->record->name) . '_' . $this->record->id . '_images', $image->getClientOriginalName(), 'public'),
            'imageSize'  => $image->getSize(),
            'userId'     => $this->record->id,
            'model'      => User::class,
            'disk'       => 'public',
            'collection' => $collection,
        ];
    }

    private function formatImageData2($image2): array
    {
        return [
            'imageName'  => time() . '_' . Str::random(8) . '.' . $image2->extension(),
            /*'imagePath'  => 'NFS-UHS/'.$image2->store($this->record->id . '_images', 'public'),*/
            'imagePath'  => $image2->store($this->record->id . '_images', 'public'),
            'imageSize'  => $image2->getSize(),
            'userId'     => $this->record->id,
            'model'      => User::class,
            'disk'       => 'public',
            'collection' => 'avatar',
        ];
    }

    public function messages(): array
    {
        return [
            'cnic.max' => 'Please upload an image smaller than 1MB.',
        ];
    }

    protected static string $resource = UserResource::class;

    /**
     * @return Action
     *
     * @throws Exception
     */
    protected function getApproveButtonAction(): Action
    {
        return Action::make('Approve Status')
            ->label('Approve Student')
            ->action(function (array $data) {
                $this->approveStudent($data);
            })->form([
                TextInput::make('reason')
                    ->maxValue(200)
                    ->required()
                    ->label('Please provide comments for approval'),
            ]);
    }

    /**
     * @return Action
     *
     * @throws Exception
     */
    protected function getPendingFormAction(): Action
    {
        return Action::make('Pending State User')
            ->label('Pending Student')
            ->color('warning')
            ->action(function (array $data) {
                $this->changeUserStateToPending($data);
            })->form([
                TextInput::make('reason')
                    ->maxValue(200)
                    ->required()
                    ->label('Please provide reason'),
            ]);
    }

    /**
     * @return void
     */
    protected function approveStudent($data): void
    {
        $this->userServices->updateUser([
            'comments' => $data['reason'],
            'status' => Status::APPROVED,
            'verification_user_status' => Status::APPROVED,
        ], $this->record->id);

        // activity()
        //     ->performedOn($this->record)
        //     ->causedBy(auth()->user())
        //     ->event('Approved User')
        //     ->log('Applicant: '.$this->record->name.' has been approved successfully by: '.auth()->user()->id.'('.auth()->user()->name.') with the following reason:'. $data['reason'])
        // ;

        $this->sendNotification(
            'User has been Approved Successfully',
            'success'
        );

        $this->redirect($this->getResource()::getUrl('index'));
    }

    /**
     * @param $title
     * @param $notificationType
     * @return void
     */
    private function sendNotification($title, $notificationType): void
    {
        Notification::make()
            ->title($title)
            ->{$notificationType}()
            ->send();
    }

    /**
     * @param $data
     * @return void
     */
    private function disApproveUser($data): void
    {
        $this->userServices->updateUser([
            'comments' => $data['reason'],
            'status' => Status::REJECTED,
            'verification_user_status' => Status::APPROVED,
        ], $this->record->id);

        // activity()
        //     ->performedOn($this->record)
        //     ->causedBy(auth()->user())
        //     ->event('Reject User')
        //     ->log('Applicant: '.$this->record->name.' has been rejected  by: '.auth()->user()->id.'('.auth()->user()->name.') with the following reason: '. $data['reason']);

        $this->sendNotification(
            'User has been Rejected Successfully',
            'success'
        );

        $this->redirect($this->getResource()::getUrl('index'));
    }

    /**
     * @param $data
     * @return void
     */
    private function changeUserStateToPending($data): void
    {
        $this->userServices->updateUser([
            'comments' => $data['reason'],
            'status' => Status::PENDING,
            'verification_user_status' => Status::APPROVED,
        ], $this->record->id);

        // activity()
        //     ->performedOn($this->record)
        //     ->causedBy(auth()->user())
        //     ->event('Changed User status to pending')
        //     ->log('Applicant: '.$this->record->name.' has been put to pending state  by: '.auth()->user()->id.'('.auth()->user()->name.') with the following reason: '. $data['reason']);

        $this->sendNotification(
            'User Status has been changed to pending successfully',
            'success'
        );

        $this->redirect($this->getResource()::getUrl('index'));
    }

    /**
     * @return Action
     *
     * @throws Exception
     */
    protected function getLockedFormAction(): Action
    {
        return Action::make('Reject Student')
            ->label('Reject Student')
            ->color('danger')
            ->action(function (array $data) {
                $this->disApproveUser($data);
            })->form([
                TextInput::make('reason')
                    ->maxValue(200)
                    ->required()
                    ->label('Please provide reason'),
            ]);
    }

    /**
     * @return Action
     *
     * @throws Exception
     */
    protected function calculateAggregateAction(): Action
    {
        return Action::make('calculate aggregate')
            ->label('Calculate Aggregate')
            ->action(function (array $data) {
                $this->calculatePrivatePortalAggregate($data);

            });
    }

    private function calculatePrivatePortalAggregate($data)
    {
        $qualifications = $this->record->qualifications;
        $admissionTest = $this->record->admissionTest;

        $sscObtainedMarks = $qualifications->ssc_marks_obtained;
        $hsscObtainedMarks = $qualifications->hssc_marks_obtained;

        $mCatObtainedMarks = $admissionTest->mcat_obtained_marks;
        $mdCatObtainedMarks = $admissionTest->md_cat_obtained_marks;
        $uCatObtainedMarks = $admissionTest->ucat_obtained_marks;
        $satObtainedMarks = ($admissionTest->sat_biology_obtained_marks * 0.40) +
            ($admissionTest->sat_chemistry_obtained_marks * 0.35) +
            ($admissionTest->sat_phy_math_obtained_marks * 0.25);

        $programId = $this->record->program_id;

        if (
            ($sscObtainedMarks && $hsscObtainedMarks) &&
            ($mdCatObtainedMarks || $uCatObtainedMarks || $satObtainedMarks || $mCatObtainedMarks)
        ) {
            $averageTotal = 1100;
            $ssc =  $sscObtainedMarks / $qualifications->ssc_total_marks * $averageTotal * 0.10;
            $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;

            $aggregation = [];


            if ($mdCatObtainedMarks) {
                    $mdCat = $mdCatObtainedMarks / 200 * $averageTotal * 0.50;

                    $aggregation['mdCat'] = ($ssc + $hssc + $mdCat) / $averageTotal * 100 ;
            }

            if ($uCatObtainedMarks) {
                $uCat = $uCatObtainedMarks / 3600 * $averageTotal * 0.50;

                $aggregation['uCat'] = ($ssc + $hssc + $uCat) / $averageTotal * 100 ;
            }

            if ($satObtainedMarks) {
                $sat2 = $satObtainedMarks / 800 * $averageTotal * 0.50;

                $aggregation['sat2'] = ($ssc + $hssc + $sat2) / $averageTotal * 100 ;
            }

            if ($mCatObtainedMarks) {
                $mCat = $mCatObtainedMarks / 528 * $averageTotal * 0.50;

                $aggregation['mCat'] = ($ssc + $hssc + $mCat) / $averageTotal * 100;
            }

            $maxAggregate = max($aggregation);

            $this->userServices->updateUser(['aggregate'=>$maxAggregate],$this->record->id);
            $this->sendNotification(
                'SAT/International Test Aggregate has been calculated sucessfully.',
                'success'
            );

            $this->redirect($this->getResource()::getUrl('index'));
        }

        if (
            ($sscObtainedMarks && $hsscObtainedMarks) &&
            ($uCatObtainedMarks || $satObtainedMarks || $mCatObtainedMarks)
        ) {
            $averageTotal = 1100;
            $ssc =  $sscObtainedMarks / $qualifications->ssc_total_marks * $averageTotal * 0.10;
            $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;

            $aggregation = [];


           

            if ($uCatObtainedMarks) {
                $uCat = $uCatObtainedMarks / 3600 * $averageTotal * 0.50;

                $aggregation['uCat'] = ($ssc + $hssc + $uCat) / $averageTotal * 100 ;
            }

            if ($satObtainedMarks) {
                $sat2 = $satObtainedMarks / 800 * $averageTotal * 0.50;

                $aggregation['sat2'] = ($ssc + $hssc + $sat2) / $averageTotal * 100 ;
            }

            if ($mCatObtainedMarks) {
                $mCat = $mCatObtainedMarks / 528 * $averageTotal * 0.50;

                $aggregation['mCat'] = ($ssc + $hssc + $mCat) / $averageTotal * 100;
            }

            $maxAggregate = max($aggregation);

            $this->userServices->updateUser(['aggregate_overseas'=>$maxAggregate],$this->record->id);
            $this->sendNotification(
                'SAT/International Test Aggregate has been calculated sucessfully.',
                'success'
            );

            $this->redirect($this->getResource()::getUrl('index'));
        }
    }

    protected function getSaveFormAction(): Action
    {
        // activity()
        //     ->performedOn($this->record)
        //     ->causedBy(auth()->user())
        //     ->event('Changed User status to pending')
        //     ->log('Applicant: '.$this->record->name.' data has been changed by '.auth()->user()->id.'('.auth()->user()->name.')');

        return Action::make('save')
            ->label(__('filament::resources/pages/edit-record.form.actions.save.label'))
            ->submit('save')
            ->keyBindings(['mod+s']);
    }

    /**
     * @return array
     *
     * @throws Exception
     */
    protected function getFormActions(): array
    {
        $formActions = [];

        if (auth()->user()->hasRole(config('role_names.roles.super_admin')) || auth()->user()->hasRole(config('role_names.roles.admin')) || auth()->user()->hasRole(config('role_names.roles.supervisory-team'))) {
            $formActions [] = $this->getSaveFormAction();
        }

        $formActions[] = $this->getApproveButtonAction();
        $formActions[] = $this->calculateAggregateAction();

        if (
            auth()->user()->hasRole(config('role_names.roles.supervisory-team')) ||
            auth()->user()->hasRole(config('role_names.roles.super_admin')) ||
            auth()->user()->hasRole(config('role_names.roles.admin')) ||
            auth()->user()->hasRole(config('role_names.roles.verification-team'))
            || auth()->user()->hasRole(config('role_names.roles.incharge-team'))
        ) {
            $formActions[] = $this->getPendingFormAction();
        }

        if (auth()->user()->hasRole(config('role_names.roles.incharge-team')) || auth()->user()->hasRole(config('role_names.roles.super_admin')) || auth()->user()->hasRole(config('role_names.roles.admin')))  {
            $formActions[] = $this->getLockedFormAction();
        }

        $formActions[] = $this->getCancelFormAction();

        return $formActions;
    }
}

