<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'available',
        'name',
        'unit',
        'description',
        'status',
        'location_id',
    ];

    // item to transactiondetails
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // items from location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
