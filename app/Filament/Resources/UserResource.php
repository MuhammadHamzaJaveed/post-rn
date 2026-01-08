<?php

namespace App\Filament\Resources;

use App\Models\College;
use App\Models\CollegePreference;
use Filament\Facades\Filament;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Facades\Password;
use PDF;
use App\Models\User;
use App\Models\District;
use Filament\Tables;
use App\Enums\Status\Status;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Livewire\WithFileUploads;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Blade;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\EditUser;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Database\Eloquent\Collection;

class UserResource extends Resource
{
    use WithFileUploads;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function approveDisable($record)
    {
        if ($record->status === Status::APPROVED) {
            $record->update(['status' => Status::REJECTED]);
        } else {
            $record->update(['status' => Status::APPROVED]);
        }
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->columnSpan([
                            'sm' => 2,
                            'xl' => 3,
                            '2xl' => 4,
                            ])
                        ->disabled(function ($state) {
                            return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                        })
                        ->maxLength(255),

                    TextInput::make('father_name')
                        ->disabled(function ($state) {
                            return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                        })
                        ->maxLength(255),

                    TextInput::make('email')
                        ->label('Email Address')
                        ->email()
                        ->disabled(function ($state) {
                            return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                        })
                        ->maxLength(255),

                    TextInput::make('mobile_number')
                        ->label('Local Mobile Number')
                        ->disabled(function ($state) {
                            return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                        })
                        ->maxLength(255),

                    TextInput::make('challan_id')
                        ->disabled(function ($state) {
                            return auth()->user()->hasRole(config('role_names.roles.verification-team'))
                                || auth()->user()->hasRole(config('role_names.roles.supervisory-team'));
                        })
                        ->maxLength(255),

                    TextInput::make('aggregate')
                        ->label('Aggregate')
                        ->hidden(fn ($state) => $state == null)
                        ->visible(fn ($state) => auth()->user()->email != 'adminImageUpload@uhs.com')
                        ->disabled(function ($state) {
                            return auth()->user()->hasRole(config('role_names.roles.verification-team'))
                                || auth()->user()->hasRole(config('role_names.roles.supervisory-team'));
                        })
                        ->maxLength(255),

                    TextInput::make('aggregate_overseas')
                        ->label('Overseas Aggregate')
                        ->visible(fn ($state) => auth()->user()->email != 'adminImageUpload@uhs.com')
                        ->hidden(fn ($state) => $state == 0.0000)
                        ->disabled(function ($state) {
                            return auth()->user()->hasRole(config('role_names.roles.verification-team'))
                                || auth()->user()->hasRole(config('role_names.roles.supervisory-team'));
                        })
                        ->maxLength(255),

                    TextInput::make('transaction_id')
                        ->label('Transaction ID')
                        ->disabled(function ($state) {
                            return auth()->user()->hasRole(config('role_names.roles.verification-team'))
                                || auth()->user()->hasRole(config('role_names.roles.supervisory-team'));
                        })
                        ->maxLength(255),

                    /*TextInput::make('password')->password()->required(function (Page $livewire) {
                        return $livewire instanceof CreateRecord;
                    })
                        ->minLength(8)
                        ->same('passwordConfirmation')
                        ->dehydrated(fn($state)=>filled($state))
                        ->dehydrateStateUsing(fn($state)=>Hash::make($state)),

                    TextInput::make('passwordConfirmation')->password()->label('Password Confirmation')->required(function (Page $livewire) {
                        return $livewire instanceof CreateRecord;
                    })->minLength(8)->dehydrated('false')*/
                ]),

                Card::make()
                    ->relationship('personalDetails')
                    ->schema([
                        Placeholder::make('')

                            ->label(new HtmlString(
                                "<span class='text-xl font-semibold'>Personal Details</span>"
                            )),

                        Grid::make()
                            ->schema([
                                TextInput::make('mother_name')
                                    ->label('Mother Name')
                                    ->visible(fn ($state) => auth()->user()->email != 'adminImageUpload@uhs.com')
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'))
                                            || auth()->user()->hasRole(config('role_names.roles.supervisory-team'));
                                    }),

                                TextInput::make('date_of_birth')
                                    ->label('Date Of Birth')
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('cnic_passport')
                                    ->label('CNIC/PASSPORT/POC/NICOP ')
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),
                            ]),

                        Grid::make()
                            ->columns(1),
                        Select::make('district_id')
                            ->label(new HtmlString("<span class='sm:text-lg'>Edit District</span>"))
                            ->options(District::all()->pluck('name', 'id'))
                            ->preload()
                            ->disabled(function ($state) {
                                return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                            }),

                        //                        Grid::make()
                        //                            ->relationship('nationality')
                        //
                        //                            ->schema([
                        //                                TextInput::make('name')
                        //                                    ->dehydrated(false)
                        //                                    ->label('Nationality')
                        //                                    ->disabled(),
                        //                            ]),
                    ]),

                Card::make()
                ->schema([
                Grid::make()
                    ->schema([
                        // ViewField::make('id')
                            // ->view('filament::components.programSeatsCategory')
                            /*Select::make('program_id')
                                ->relationship('program','name')
                                ->preload()
                                ->label('Programs')
                                ->visible(fn ($state) => auth()->user()->hasRole(config('role_names.roles.super_admin')) || auth()->user()->hasRole(config('role_names.roles.admin')) || auth()->user()->hasRole(config('role_names.roles.incharge-team'))),*/

                            /*Select::make('program_priority')
                            ->options([
                                '1' => 'MBBS',
                                '2' => 'BDS',
                            ])
                            ->label('Programs Priority')
                            ->visible(fn ($state) => auth()->user()->hasRole(config('role_names.roles.super_admin')) || auth()->user()->hasRole(config('role_names.roles.admin')) || auth()->user()->hasRole(config('role_names.roles.incharge-team'))),*/

                            /*Select::make('foreigner')
                            ->options([
                                '1' => 'Yes',
                                '0' => 'No',
                            ])*/
                            Select::make('seat_id')
                            ->options(\App\Models\Seat::all()->pluck('name', 'id'))
                            ->label('Seat Category')
                            ->visible(fn ($state) => auth()->user()->hasRole(config('role_names.roles.super_admin')) || auth()->user()->hasRole(config('role_names.roles.admin'))),
                    
                    ])
                    ->columns(1),
                            ]),

                Card::make()
                    ->relationship('qualifications')
                    ->visible(fn ($state) => auth()->user()->hasRole(config('role_names.roles.super_admin')) || auth()->user()->hasRole(config('role_names.roles.admin'))
                        || auth()->user()->hasRole(config('role_names.roles.supervisory-team'))
                        || auth()->user()->hasRole(config('role_names.roles.verification-team')))
                    ->schema([
                        Placeholder::make('')
                            ->label(new HtmlString(
                                "<span class='text-xl font-semibold'>Qualifications</span>"
                            )),

                        Grid::make()
                            ->schema([
                                TextInput::make('ssc_marks_obtained')
                                    ->label('SSC Obtained Marks')
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('ssc_total_marks')
                                    ->label('SSC Total Marks')
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('ssc_passing_year')
                                    ->label('SSC Passing Year')
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('hssc_marks_obtained')
                                    ->label('HSSC Obtained Marks')
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('hssc_total_marks')
                                    ->label('HSSC Total Marks')
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('hssc_passing_year')
                                    ->label('HSSC Passing Year')
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),
                            ]),
                    ]),

                Card::make()
                    ->relationship('admissionTest')
                    ->visible(fn ($state) => auth()->user()->hasRole(config('role_names.roles.super_admin')) || auth()->user()->hasRole(config('role_names.roles.admin'))
                        || auth()->user()->hasRole(config('role_names.roles.supervisory-team'))
                        || auth()->user()->hasRole(config('role_names.roles.verification-team')))
                    ->schema([
                        Placeholder::make('')
                            ->label(new HtmlString(
                                "<span class='text-xl font-semibold'>Admission Test Information</span>"
                            )),

                        Grid::make()
                            ->schema([
                                TextInput::make('md_cat_cnic')
                                    ->label('MDCAT Roll No')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('md_cat_obtained_marks')
                                    ->label('MDCAT Obtained Marks (Out Of 200)')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('ucat_candidate_id')
                                    ->label('UCAT Candidate ID ')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('ucat_test_date')
                                    ->label('UCAT Test Date ')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('ucat_band')
                                    ->label('UCAT Band ')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('ucat_obtained_marks')
                                    ->label('UCAT Obtained Marks')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('mcat_username')
                                    ->label('MCAT Username')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('mcat_password')
                                    ->label('MCAT Password')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('mcat_obtained_marks')
                                    ->label('MCAT Obtained Marks')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('sat_biology_obtained_marks')
                                    ->label('SAT (II) Biology Obtained Marks')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('sat_chemistry_obtained_marks')
                                    ->label('SAT (II) Chemistry Obtained Marks')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('sat_phy_math_obtained_marks')
                                    ->label('SAT (II) Physics/Maths Obtained Marks')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('sat_username')
                                    ->label('SAT Username')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),

                                TextInput::make('sat_password')
                                    ->label('SAT Password')
                                    ->hidden(fn ($state) => $state == null)
                                    ->disabled(function ($state) {
                                        return auth()->user()->hasRole(config('role_names.roles.verification-team'));
                                    }),
                            ]),
                    ]),
                //                Grid::make()
                //                    ->schema([
                //                        ViewField::make('id')
                //                            ->view('filament::components.uniPref')
                //                    ])
                //                    ->columns(1),

                Grid::make()
                    ->schema([
                        ViewField::make('id')
                            ->view('filament::components.files')
                    ])
                    ->columns(1),

                Grid::make()
                    ->schema([
                        ViewField::make('uploadImage')
                            ->view('filament::components.upload-docs')
                    ])
                    ->columns(1),

                Grid::make()
                    ->schema([
                        ViewField::make('uploadImage2')
                            ->view('filament::components.upload-docs2')
                    ])
                    ->columns(1)
            ]);
    }

    public function whoAllowed(): bool
    {
        return auth()->user()->hasRole(config('role_names.roles.verification-team'))
            || auth()->user()->hasRole(config('role_names.roles.supervisory-team'));
    }

    /**
     * @return bool
     */
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole(config('role_names.roles.super_admin'))
            || auth()->user()->hasRole(config('role_names.roles.admin'))
            || auth()->user()->hasRole(config('role_names.roles.verification-team'))
            || auth()->user()->hasRole(config('role_names.roles.supervisory-team'))
            || auth()->user()->email == 'adminImageUpload@uhs.com';
    }

    /**
     * @param  Model  $record
     * @return bool
     */
    public static function canView(Model $record): bool
    {
        return auth()->user()->hasRole(config('role_names.roles.super_admin'))
            || auth()->user()->hasRole(config('role_names.roles.admin'))
            || auth()->user()->hasRole(config('role_names.roles.verification-team'))
            || auth()->user()->hasRole(config('role_names.roles.supervisory-team'))
            || auth()->user()->email == 'adminDisability@uhs.com'
            || auth()->user()->email == 'adminImageUpload@uhs.com';
    }

    /**
     * @param Model $record
     * @return bool
     */
    public static function canDelete(Model $record): bool
    {
        /*return auth()->user()->hasRole(config('role_names.roles.super_admin'));*/
        return false;
    }

    public static function canDeleteAny(): bool
    {
        /*return auth()->user()->hasRole(config('role_names.roles.super_admin'));*/
        return false;
    }
    /**
     * @return bool
     */
    public static function canViewAny(): bool
    {
        if (auth()->user()->hasRole(config('role_names.roles.college'))) {
            return false;
        }
        return auth()->user()->email != 'adminbig@uhs.com' || auth()->user()->email != 'adminDisability@uhs.com';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable()
                ->hidden(fn() => auth()->user()->email == 'super_admin@uhs.com'),
                Tables\Columns\TextInputColumn::make('email')->sortable()->searchable()
                    ->visible(fn() => auth()->user()->email == 'super_admin@uhs.com'),
                TextColumn::make('cnic_passport')->sortable()->searchable(),
                TextColumn::make('aggregate')->sortable(),
                TextColumn::make('aggregate_overseas')->sortable(),
                IconColumn::make('status')
                    ->label('Status')
                    ->alignCenter()
                    ->options([
                        'heroicon-o-x-circle',
                        'heroicon-o-exclamation-circle' => function ($state): bool {
                            return $state == Status::PENDING;
                        },
                        'heroicon-o-check-circle' => function ($state): bool {
                            return $state == Status::APPROVED;
                        },
                    ])
                    ->colors([
                        'danger',
                        'warning' => function ($state): bool {
                            return $state == Status::PENDING;
                        },
                        'success' => function ($state): bool {
                            return $state == Status::APPROVED;
                        },
                    ]),
                TextColumn::make('comments'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('college')
                    ->label('Colleges')
                    ->options(fn () => College::where('isBds', 0)->pluck('name', 'name'))
                    ->query(function ($query, $state) {
                        if (!empty($state['value'])) {
                            // Only filter when a college is selected
                            $query->whereHas('mbbsCollegePreferences', function ($query) use ($state) {
                                $query->where('college_pref', 'LIKE', '%"name":"'.$state['value'].'"%');
                            });
                        }
                        // No filter applied if state is empty, show all records
                    }),
                TernaryFilter::make('aggregate')
                    ->placeholder('All Records')
                    ->trueLabel('Aggregate (90 to 95.9999)')
                    ->falseLabel('Aggregate (96 to 100)')
                    ->queries(
                        true: fn(Builder $query) => $query->whereBetween('aggregate', [90, 95.9999]),
                        false: fn(Builder $query) => $query->whereBetween('aggregate', [96, 100]),
                    /*blank: fn(Builder $query) => $query->whereBetween('aggregate', [0, 100]),*/
                    ),

                Tables\Filters\SelectFilter::make('seat_id')
                    ->label('Seat Categories')
                    ->options(function () {
                        return \App\Models\Seat::all()->pluck('name', 'id');
                    }),
                Tables\Filters\SelectFilter::make('is_open_merit')
                    ->label('Apply Open Merit on seat (Overseas)')
                    ->options(function () {
                        return [
                            '1' => 'Yes',
                            '0' => 'No',
                        ];
                    }),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Student Status')
                    ->options([
                        Status::APPROVED => 'Approved',
                        Status::PENDING => 'Pending',
                        Status::REJECTED => 'Rejected',
                    ]),
                TernaryFilter::make('is_paid')
                    ->attribute('is_paid')
                    ->label('Challan Paid Status')
                    ->trueLabel('Submitted')
                    ->falseLabel('Not Submitted')
                    ->placeholder('Select Challan Status'),
                TernaryFilter::make('is_completed')
                    ->attribute('is_completed')
                    ->label('Completed Status')
                    ->trueLabel('Complete')
                    ->falseLabel('Not Complete')
                    ->placeholder('Select Application Status'),

                TernaryFilter::make('challan_id')
                    ->attribute('challan_id')
                    ->label('Challan Status')
                    ->trueLabel('Submitted')
                    ->falseLabel('Not Submitted')
                    ->placeholder('Select Challan Status')
                    ->queries(
                        true: fn(Builder $query) => $query->whereNotNull('challan_id'),
                        false:  fn(Builder $query) => $query->whereNull('challan_id'),
                    ),
            ])

            ->headerActions([
                /*ExportAction::make()->exports([
                    ExcelExport::make()
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                        ->withFilename(function (){
                            $time = str_replace('_', ':', date("d-m-Y h.i a"));
                            return 'mbbs_private '.str_replace('_', ':', $time).'.xlsx';
                        })
                        ->withColumns(
                            array_merge(
                                [
                                    Column::make('is_open_merit')->heading('Open Merit for Foreigner')->formatStateUsing(function (Model $record) {
                                        return $record->is_open_merit == 1 ? 'Yes' : 'No';
                                    }),
                                    Column::make('foreigner')->heading('Foreigner')->formatStateUsing(function (Model $record) {
                                        return $record->foreigner == 1 ? 'Yes' : 'No';
                                    }),
                                    Column::make('foreigner')->heading('Open Merit')->formatStateUsing(function (Model $record) {
                                        return $record->foreigner == 0 ? 'Yes' : 'No';
                                    }),
                                    Column::make('program.name')->heading('Program'),
                                    Column::make('personalDetails.gender.name')->heading('Gender'),
                                    Column::make('personalDetails.cnic_passport')
                                        ->heading('CNIC / Passport / B-Form / CRC / POC / NICOP'),
                                    Column::make('personalDetails.nationality.name')->heading('Nationality'),
                                    Column::make('personalDetails.country')->heading('Country'),
                                    Column::make('personalDetails.district.name')->heading('District'),
                                    Column::make('personalDetails.area.name')->heading('Residence Area'),
                                    Column::make('personalDetails.mobile_number')->heading('Phone No'),
                                    Column::make('qualifications.ssc_roll_no')->heading('SSC Roll No'),
                                    Column::make('qualifications.ssc_marks_obtained')->heading('SSC Obtained Marks'),
                                    Column::make('qualifications.ssc_total_marks')->heading('SSC Total Marks'),
                                    Column::make('qualifications.hssc_roll_no')->heading('HSSC Roll No'),
                                    Column::make('qualifications.hssc_marks_obtained')->heading('HSSC Obtained Marks'),
                                    Column::make('qualifications.hssc_total_marks')->heading('HSSC Total Marks')
                                ],
                                self::getPreferences()
                            )
                        )
                        ->fromTable(),

                ])*/
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('pdf')
                    ->label('Pdf')
                    ->color('success')
                    ->icon('heroicon-s-download')
                    ->action(function (Model $record) {
                        ini_set('max_execution_time', 36000);
                        return response()->streamDownload(function () use ($record) {
                            echo Pdf::loadHtml(
                                Blade::render('vendor.filament.components.pdf', ['record' => $record])
                            )->stream();
                        }, $record->id . '.pdf');
                    }),
                Tables\Actions\Action::make('approve_action')
                    ->label(function (Model $record) {
                        // Check the user's status and set the button label accordingly
                        if ($record->status == 1) {
                            return 'Disapprove';
                        } else {
                            return 'Approve';
                        }
                    })
                    ->color('success')
                    ->icon('heroicon-s-check')
                    ->hidden(fn () => auth()->user()->email !== 'adminDisability@uhs.com')
                    ->action(function (Model $record) {
                        self::approveDisable($record);
                    }),

                Tables\Actions\Action::make('send_forgot_email')
                    ->label('Send Forgot Email')
                    ->color(function (){
                        //i want to pass custom color just like
                        return 'danger';
                    })
                    ->icon('heroicon-o-mail')
                    ->visible(auth()->user()->hasRole(config('role_names.roles.super_admin')))
                    ->requiresConfirmation()
                    ->action(function (Model $record) {
                        Password::sendResetLink(
                            $record->only('email')
                        );
                        Filament::notify('success', 'Password reset link sent to the user email: ' . $record->email . '.');
                    }),
                Tables\Actions\Action::make('send_registration_email')
                    ->visible(auth()->user()->hasRole(config('role_names.roles.super_admin')))
                    ->label('Send registration verification Email')
                    ->color('warning')
                    ->icon('heroicon-s-mail')
                    ->requiresConfirmation()
                    ->action(function (Model $record) {
                        $record->sendEmailVerificationNotification();
                        Filament::notify('success', 'Verification email sent to the user email: ' . $record->email . '.');
                    }),
            ]);
    }

    /**
     * @return Builder
     */
    public static function getEloquentQuery(): Builder
    {

        if (auth()->user()->email === 'adminDisability@uhs.com') {
            return parent::getEloquentQuery()->with('seatCategories')
                ->whereRelation('seatCategories', 'seat_category_id', '=', 2)
                ->where('transaction_id', '!=', 'null');
        }

        if (auth()->user()->email === 'adminImageUpload@uhs.com') {
            return parent::getEloquentQuery()
                ->where('transaction_id', '!=', null);
        }

        if (auth()->user()->hasRole('Super_Admin')) {
            return parent::getEloquentQuery()
                ->where('id', '!=', auth()->user()->id)
                ->where(function ($query) {
                    $query->doesntHave('roles', 'or', function ($subQuery) {
                        $subQuery->where('name', 'Verification_Team')
                            ->orWhere('name', 'Supervisory_Team')
                            ->orWhere('name', 'Admin')
                            ->orWhere('name', 'College')
                            ->orWhere('name', 'Incharge_Team');
                    });
                });
        }

        if (auth()->user()->hasRole('Admin')) {
            return parent::getEloquentQuery()
                ->where('id', '!=', auth()->user()->id)
                ->where(function ($query) {
                    $query->doesntHave('roles', 'or', function ($subQuery) {
                        $subQuery->where('name', 'Verification_Team')
                            ->orWhere('name', 'Supervisory_Team')
                            ->orWhere('name', 'College')
                            ->orWhere('name', 'Super_Admin')
                            ->orWhere('name', 'Incharge_Team');
                    });
                });
        }

        if (auth()->user()->hasRole('College')) {
            return parent::getEloquentQuery()
                ->where('id', '!=', auth()->user()->id)
                ->where(function ($query) {
                    $query->doesntHave('roles', 'or', function ($subQuery) {
                        $subQuery->where('name', 'Verification_Team')
                            ->orWhere('name', 'Supervisory_Team')
                            ->orWhere('name', 'Super_Admin')
                            ->orWhere('name', 'Admin')
                            ->orWhere('name', 'Incharge_Team')
                            ->orWhere('name', 'College');
                    });
                });
        }

        if (auth()->user()->hasRole('Verification_Team')) {
            return parent::getEloquentQuery()
                ->where('id', '!=', auth()->user()->id)
                ->where(function ($query) {
                    $query->doesntHave('roles', 'or', function ($subQuery) {
                        $subQuery->where('name', 'Admin')
                            ->orWhere('name', 'Supervisory_Team')
                            ->orWhere('name', 'Verification_Team')
                            ->orWhere('name', 'Super_Admin')
                            ->orWhere('name', 'College')
                            ->orWhere('name', 'Incharge_Team');
                    });
                });
        }

        if (auth()->user()->hasRole('Supervisory_Team')) {
            return parent::getEloquentQuery()
                ->where('id', '!=', auth()->user()->id)
                ->where(function ($query) {
                    $query->doesntHave('roles', 'or', function ($subQuery) {
                        $subQuery->where('name', 'Admin')
                            ->orWhere('name', 'Super_Admin')
                            ->orWhere('name', 'Verification_Team')
                            ->orWhere('name', 'College')
                            ->orWhere('name', 'Supervisory_Team')
                            ->orWhere('name', 'Incharge_Team');
                    });
                });
        }

        if (auth()->user()->hasRole('Incharge_Team')) {
            return parent::getEloquentQuery()
                ->where('id', '!=', auth()->user()->id)
                ->where(function ($query) {
                    $query->doesntHave('roles', 'or', function ($subQuery) {
                        $subQuery->where('name', 'Admin')
                            ->orWhere('name', 'Super_Admin')
                            ->orWhere('name', 'College')
                            ->orWhere('name', 'Verification_Team')
                            ->orWhere('name', 'Supervisory_Team');
                    });
                });
        }
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    private static function getPreferences(): array
    {

        $preferences = [];

        for ($i = 0; $i < 32; $i++) {
            $preferences[] =
                Column::make("Pref ${i}")
                    ->heading("Preference " . ($i + 1))
                    ->formatStateUsing(function (Model $record, $livewire) use ($i) {
                        $seatId = collect($livewire->getTableFilterState('seat_id'))->first();
                        $isOpenMerit = collect($livewire->getTableFilterState('is_open_merit'))->first();
                        if ($seatId == 3 && $isOpenMerit == 1) {
                            $state = $record->mbbsCollegeForeignerAsOpenMeritPreferences
                                ->where('is_foreigner', 1)
                                ->pluck('college_pref')
                                ->first();
                        }
                        elseif ($seatId == 3 && is_null($isOpenMerit))
                        {
                            $state = $record->mbbsCollegePreferences
                                ->where('is_foreigner', 1)
                                ->pluck('college_pref')
                                ->first();

                        }

                        else {
                            $state = $record->mbbsCollegePreferences->pluck('college_pref')->first();
                        }
                        $college = json_decode($state,true);
                        return isset($college[$i]) ? $college[$i]['name'] : 'N/A';
                    });
        }
        return $preferences;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view'   => Pages\ViewUser::route('/{record}'),
        ];
    }
}