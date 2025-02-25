<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserSessionResource\Pages;
use App\Filament\Resources\UserSessionResource\RelationManagers;
use App\Models\UserSession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserSessionResource extends Resource
{
    protected static ?string $model = UserSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'الجلسات';
    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        // return __('filament.products');  // استخدام الترجمة هنا
        return 'أرشيف الجلسات';
    }

    public static function getModelLabel(): string
    {
        return 'جلسة';
    }
    public static function getPluralModelLabel(): string
    {
        return 'أرشيف الجلسات';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('المستخدم')
                    ->preload()
                    ->live()
                    ->required(),
                Forms\Components\Select::make('session_type_id')
                    ->relationship('sessiontype', 'name')
                    ->label('نوع الجلسة')
                    ->preload()
                    ->lazy()
                    ->default(null),
                Forms\Components\TextInput::make('other_name')
                ->label('اسم أخر')

                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('Details')
                    ->label('تفاصيل '),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->label('المستخدم ')

                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sessiontype.name')
                ->label('نوع الجلسة')

                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('other_name')
                ->label(' اسم أخر')

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
            'index' => Pages\ListUserSessions::route('/'),
            'create' => Pages\CreateUserSession::route('/create'),
            'view' => Pages\ViewUserSession::route('/{record}'),
            'edit' => Pages\EditUserSession::route('/{record}/edit'),
        ];
    }
}
