<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table = 'transaction_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'transaction_item_id',
        'item_id',
        'quantity',
        'description',
    ];

    // transactiondetails from transactionitem
    public function transactionItem()
    {
        return $this->belongsTo(TransactionItem::class);
    }

    // transactiondetails from item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
