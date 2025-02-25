<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserMaintenanceResource\Pages;
use App\Filament\Resources\UserMaintenanceResource\RelationManagers;
use App\Models\Maintenance;
use App\Models\UserMaintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class UserMaintenanceResource extends Resource
{
    protected static ?string $model = UserMaintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationGroup = 'الصيانة';
    public static function getNavigationLabel(): string
    {
        // return __('filament.products');  // استخدام الترجمة هنا
        return '  أرشيف الصيانة';
    }

    public static function getModelLabel(): string
    {
        return ' صيانة';
    }
    public static function getPluralModelLabel(): string
    {
        return ' أرشيف الصيانة';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label(' المستخدم')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('maintenance_type_id')
                    ->relationship('maintenancetype', 'name')
                    ->preload()
                    ->label('تصنيف الصيانة')
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('maintenance_id', null);
                    })
                    ->required(),
                Forms\Components\Select::make('maintenance_id')
                    ->label(' الصيانة')
                    ->options(fn(Get $get): Collection => Maintenance::query()
                        ->where('maintenance_type_id', $get('maintenance_type_id'))
                        ->pluck('name', 'id'))
                    ->live()
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->label(' ملاحظات')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label(' المستخدم')
                    ->sortable(),
                Tables\Columns\TextColumn::make('maintenancetype.name')
                    ->label('تصنيف الصيانة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('maintenance.name')
                    ->label(' الصيانة')
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
            'index' => Pages\ListUserMaintenances::route('/'),
            'create' => Pages\CreateUserMaintenance::route('/create'),
            'view' => Pages\ViewUserMaintenance::route('/{record}'),
            'edit' => Pages\EditUserMaintenance::route('/{record}/edit'),
        ];
    }
}
