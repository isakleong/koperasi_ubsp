<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
    use HasFactory;

    protected $table = 'account_transaction';

    protected $fillable = [
        'id',
        'docId',
        'memberId',
        'transactionDate',
        'totalDebit',
        'totalKredit',
        'method',
        'notes'
    ];

    public function accountTransactionDetail(){
        return $this->hasMany(AccountTransactionDetail::class, 'docId');
    }
}
