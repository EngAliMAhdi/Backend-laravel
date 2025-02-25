<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SessionTypeResource\Pages;
use App\Filament\Resources\SessionTypeResource\RelationManagers;
use App\Models\SessionType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SessionTypeResource extends Resource
{
    protected static ?string $model = SessionType::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'الجلسات';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        // return __('filament.products');  // استخدام الترجمة هنا
        return 'أعداد الجلسات';
    }

    public static function getModelLabel(): string
    {
        return 'جلسة';
    }
    public static function getPluralModelLabel(): string
    {
        return 'تنصيفات الجلسات';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('اسم الجلسة')
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_en')
                    ->label('اسم بالانجليزي')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نوع الجلسة')
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
            'index' => Pages\ListSessionTypes::route('/'),
            'create' => Pages\CreateSessionType::route('/create'),
            'view' => Pages\ViewSessionType::route('/{record}'),
            'edit' => Pages\EditSessionType::route('/{record}/edit'),
        ];
    }
}
