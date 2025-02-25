<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlacementResource\Pages;
use App\Filament\Resources\PlacementResource\RelationManagers;
use App\Models\Placement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlacementResource extends Resource
{
    protected static ?string $model = Placement::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'المواليد الجدد';
    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        // return __('filament.products');  // استخدام الترجمة هنا
        return 'الاماكن';
    }

    public static function getModelLabel(): string
    {
        return 'مكان';
    }
    public static function getPluralModelLabel(): string
    {
        return 'الإماكن';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('المكان')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_en')
                    ->label('المكان باللغة الانجليزية')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('المكان')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_en')
                    ->label('المكان باللغة الانجليزية')

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
            'index' => Pages\ListPlacements::route('/'),
            'create' => Pages\CreatePlacement::route('/create'),
            'view' => Pages\ViewPlacement::route('/{record}'),
            'edit' => Pages\EditPlacement::route('/{record}/edit'),
        ];
    }
}
