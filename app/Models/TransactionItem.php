<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;
    protected $table = 'transaction_items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'request_date',
        'user_id',
    ];

    // transactionitems from user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // transactionitem to transactiondetails
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
