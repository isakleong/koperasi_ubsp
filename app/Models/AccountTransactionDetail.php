<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'account_transaction_detail';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'docId',
        'indexNo',
        'accountNo',
        'kind',
        'total'
    ];

    public function accountTransaction() {
        return $this->belongsTo(AccountTransaction::class, 'docId', 'docId');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'accountNo', 'accountNo');
    }
}
