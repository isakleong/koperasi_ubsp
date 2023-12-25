<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Account extends Model
{
    use HasFactory, NodeTrait;

    protected $table = 'account';

    protected $fillable = [
        'id',
        'name',
        'accountNo',
        'categoryID',
        'description',
        'rates',
        'monthlyRates',
        'baseCicilan',
        'monthlyCicilan',
        'notes',
        'status',
        'active',
        'requestDate',
        'approvedOn',
    ];

    public function category(){
        return $this->belongsTo(AccountCategory::class, 'categoryID', 'id');
    }
}
