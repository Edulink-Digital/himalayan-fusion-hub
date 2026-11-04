<?php

namespace App\Filament\Resources\Reservations;

use App\Filament\Resources\Reservations\Pages\ListReservations;
use App\Filament\Resources\Reservations\Pages\ViewReservation;
use App\Models\Reservation;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

/**
 * Inbox of booking requests sent from the website. Requests are read and deleted here,
 * never created or edited, since they come from the public booking form.
 */
class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'Bookings';

    protected static ?string $modelLabel = 'booking';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $upcoming = Reservation::query()->whereDate('date', '>=', today())->count();

        return $upcoming > 0 ? (string) $upcoming : null;
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Booking request')
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('phone')
                            ->url(fn (Reservation $record): string => 'tel:'.preg_replace('/[^0-9+]/', '', $record->phone)),
                        TextEntry::make('email')
                            ->placeholder('Not given')
                            ->url(fn (Reservation $record): ?string => $record->email ? 'mailto:'.$record->email : null),
                        TextEntry::make('type')
                            ->label('Occasion')
                            ->formatStateUsing(fn (string $state): string => config("hfh.booking_types.{$state}", $state)),
                        TextEntry::make('date')->date('l j F Y'),
                        TextEntry::make('guests'),
                        TextEntry::make('notes')->label('Message')->placeholder('No message')->columnSpanFull(),
                        TextEntry::make('created_at')->label('Received')->since(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('type')
                    ->label('Occasion')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => config("hfh.booking_types.{$state}", $state)),
                TextColumn::make('date')->date('D j M Y')->sortable(),
                TextColumn::make('guests')->numeric()->sortable(),
                TextColumn::make('created_at')->label('Received')->since()->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')->label('Occasion')->options(config('hfh.booking_types')),
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReservations::route('/'),
            'view' => ViewReservation::route('/{record}'),
        ];
    }
}
