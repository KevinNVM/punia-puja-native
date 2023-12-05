<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tx extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'phone',
        'amount',
        'date',
        'events',
        'proof'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value === 'cash' ? 'Tunai' : 'QRIS',
        );
    }

    public function getFormattedAmount()
    {
        return $this->amount ? 'Rp ' . number_format($this->amount, 2, '.', ',') : 'Rp 0';
    }

    public function getImageString()
    {
        return $this->proof;
    }

}
