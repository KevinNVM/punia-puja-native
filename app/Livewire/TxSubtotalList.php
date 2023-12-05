<?php

namespace App\Livewire;

use App\Models\Tx;
use Livewire\Component;

class TxSubtotalList extends Component
{

    public $from, $to, $showAccumulations = false;

    public function mount()
    {
        $this->from = now()
            ->subtract((int) request('from', 0) . ' day')
            ->format('Y-m-d');

        if (request('show_all')) {
            // Get oldest record and take the date as reference
            $this->from = Tx::orderBy('date', 'asc')->take(1)->first()->date ?? $this->from;
        }


        $this->to = now()
            ->add((int) request('to', 0) . ' day')
            ->format('Y-m-d');
    }

    public function toggleAccumulation()
    {
        $this->showAccumulations = !$this->showAccumulations;
    }

    public function render()
    {
        $txes = Tx::whereDate('date', '>=', $this->from)
            ->whereDate('date', '<=', $this->to)
            ->orderBy('date', 'asc')
            ->get(['amount', 'date']);

        $accumulations = [];
        if ($this->showAccumulations) {
            foreach ($txes as $index => $tx) {
                if ($index > 0) {
                    $accumulations[] = $accumulations[$index - 1] + $tx->amount;
                } else {
                    $accumulations[] = $tx->amount;
                }
            }
        }

        return view(
            'livewire.tx-subtotal-list',
            [
                'txes' => $txes,
                'accumulations' => $accumulations
            ]
        );
    }
}
