<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function item()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
