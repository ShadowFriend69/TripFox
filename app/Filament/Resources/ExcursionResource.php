<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExcursionResource\Pages;
use App\Filament\Resources\ExcursionResource\RelationManagers;
use App\Models\Excursion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExcursionResource extends Resource
{
    protected static ?string $model = Excursion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Экскурсии';
    protected static ?string $navigationGroup = 'Экскурсии';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Категория')
                    ->relationship('category', 'title')
                    ->required(),
                Forms\Components\TextInput::make('guid_id')
                    ->label('Гид')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('title')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Код')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('preview_image')
                    ->label('Изображение для превью')
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('detail_image')
                    ->label('Основное изображение')
                    ->image()
                    ->required(),
                Forms\Components\Textarea::make('preview_text')
                    ->label('Текст для превью')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('detail_text')
                    ->label('Основной текст')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('tags')
                    ->label('Теги'),
                Forms\Components\Toggle::make('isActive')
                    ->label('Активна')
                    ->default(true)
                    ->required(),
                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Дата публикации')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Категория')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guid_id')
                    ->label('Гид')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Код')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('preview_image')
                    ->label('Изображение для превью'),
                Tables\Columns\ImageColumn::make('detail_image')
                    ->label('Основное изображение'),
                Tables\Columns\IconColumn::make('isActive')
                    ->label('Активна')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Дата публикации')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата обновления')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Дата удаления')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListExcursions::route('/'),
            'create' => Pages\CreateExcursion::route('/create'),
            'edit' => Pages\EditExcursion::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
