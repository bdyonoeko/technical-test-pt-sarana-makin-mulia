<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'name',
    ];

    // location to items
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
