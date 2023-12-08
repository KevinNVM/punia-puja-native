<?php

namespace App\Livewire;

use Gate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setEagerLoadAllRelationsStatus(true);

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make('Roles', 'id')
                ->label(fn($value) => implode(', ', User::find($value->id)->roles->pluck('name')->toArray()))
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View')
                        ->title(fn() => 'Ubah Peran')
                        ->location(fn($row) => Auth::user()->id !== $row->id ? route('admin.edit-role', $row->id) : 'javascript:void(0)')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-primary',
                            ];
                        }),
                    LinkColumn::make('View')
                        ->title(fn() => 'Hapus User')
                        ->location(fn($row) => Auth::user()->id !== $row->id ? route('admin.delete-user', $row->id) : 'javascript:void(0)')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-error',
                            ];
                        }),
                ])->hideIf(!Auth::user()->hasRole('super-admin')),
        ];
    }
}
