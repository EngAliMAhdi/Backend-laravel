<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReligionResource\Pages;
use App\Filament\Resources\ReligionResource\RelationManagers;
use App\Models\Religion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReligionResource extends Resource
{
    protected static ?string $model = Religion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'ميزان حسناتك';
    protected static ?int $navigationSort = 11;

    // protected static ?string $cluster = taskDaily::class;
    public static function getNavigationLabel(): string
    {
        // return __('filament.products');  // استخدام الترجمة هنا
        return 'الديانات';
    }

    public static function getModelLabel(): string
    {
        return 'ديانة';
    }
    public static function getPluralModelLabel(): string
    {
        return 'الديانات';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('الاسم')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_en')
                    ->label('الاسم بالانجليزي')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_en')
                    ->label('الاسم بالانجليزي')

                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReligions::route('/'),
            'create' => Pages\CreateReligion::route('/create'),
            'view' => Pages\ViewReligion::route('/{record}'),
            'edit' => Pages\EditReligion::route('/{record}/edit'),
        ];
    }
}
