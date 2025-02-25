<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceTypeResource\Pages;
use App\Filament\Resources\MaintenanceTypeResource\RelationManagers;
use App\Filament\Resources\MaintenanceTypeResource\RelationManagers\MaintenanceRelationManager;
use App\Models\MaintenanceType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceTypeResource extends Resource
{
    protected static ?string $model = MaintenanceType::class;

    protected static ?string $navigationIcon = 'heroicon-o-command-line';
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationGroup='الصيانة';
    public static function getNavigationLabel(): string
    {
        // return __('filament.products');  // استخدام الترجمة هنا
        return 'إعدادات الصيانة';
    }

    public static function getModelLabel(): string
    {
        return 'تصنيف صيانة';
    }
    public static function getPluralModelLabel(): string
    {
        return 'تنصيف الصيانة';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('تصنيف الصيانة')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_en')
                    ->label('التنصيف بالانجليزي')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Repeater::make('maintenance')
                    ->label('صيانة')
                    ->relationship('maintenance') // تعريف العلاقة
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('اسم الصيانة'),

                        Forms\Components\TextInput::make('name_en')
                            ->label('اسم بالانجليزي'),
                    ])->visible(fn($livewire) => $livewire instanceof CreateRecord) // إظهار فقط أثناء الإنشاء
                    ->columns(2)->columnSpan(2)
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('تصنيف الصيانة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_en')
                    ->label('تصنيف بالانجليزي')
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
            MaintenanceRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaintenanceTypes::route('/'),
            'create' => Pages\CreateMaintenanceType::route('/create'),
            'view' => Pages\ViewMaintenanceType::route('/{record}'),
            'edit' => Pages\EditMaintenanceType::route('/{record}/edit'),
        ];
    }
}
