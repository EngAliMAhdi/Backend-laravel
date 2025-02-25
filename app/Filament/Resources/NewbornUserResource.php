<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewbornUserResource\Pages;
use App\Filament\Resources\NewbornUserResource\RelationManagers;
use App\Models\NewbornUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewbornUserResource extends Resource
{
    protected static ?string $model = NewbornUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'المواليد الجدد';
    protected static ?int $navigationSort = 7;

    public static function getNavigationLabel(): string
    {
        // return __('filament.products');  // استخدام الترجمة هنا
        return 'أرشيف المواليد';
    }

    public static function getModelLabel(): string
    {
        return 'مولود';
    }
    public static function getPluralModelLabel(): string
    {
        return 'المواليد';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('length')
                    ->label('الطول')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('weight')
                    ->label('الوزن')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('hair_color')
                    ->label('لون الشعر')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('eye_color')
                    ->label('لون العين')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('skin_color')
                    ->label('لون الجلد')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\Textarea::make('father_notes')
                    ->label('ملاحظات الاب')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('mother_notes')
                    ->label('ملاحظات الام')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('siblings_notes')
                    ->label('ملاحظات الاخوة')
                    ->columnSpanFull(),
                Forms\Components\Select::make('user_id')
                    ->label('المستخدم')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('food_id')
                    ->label('الغذاء')
                    ->relationship('food', 'name')
                    ->required(),
                Forms\Components\TextInput::make('other_food')
                    ->label('غذاء اخر')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('placement_id')
                    ->label('المكان')
                    ->relationship('placement', 'name')
                    ->required(),
                Forms\Components\TextInput::make('other_address')
                    ->label('عنوان أخر')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('position_id')
                    ->label('الوضعية')
                    ->relationship('position', 'name')
                    ->required(),
                Forms\Components\TextInput::make('other_position')
                    ->label('وضعية أخرى')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('season_id')
                    ->label('الموسم')
                    ->relationship('season', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('length')
                    ->label('الطول')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weight')
                    ->label('الوزن')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hair_color')
                    ->label('لون الشعر')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('eye_color')
                    ->label('لون العين')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('skin_color')
                    ->label('لون الجلد')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('المستخدم')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('food.name')
                    ->label('الغذاء')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('other_food')
                    ->label('غذاء أخر')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('placement.name')
                    ->label('المكان')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('other_address')
                    ->label('مكان اخر')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('position.name')
                    ->label('الوضعية')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('other_position')
                    ->label('وضعية أخرى')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('season.name')
                    ->label('الموسم')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListNewbornUsers::route('/'),
            'create' => Pages\CreateNewbornUser::route('/create'),
            'view' => Pages\ViewNewbornUser::route('/{record}'),
            'edit' => Pages\EditNewbornUser::route('/{record}/edit'),
        ];
    }
}
