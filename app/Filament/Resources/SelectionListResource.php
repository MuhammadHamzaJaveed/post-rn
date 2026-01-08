<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SelectionListResource\Pages;
use App\Models\SelectionList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class SelectionListResource extends Resource
{
    protected static ?string $model = SelectionList::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->extraAttributes(['title' => 'Text input'])->columnSpanFull(),
                Toggle::make('status')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\BooleanColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                /*Tables\Actions\EditAction::make(),*/
                Tables\Actions\Action::make('active')
                    ->icon('heroicon-o-check')
                    ->color('primary')
                    ->label('Active')
                ->action(fn (SelectionList $record) => $record->update(['status' => 1]))
                ->visible(fn (SelectionList $record) => !$record->status)
                ->requiresConfirmation(),
                Tables\Actions\Action::make('inactive')
                    ->label('Inactive')
                    ->icon('heroicon-o-x')
                    ->color('danger')
                    ->requiresConfirmation()
                ->action(fn (SelectionList $record) => $record->update(['status' => 0]))
                ->visible(fn (SelectionList $record) => $record->status),
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
        return auth()->user()->hasRole(config('role_names.roles.super_admin'));
        /*return  false;*/
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole(config('role_names.roles.super_admin'));
        /*return  false;*/
    }

    /**
     * @param Model $record
     * @return bool
     */
    public static function canView(Model $record): bool
    {
        return auth()->user()->hasRole(config('role_names.roles.super_admin'));
        /*return  false;*/
    }

    /**
     * @param Model $record
     * @return bool
     */
    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole(config('role_names.roles.super_admin'));
        /*return  false;*/
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->hasRole(config('role_names.roles.super_admin'));
        /*return  false;*/
    }

    /**
     * @return bool
     */
    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole(config('role_names.roles.super_admin'));
        /*return  false;*/
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSelectionLists::route('/'),
            'create' => Pages\CreateSelectionList::route('/create'),
            'edit' => Pages\EditSelectionList::route('/{record}/edit'),
        ];
    }    
}
