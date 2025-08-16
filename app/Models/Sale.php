<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'receipt_number',
        'total_amount',
        'tax_amount',
        'discount_amount',
        'payment_method',
        'cashier',
    ];

    protected $casts = [
        'total_amount' => 'integer',
        'tax_amount' => 'integer',
        'discount_amount' => 'integer',
    ];

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'sale_items')
                    ->withPivot('quantity', 'unit_price', 'total_price')
                    ->withTimestamps();
    }
}
