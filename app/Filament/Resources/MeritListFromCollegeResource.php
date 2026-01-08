<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\MeritListFromCollegeResource\Pages;
use App\Filament\Resources\MeritListFromCollegeResource\RelationManagers;
use App\Helpers\MediaHelper;
use App\Imports\CollegeImport;
use PDF;
use App\Imports\MeritListFromCollegeImport;
use App\Models\MeritListFromCollege;
use App\Models\User;
use App\Services\MediaServices\MediaServices;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Blade;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class MeritListFromCollegeResource extends Resource
{
    protected static ?string $model = MeritListFromCollege::class;
    protected static ?string $navigationLabel = 'College Users';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        $mediaServices = app(MediaServices::class);
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.id')->label('Id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.mobile_number')->label('Phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.father_name')
                    ->label('Father Name')
                    ->searchable(),
                /*Tables\Columns\TextColumn::make('seatCategoryId.name')
                    ->label('Seat'),*/
                Tables\Columns\TextColumn::make('selectionList.name')
                    ->label('Selection List')
                    ->description(function (MeritListFromCollege $record) {
                        if ($record->selectionList->status == 1) {
                            return '<span class="inline-flex items-center px-3 py-1 rounded-md mt-1 text-sm font-medium bg-green-500 text-white">Active</span>';
                        } else {
                            return '<span class="inline-flex items-center px-3 py-1 rounded-md mt-1 text-sm font-medium bg-red-500 text-white">Inactive</span>';
                        }
                    })->html(),
                Tables\Columns\TextColumn::make('college_from')
                    ->label('Previous College')
                    ->formatStateUsing(function (Model $record) {
                        if ($record->college_from == 0) {
                            return 'N/A';
                        }
                        return $record?->collegeFrom?->name;
                    }),
                Tables\Columns\TextColumn::make('college.name')->label('Current College')
                    ->searchable(),
                Tables\Columns\TextColumn::make('')->label('Stay / Upgraded')
                    ->description(function (MeritListFromCollege $record) {
                        if ($record->student_affidavit_path != null) {
                            if ($record->is_stay == 1) {
                                return '<span class="inline-flex items-center px-3 py-1 rounded-md mb-6 text-sm font-medium bg-green-500 text-white">Stay</span>';
                            } else {
                                return '<span class="inline-flex items-center px-3 py-1 rounded-md mb-6 text-sm font-medium bg-blue-500 text-white">Upgraded</span>';
                            }
                        }
                        return '<span class="inline-flex items-center px-3 py-1 rounded-md mb-6 text-sm font-medium bg-gray-500 text-white">Not Selected</span>';
                    })->html()
                /*IconColumn::make('user.admission_is_paid')
                    ->label('Paid')
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle')
                    ->sortable(),*/

            ])
            ->filters([
                //Dropdown filter on seat category and selection list
                SelectFilter::make('selection_list_id')
                    ->label('Selection List')
                    ->relationship('selectionList', 'name'),
                SelectFilter::make('seat_id')
                    ->label('Seat Category')
                    ->relationship('seat', 'name'),
                SelectFilter::make('college_to')
                    ->visible(fn() => auth()->user()->hasRole(config('role_names.roles.admin')))
                    ->label('College List')
                    ->searchable()
                    ->options(
                        function () {
                            return \App\Models\College::where('isBds', 1)->pluck('name', 'id');
                        }
                    ),
                TernaryFilter::make('student_affidavit_path')
                    ->attribute('student_affidavit_path')
                    ->label('Student Affidavit')
                    ->trueLabel('Submit Affidavit')
                    ->falseLabel('Not Submitted')
                    ->placeholder('Select Student Affidavit')
                    ->queries(
                        true: fn(Builder $query) => $query->whereNotNull('student_affidavit_path'),
                        false: fn(Builder $query) => $query->whereNull('student_affidavit_path'),
                    ),
                TernaryFilter::make('college_affidavit_path')
                    ->attribute('college_affidavit_path')
                    ->label('College Affidavit')
                    ->trueLabel('Approved')
                    ->falseLabel('Not Approved')
                    ->placeholder('Select College Affidavit')
                    ->queries(
                        true: fn(Builder $query) => $query->whereNotNull('college_affidavit_path'),
                        false: fn(Builder $query) => $query->whereNull('college_affidavit_path'),
                    ),
                TernaryFilter::make('admission_is_paid')
                    ->label('Challan Paid Status')
                    ->trueLabel('Paid')
                    ->falseLabel('Not Paid')
                    ->placeholder('Select Challan Paid Status')
                    ->queries(
                        true: fn(Builder $query) => $query->whereHas('user', function ($query) {
                            $query->where('admission_is_paid', 1);
                        }),
                        false: fn(Builder $query) => $query->whereHas('user', function ($query) {
                            $query->where('admission_is_paid', 0);
                        }),
                    )->hidden()
            ])
            ->headerActions([
                ExportAction::make()
                    ->exports([
                    ExcelExport::make()
                        ->modifyQueryUsing(function (Builder $record)
                        {
                            $user = auth()->user();
                            return $record->when(
                                $user->hasRole(config('role_names.roles.college')),
                                fn($q) => $q->where('college_to', $user->college_id)
                            );
                        })
                        ->withColumns([
                        Column::make('user.id')->heading('Id'),
                        Column::make('user.name')->heading('Name'),
                        Column::make('user.email')->heading('Email'),
                        Column::make('user.mobile_number')->heading('Phone'),
                        Column::make('user.father_name')->heading('Father Name'),
                        /*Column::make('seatCategoryId.name')->heading('Seat Quota'),*/
                        Column::make('selectionList.name')->heading('Selection List'),
                        Column::make('is_stay')->heading('Stay / Upgraded')
                            ->formatStateUsing(function (Model $record) {
                                if ($record->student_affidavit_path != null) {
                                    if ($record->is_stay == 1) {
                                        return 'Stay';
                                    } else {
                                        return 'Upgraded';
                                    }
                                } else {
                                    return "Not Selected";
                                }

                            }),
                        Column::make('college_from')->heading('Previous College')
                            ->formatStateUsing(function (Model $record) {
                                if ($record->college_from == null) {
                                    return 'N/A';
                                }
                                return $record?->collegeFrom?->name;
                            }),
                        Column::make('college.name')->heading('Upgraded College'),

                        Column::make('student_affidavit_path')->heading('Student Status')
                            ->formatStateUsing(function (Model $record) {
                                if ($record->student_affidavit_path != null) {
                                    return 'Joined';
                                } else {
                                    return 'Not Joining';
                                }
                            }),
                        Column::make('college_affidavit_path')->heading('College Status')
                            ->formatStateUsing(function (Model $record) {
                                if ($record->college_affidavit_path != null) {
                                    return 'Joined';
                                } else {
                                    return 'Not Joining';
                                }
                            }),
                        /*Column::make('user.admission_is_paid')
                            ->heading('Paid User')
                            ->formatStateUsing(function (Model $record) {
                                if ($record->user->admission_is_paid == 1) {
                                    return 'Yes';
                                } else {
                                    return 'No';
                                }
                            }),*/
                    ])
                ])
                    ->visible(fn() => auth()->user()->hasRole(config('role_names.roles.admin'))
                        || auth()->user()->hasRole(config('role_names.roles.college'))
                    )
                    ->button()
                    ->icon('heroicon-o-upload'),

                Tables\Actions\Action::make('import')
                    ->button()
                    ->label('Import')
                    ->icon('heroicon-o-download')
                    ->form([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('selection_list_id')
                                    ->relationship('selectionList', 'name')
                                    ->preload()
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('seat_id')
                                    ->relationship('seat', 'name')
                                    ->preload()
                                    ->required()
                                    ->columnSpan(1),
                            ]),

                        FileUpload::make('import_file')
                            ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->label('Excel File')
                            ->hint('Only Excel files are allowed. Download the sample file.')
                            ->hintIcon('heroicon-o-information-circle')
                            ->hintAction(
                                Action::make('downloadSample')
                                    ->label('Download Sample')
                                    ->url(asset('meritlistimportsample.xlsx'))
                                    ->color('success')
                                    ->icon('heroicon-o-download')
                                    ->openUrlInNewTab()
                            )
                            ->required(),
                    ])->action(function ($data) {
                        $filePath = $data['import_file'];
                        $selectionListId = (int)$data['selection_list_id'];
                        $seatCategoryId = (int)$data['seat_id'];
                        // Import the Excel file
                        Excel::import(new MeritListFromCollegeImport($selectionListId, $seatCategoryId), $filePath);
                        Filament::notify('success', 'File imported successfully!');
                    })
                    ->visible(fn() => auth()->user()->hasRole(config('role_names.roles.super_admin'))),

            ])
            ->actions([
                Tables\Columns\TextColumn::make('')
                    ->label('')
                    ->description(function (MeritListFromCollege $record) {
                        if ($record->student_affidavit_path != null) {
                            return '<span class="inline-flex items-center px-3 py-1 rounded-md mb-6 text-sm font-medium bg-green-500 text-white">Student Joined</span>';
                        } else {
                            return '<span class="inline-flex items-center px-3 py-1 rounded-md mb-6 text-sm font-medium bg-red-500 text-white">Student Not Joined</span>';
                        }
                    })->html(),
                Tables\Columns\TextColumn::make(' ')
                    ->label('')
                    ->description(function (MeritListFromCollege $record) {
                        if ($record->college_affidavit_path != null) {
                            return '<span class="inline-flex items-center px-3 py-1 rounded-md mb-6 text-sm font-medium bg-green-500 text-white">College Approved</span>';
                        } else {
                            return '<span class="inline-flex items-center px-3 py-1 rounded-md mb-6 text-sm font-medium bg-red-500 text-white">College Not Approved</span>';
                        }
                    })->html(),

                /*Tables\Columns\BadgeColumn::make('student_affidavit_path')
                    ->formatStateUsing(function (Model $record) {
                        if ($record->student_affidavit_path == null) {
                            return 'Student Not Joined';
                        }
                        return 'Student Joined';
                    })
                    ->colors(function (Model $record) {
                        return [
                            'secondary' => fn ($state) => $record->student_affidavit_path == null,
                            'success' => fn ($state) => $record->student_affidavit_path != null,
                        ];
                    }),
                Tables\Columns\BadgeColumn::make('college_affidavit_path')
                    ->formatStateUsing(function (Model $record) {
                        if ($record->college_affidavit_path == null) {
                            return 'College Not Approved';
                        }
                        return 'College Approved';
                    })
                    ->colors(function (Model $record) {
                        return [
                            'secondary' => fn ($state) => $record->college_affidavit_path == null,
                            'success' => fn ($state) => $record->college_affidavit_path != null,
                        ];
                    }),*/
                Tables\Actions\Action::make('student_report')
                    ->label('Student Joining Report')
                    ->icon('heroicon-o-photograph')
                    ->color('positive')
                    ->url(function (MeritListFromCollege $record) {
                        return url(MediaHelper::GetImageUrl($record->student_affidavit_path));
                    })
                    ->hidden(function (Model $record) {
                        return $record->student_affidavit_path == null;
                    })
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('college_report')
                    ->label('College Report')
                    ->icon('heroicon-o-photograph')
                    ->color('positive')
                    ->openUrlInNewTab()
                    ->url(function (Model $record) {
                        return route('college.affidavit.download', ['id' => $record->id]);
                    })
                    ->hidden(function (Model $record) {
                        return $record->college_affidavit_path == null;
                    }),
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check')
                    ->requiresConfirmation()
                    ->visible(fn() => auth()->user()->hasRole(config('role_names.roles.college')))
                    ->modalHeading('Upload Student Joining Report')
                    ->modalContent()
                    ->form([
                        Forms\Components\FileUpload::make('college_report')
                            ->acceptedFileTypes(['application/pdf'])
                            ->label('College Joining Report')
                            ->hint('only pdf file allowed.')
                            ->hintIcon('heroicon-o-information-circle')
                            ->required()
                            ->reactive()
                            ->maxSize(1024),
                    ])
                    ->action(function ($data, MeritListFromCollege $record) {
                        $user = User::find($record->user_id);
                        $fileName = $data['college_report'];
                        $filePath = $fileName; // The file path in storage
                        $absolutePath = storage_path('app/public/' . $filePath);
                        /* if (file_exists($absolutePath)) {
                             $uploadedFile = new UploadedFile(
                                 $absolutePath,
                                 $fileName,
                                 'Application/pdf',
                                 null,
                                 true
                             );
                             $uploadedFile->storeAs($user->id . '_images/college_report/', $uploadedFile->getClientOriginalName(), 'public');
                             unlink($absolutePath);
                             $directoryName = $user->id . '_images';
                             $record->college_affidavit_path = $directoryName . '/college_report/' . $uploadedFile->getClientOriginalName();
                             $record->save();
                             Filament::notify('success', 'Student approved successfully!');
                         } else {
                             Filament::notify('danger', 'Something Went Wrong');
                         }*/
                        if (file_exists($absolutePath)) {
                            // Get the original file name
                            $originalFileName = pathinfo($absolutePath, PATHINFO_FILENAME) . '.' . pathinfo($absolutePath, PATHINFO_EXTENSION);

                            // Create the destination directory path
                            $destinationDirectory = $user->id . '_images/college_report/';

                            // Store the file with the original name in the public disk
                            $uploadedFile = new UploadedFile(
                                $absolutePath,
                                $originalFileName,
                                'application/pdf',
                                null,
                                true
                            );
                            $uploadedFile->storeAs($destinationDirectory, $uploadedFile->getClientOriginalName(), 'public');

                            // Remove the temporary file
                            unlink($absolutePath);

                            // Save the relative path in the database
                            $record->college_affidavit_path = $destinationDirectory . $uploadedFile->getClientOriginalName();
                            $record->save();

                            Filament::notify('success', 'Student approved successfully!');
                        } else {
                            Filament::notify('danger', 'Something went wrong. The file could not be found.');
                        }
                    })->hidden(function (Model $record) {
                        return $record->college_affidavit_path != null;
                    }),
                Tables\Actions\Action::make('pdf')
                    ->label('Pdf')
                    ->color('warning')
                    ->icon('heroicon-s-download')
                    ->action(function (Model $record) {
                        $record = User::find($record->user_id);
                        return response()->streamDownload(function () use ($record) {
                            echo Pdf::loadHtml(
                                Blade::render('vendor.filament.components.pdf', ['record' => $record])
                            )->stream();
                        }, $record->id . '.pdf');
                    }),
                Tables\Actions\Action::make('remove_college_report')
                    ->label('Remove College Report')
                    ->requiresConfirmation()
                    ->color('danger')
                    ->icon('heroicon-s-trash')
                    ->visible(fn(Model $record) =>
                        auth()->user()->hasRole(config('role_names.roles.admin')) &&
                        auth()->user()->email == 'admin_dugs@uhs.com'
                        && $record->student_affidavit_path != null
                    )
                    ->hidden(function (Model $record) {
                        return $record->college_affidavit_path == null;
                    })
                    ->action(function (Model $record) {
                        $record->college_affidavit_path = null;
                        $record->save();
                        Filament::notify('success', 'College Report removed successfully!');
                    }),

                Tables\Actions\Action::make('is_stay')
                    ->label(function (Model $record) {
                        return $record->is_stay == 1 ? 'Upgrade' : 'Stay';
                    })
                    ->requiresConfirmation()
                    ->color(function (Model $record) {
                        return $record->is_stay == 1 ? 'warning' : 'success';
                    })
                    ->visible(fn(Model $record) =>
                        auth()->user()->hasRole(config('role_names.roles.admin')) &&
                        auth()->user()->email == 'admin_dugs@uhs.com'
                        && $record->student_affidavit_path != null
                    )
                    ->action(function (Model $record) {
                        $message = "";
                        if ($record->is_stay == 1) {
                            $record->is_stay = 0;
                            $message = "Upgraded";
                        } else {
                            $record->is_stay = 1;
                            $message = "Stay";
                        }
                        $record->save();
                        Filament::notify('success', 'Student ' . $message . ' successfully!');
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {

        if (auth()->user()->hasRole(config('role_names.roles.college'))) {
            return parent::getEloquentQuery()
                ->where('college_to', auth()->user()->college_id)
                ->whereHas('selectionList', function ($query) {
                    $query->where('status', 1);
                });

        }
        return parent::getEloquentQuery();
    }

    public static function canCreate(): bool
    {
        /*return
            auth()->user()->hasRole(config('role_names.roles.super_admin'))
            || auth()->user()->hasRole(config('role_names.roles.college'));*/
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole(config('role_names.roles.college'));
        /*return  false;*/
    }

    /**
     * @param Model $record
     * @return bool
     */
    public static function canView(Model $record): bool
    {
        return
            auth()->user()->hasRole(config('role_names.roles.super_admin'))
            || auth()->user()->hasRole(config('role_names.roles.admin'))
            || auth()->user()->hasRole(config('role_names.roles.college'));
        /*return  false;*/
    }

    /**
     * @param Model $record
     * @return bool
     */
    public static function canDelete(Model $record): bool
    {
        /*return
            auth()->user()->hasRole(config('role_names.roles.super_admin'))
            || auth()->user()->hasRole(config('role_names.roles.college'));*/
        return false;
    }

    public static function canDeleteAny(): bool
    {
        /*return
            auth()->user()->hasRole(config('role_names.roles.super_admin'))
            || auth()->user()->hasRole(config('role_names.roles.college'));*/
        return false;
    }

    /**
     * @return bool
     */
    public static function canViewAny(): bool
    {
        return
            auth()->user()->hasRole(config('role_names.roles.super_admin'))
            || auth()->user()->hasRole(config('role_names.roles.admin'))
            || auth()->user()->hasRole(config('role_names.roles.college'));
        /*return  false;*/
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeritListFromColleges::route('/'),
            'create' => Pages\CreateMeritListFromCollege::route('/create'),
            'edit' => Pages\EditMeritListFromCollege::route('/{record}/edit'),
        ];
    }
}
