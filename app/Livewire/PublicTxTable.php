<?php

namespace App\Livewire;

use App\Models\Tx;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

class PublicTxTable extends DataTableComponent
{
    protected $model = Tx::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Jenis", "type")
                ->sortable(),
            Column::make("Nama", "name")
                ->sortable()
                ->searchable(),
            Column::make("No Hp", "phone")
                ->sortable(),
            Column::make("Jumlah", "amount")
                ->sortable()
                ->format(fn($state) => 'Rp ' . number_format($state, 2, ',', '.'))
                ->secondaryHeader(function ($rows) {
                    return 'Subtotal: Rp ' . number_format($rows->sum('amount'), 2, ',', '.');
                }),
            Column::make("Tanggal", "date")
                ->sortable()
                ->format(fn($state) => $state->format('d M Y')),
            Column::make("Acara", "events")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable()
                ->hideIf(true),
            Column::make("Updated at", "updated_at")
                ->sortable()
                ->hideIf(true),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Tipe')
                ->options([
                    '' => 'Semua',
                    'cash' => 'Tunai',
                    'qris' => 'QRIS',
                ])
                ->filter(function (Builder $builder, $data) {
                    return $builder->where('type', $data);
                }),
            SelectFilter::make('Event')
                ->options(
                    Tx::pluck('events')
                        ->unique()
                        ->combine(Tx::pluck('events')
                            ->unique())
                        ->prepend('Semua', '')
                        ->toArray()
                )
                ->filter(function (Builder $builder, $data) {
                    return $builder->where('events', $data);
                }),
            DateRangeFilter::make('Rentang Waktu')
                ->config([
                    'allowInput' => true,   // Allow manual input of dates
                    'altFormat' => 'd M Y', // Date format that will be displayed once selected
                    'ariaDateFormat' => 'd M Y', // An aria-friendly date format
                    'dateFormat' => 'Y-m-d', // Date format that will be received by the filter
                    'placeholder' => 'Rentang waktu', // A placeholder value
                ])
                ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // The values that will be displayed for the Min/Max Date Values
                ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                    $builder
                        ->whereDate('date', '>=', $dateRange['minDate']) // minDate is the start date selected
                        ->whereDate('date', '<=', $dateRange['maxDate']); // maxDate is the end date selected
                })
        ];
    }
}
