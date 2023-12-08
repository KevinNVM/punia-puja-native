<?php

namespace App\Livewire;

use App\Models\Tx;
use Livewire\Component;

class DashboardTxTable extends Component
{

    public $from, $to, $date, $selectDate, $search, $type, $event;

    private function getTx()
    {
        $query = Tx::query();

        if ($this->search) {
            $query->where('name', 'LIKE', "%$this->search%");
        }

        if ($this->type) {
            $query->where('type', $this->type);
        }

        if ($this->event) {
            $query->where('events', $this->event);
        }

        // Check if there is a request for 'select_date'
        if ($this->selectDate = request('select_date')) {
            $date = now()->subDays(abs($this->selectDate))->format('Y-m-d');
            $query->where('date', '<=', $date);
        } elseif ($this->from && $this->to) {
            // If there is $from and $to, use them
            $query->whereBetween('date', [$this->from, $this->to]);
        } elseif ($this->date) {
            // If there is $date, use it
            $query->where('date', '=', $this->date);
        }



        // You can add more conditions or modify the column name as needed

        return $query;
    }

    public function resetFilter()
    {
        $this->from = null;
        $this->to = null;
        $this->date = null;
        $this->selectDate = null;
        $this->search = null;
        $this->type = null;
        $this->event = null;
    }

    public function render()
    {
        $tx = $this->getTx()->paginate(10);
        $txSum = [
            'totalTx' => Tx::sum('amount'),
            'totalTypeQris' => Tx::where('type', 'qris')->sum('amount'),
            'totalTypeCash' => Tx::where('type', 'cash')->sum('amount'),
            'rangeTotalTx' => [
                Tx::orderBy('date', 'asc')->first()?->date,
                Tx::orderBy('date', 'desc')->first()?->date,
            ],
            'rangeTotalQris' => [
                Tx::orderBy('date', 'asc')->where('type', 'qris')->first()?->date,
                Tx::orderBy('date', 'desc')->where('type', 'qris')->first()?->date,
            ],
            'rangeTotalCash' => [
                Tx::orderBy('date', 'asc')->where('type', 'cash')->first()?->date,
                Tx::orderBy('date', 'desc')->where('type', 'cash')->first()?->date,
            ],
            'txesCount' => Tx::count(),
            'typeQrisCount' => Tx::where('type', 'qris')->count(),
            'typeCashCount' => Tx::where('type', 'cash')->count()
        ];

        $searchableEvents = Tx::pluck('events')
            ->unique()
            ->combine(Tx::pluck('events')
                ->unique())
            ->prepend('Semua', '')
            ->toArray();

        return view('livewire.dashboard-tx-table', [
            'txes' => $tx,
            'txSum' => (object) $txSum,
            'events' => $searchableEvents
        ]);
    }
}
