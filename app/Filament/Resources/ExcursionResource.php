<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExcursionResource\Pages;
use App\Filament\Resources\ExcursionResource\RelationManagers;
use App\Models\Excursion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ExcursionResource extends Resource
{
    protected static ?string $model = Excursion::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';
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
                Forms\Components\Select::make('guide_id')
                    ->label('Гид')
                    ->relationship('guide', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label('Цена')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('title')
                    ->label('Название')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->label('Код')
                    ->required()
                    ->readOnly(),
                Forms\Components\FileUpload::make('preview_image')
                    ->label('Изображение для превью')
                    ->image()
                    ->directory('excursions')
                    ->required(),
                Forms\Components\FileUpload::make('detail_image')
                    ->label('Основное изображение')
                    ->image()
                    ->directory('excursions')
                    ->required(),
                Forms\Components\Textarea::make('preview_text')
                    ->label('Текст для превью')
                    ->required()
                    ->columnSpanFull(),
                TinyEditor::make('detail_text')
                    ->label('Основной текст')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('tags')
                    ->label('Теги'),
                Forms\Components\TextInput::make('duration_minutes')
                    ->label('Длительность (минуты)')
                    ->numeric(),
                Forms\Components\TagsInput::make('locations')
                    ->label('Места'),
                Forms\Components\TagsInput::make('languages')
                    ->label('Языки')
                    ->default('Русский'),
                Forms\Components\TextInput::make('max_people')
                    ->label('Максимальное количество людей')
                    ->numeric(),
                Forms\Components\TextInput::make('transport')
                    ->label('Транспорт'),
                Forms\Components\Toggle::make('isActive')
                    ->label('Активна')
                    ->default(true)
                    ->required(),
                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Дата публикации')
                    ->default(Carbon::now())
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
                Tables\Columns\TextColumn::make('guide_id')
                    ->label('Гид')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('duration_minutes')
                    ->label('Длительность (минуты)')
                    ->numeric(),
                Tables\Columns\TextColumn::make('locations')
                    ->label('Места'),
                Tables\Columns\TextColumn::make('languages')
                    ->label('Языки'),
                Tables\Columns\TextColumn::make('max_people')
                    ->label('Максимальное количество людей')
                    ->numeric(),
                Tables\Columns\TextColumn::make('transport')
                    ->label('Транспорт'),
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
