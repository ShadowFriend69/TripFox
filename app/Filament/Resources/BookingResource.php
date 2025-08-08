<?php

namespace App\Filament\Resources;

use App\Enums\BookingStatus;
use App\Enums\UserRole;
use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Бронирования';
    protected static ?string $navigationGroup = 'Экскурсии';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('excursion_id')
                    ->label('Экскурсия')
                    ->relationship('excursion', 'title')
                    ->required(),

                Forms\Components\Select::make('client_id')
                    ->label('Клиент')
                    ->relationship(
                        'client',
                        'name',
                        modifyQueryUsing: fn ($query) => $query->where('role', UserRole::CLIENT->value)
                    )
                    ->required(),

                Forms\Components\DateTimePicker::make('date')
                    ->label('Дата экскурсии')
                    ->required(),

                Forms\Components\TextInput::make('people_count')
                    ->label('Кол-во человек')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Статус')
                    ->options(BookingStatus::options())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('excursion.title')
                    ->label('Экскурсия')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('client.name')
                    ->label('Клиент')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Дата')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('people_count')
                    ->label('Людей')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->color(fn (BookingStatus $state): string => match ($state) {
                        BookingStatus::Pending => 'warning',
                        BookingStatus::Confirmed => 'info',
                        BookingStatus::Paid => 'success',
                        BookingStatus::Cancelled => 'danger',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn (BookingStatus $state) => $state->label())
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Обновлено')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
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
