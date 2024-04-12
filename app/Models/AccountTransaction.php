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
        'kind',
        'totalDebit',
        'totalKredit',
        'method',
        'notes'
    ];

    public function accountTransactionDetail(){
        return $this->hasMany(AccountTransactionDetail::class, 'docId', 'docId');
    }

    public function debitDetail()
    {
        return $this->hasMany(AccountTransactionDetail::class, 'docId', 'docId')->where('kind', 'D');
    }

    public function creditDetail()
    {
        return $this->hasMany(AccountTransactionDetail::class, 'docId', 'docId')->where('kind', 'K');
    }
}
