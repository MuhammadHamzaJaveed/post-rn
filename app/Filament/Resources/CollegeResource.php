<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollegeResource\Pages;
use App\Imports\CollegeImport;
use App\Models\College;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Importer;

class CollegeResource extends Resource
{
    use WithFileUploads;
    protected static ?string $model = College::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('College Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->autofocus()
                            ->required(),
                        TextInput::make('district')
                            ->label('District')
                            ->autofocus()
                            ->required(),
                    ]),

                Section::make('Seats')
                    ->description('Enter the number of seats for each category')
                    ->columns(3)
                    ->schema([
                        TextInput::make('openMeritSeats')
                            ->label('Open Merit Seats')
                            ->autofocus()
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('overSeasSeats')
                            ->label('Overseas Seats')
                            ->autofocus()
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('disabilitySeats')
                            ->label('Disability Seats')
                            ->autofocus()
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('underdevelopedAreas')
                            ->label('Underdeveloped Areas')
                            ->autofocus()
                            ->numeric()
                            ->required(),
                        TextInput::make('cholistanSeats')
                            ->label('Cholistan Seats')
                            ->autofocus()
                            ->numeric()
                            ->required(),
                        TextInput::make('isReciprocal')
                            ->label('Is Reciprocal')
                            ->autofocus()
                            ->numeric()
                            ->required(),
                    ]),
                Section::make('Options')
                    ->columns(2)
                    ->schema([
                        Toggle::make('isBds')
                            ->disabled(!auth()->user()->is_super_admin || !auth()->user()->is_admin)
                            ->dehydrated(auth()->user()->is_super_admin || auth()->user()->is_admin)
                            ->required()
                            ->hint('When MBBS it should be on and when BDS it should be off'),
                        Toggle::make('isFemale')
                            ->disabled(!auth()->user()->is_super_admin || !auth()->user()->is_admin)
                            ->dehydrated(auth()->user()->is_super_admin || auth()->user()->is_admin)
                            ->required()
                            ->hint('when only female it should be on otherwise off'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->description(function (College $record) {
                        return $record->district;
                    })->searchable()->sortable(),
                IconColumn::make('isBds')
                    ->label('isBds')
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle')
                    ->sortable(),
                TextColumn::make('openMeritSeats')
                    ->label('openMeritSeats')
                    ->sortable(),
                TextColumn::make('overSeasSeats')
                    ->label('overSeasSeats')
                    ->sortable(),
                TextColumn::make('disabilitySeats')
                    ->label('disabilitySeats')
                    ->sortable(),
                TextColumn::make('underdevelopedAreas')
                    ->label('underdevelopedAreas')
                    ->sortable(),
                TextColumn::make('cholistanSeats')
                    ->label('cholistanSeats')
                    ->sortable(),
                TextColumn::make('isReciprocal')
                    ->label('isReciprocal')
                    ->sortable(),
                IconColumn::make('isFemale')
                    ->label('isFemale')
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            /*->headerActions(
                [
                Tables\Actions\Action::make('import')
                    ->form([
                        Forms\Components\FileUpload::make('import_file')
                            ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                            ->label('Excel File')
                            ->hint('Only Excel files are allowed. Download the sample file.')
                            ->hintIcon('heroicon-o-information-circle')
                            ->hintAction(
                                Action::make('downloadSample')
                                    ->label('Download Sample')
                                    ->url(asset('sample.xlsx'))
                                    ->color('success')
                                    ->icon('heroicon-o-download')
                                    ->openUrlInNewTab()
                            )
                            ->required(),

                    ])
                    ->action(function ($data) {
                        $filePath = $data['import_file'];
                        // Import the Excel file
                        Excel::import(new CollegeImport, $filePath);

                        Filament::notify('success', 'File imported successfully!');                    }),
            ]
            )*/
            ->actions([
                Tables\Actions\EditAction::make(),
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


    public static function canCreate(): bool
    {
        /*
         * return  auth()->user()->hasRole(config('role_names.roles.super_admin'))
         * || auth()->user()->hasRole(config('role_names.roles.admin'));
        */
        return  false;
    }

    public static function canEdit(Model $record): bool
    {
        /*
         * return  auth()->user()->hasRole(config('role_names.roles.super_admin'))
         * || auth()->user()->hasRole(config('role_names.roles.admin'));
        */
        return  false;
    }

    /**
     * @param  Model  $record
     * @return bool
     */
    public static function canView(Model $record): bool
    {
        /*
         * return  auth()->user()->hasRole(config('role_names.roles.super_admin'))
         * || auth()->user()->hasRole(config('role_names.roles.admin'));
        */
        return  false;
    }

    /**
     * @param  Model  $record
     * @return bool
     */
    public static function canDelete(Model $record): bool
    {
        /*
         * return  auth()->user()->hasRole(config('role_names.roles.super_admin'))
         * || auth()->user()->hasRole(config('role_names.roles.admin'));
        */
        return  false;
    }

    public static function canDeleteAny(): bool
    {
        /*
         * return  auth()->user()->hasRole(config('role_names.roles.super_admin'))
         * || auth()->user()->hasRole(config('role_names.roles.admin'));
        */
        return  false;
    }

    /**
     * @return bool
     */
    public static function canViewAny(): bool
    {
        /*
         * return  auth()->user()->hasRole(config('role_names.roles.super_admin'))
         * || auth()->user()->hasRole(config('role_names.roles.admin'));
        */
        return  false;
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListColleges::route('/'),
            'create' => Pages\CreateCollege::route('/create'),
            'edit' => Pages\EditCollege::route('/{record}/edit'),
        ];
    }
}
