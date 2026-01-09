<?php

namespace App\Http\Livewire\UhsForms\Steps;

use App\Models\Seat;
use App\Models\SeatCategory;
use App\Models\Discipline;
use App\Models\User;
use App\Services\UserServices\UserServices;
use Livewire\Component;
use App\Models\UserApplicationEdit;
use Carbon\Carbon;

class Programs extends Component
{
    protected $userServices;

    public $program;

    public $affirmation = 0;

    public $program_priority = 1;


    public $seatCategories = [1];

    public $agreed;

    public $foreigner = 0;

    public $isOpenMerit = false;

    public $seatCategory;

    public $disciplineId;


    /**
     * @return array
     */
    protected function rules(): array
    {
         $rules = [
            // 'program'        => 'required',
           'agreed'         => 'required|accepted',
             'seatCategory'      => 'required',
//            'disciplineId' => 'required'
        ];

        /*if ($this->program == 3) {
            $rules['affirmation'] = 'required|accepted';
        }*/

        return $rules;
    }

    /**
     * Summary of boot
     * @param UserServices $userServices
     * @return void
     */
    public function boot(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

     public function getAllDisciplinesProperty()
    {
        if($this->seatCategory == '1')
        {
          return  Discipline::where('seat_id',1)->get()->toArray();
        }
     
        return Discipline::all()->toArray();
    }

    public function mount()
    {
        $user = auth()?->user();

//        if($user?->program){
//            $this->program = $user?->program?->id;
//        }else{
//            $this->program = 2;
//        }
        $this->affirmation = $user?->affirmation === 1 ? true : false;
//        $this->program_priority = $user?->program_priority ?? 2;
//        $this->foreigner = $user?->foreigner;
//        $this->isOpenMerit = $user?->is_open_merit;
        $this->seatCategory = $user?->seat_id;
//        $this->disciplineId = $user->discipline_id;


    }
    public function updateCheckboxes()
    {
        // Check if the checkbox with ID 1 is unchecked

        if (!in_array(1, $this->seatCategories)) {

            // If it is unchecked, uncheck the checkbox with ID 6 if it's checked
            $key = array_search(6, $this->seatCategories);
            if ($key !== false) {
                unset($this->seatCategories[$key]);
            }
        }


        $this->seatCategories = array_values($this->seatCategories);
    }

    /**
     * Summary of getAllUsersProperty
     * @return mixed
     */
    public function getAllProgramsProperty()
    {
        return $this->userServices->getAllPrograms();
    }


    /**
     * Summary of getAllUsersProperty
     * @return mixed
     */
    public function getAllSeatCategoriesProperty()
    {
        // Check if '1' exists in $this->seatCategories
        if (in_array(1, $this->seatCategories)) {
            // '1' exists, return all seat categories
            return $this->userServices->getAllSeatCategories();
        } else {
            // '1' doesn't exist, filter '6' from seat categories
            return collect($this->userServices->getAllSeatCategories())->filter(function ($category) {
                return $category->id != 6;
            })->toArray();
        }

    }

    public function getAllSeatsProperty()
    {
        return Seat::all();
    }

    public function submit()
    {
        $this->validate();
        if ($this->seatCategory != auth()?->user()?->seat_id) {
            $this->handlePreferencesDelete();
        }

        // Update the user's program and priority
        auth()->user()->update([
//            'program_id'       => $this->program,
//            'program_priority' => $this->program_priority,
                'seat_id' => $this->seatCategory,
//            'discipline_id' => $this->disciplineId,
            /*'foreigner'        => $this->foreigner,
            'is_open_merit' => $this->isOpenMerit,*/
        ]);

        UserApplicationEdit::create([
            'user_id' => auth()->user()->id,
            'action' => 'seat_categories_update',
            'time' => Carbon::now(),
        ]);

        if ($this->program_priority == 1 || $this->program_priority == 2) {
            auth()->user()->update(['program_priority' => $this->program_priority]);
        }

        if ($this->program == 1) {
            auth()->user()->update(['affirmation' => $this->affirmation]);
        }
        if(auth()->user()->personalDetails)
        {
            if(auth()->user()->personalDetails->showInput >=4 && $this->foreigner == 0 )
            {
                auth()->user()->personalDetails->update([
                    'cnic_passport_id' => null,
                    'cnic_passport' => null,
                ]);
            }
        }
        $this->emit('completeStep', 'step1Completed');
        $this->emit('goToStep', 2);
    }

    private function handlePreferencesDelete(): void
    {

        // Delete BDS College Preferences
        if (!blank(auth()->user()?->morningCollegePreferences)) {
            auth()->user()?->morningCollegePreferences->first()->delete();
        }

        // Delete MBBS College Foreigner as Open Merit Preferences
        if (!blank(auth()?->user()?->eveningCollegePreferences)) {
            auth()?->user()?->eveningCollegePreferences->first()->delete();
        }
    }

    public function togglePriority()
    {
        $this->program_priority = 2;
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.programs', [
            'selectedProgramId' => $this->program
        ]);
    }
}