<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'account';

    protected $fillable = [
        'id',
        'name',
        'noAccount',
        'description',
        'rates',
        'monthlyRates',
        'baseCicilan',
        'monthlyCicilan',
        'notes',
        'status',
        'requestDate',
        'approvedOn',
    ];

    public function category(){
        return $this->belongsTo(AccountCategory::class, 'categoryID', 'id');
    }
}
