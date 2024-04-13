<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransactionImage extends Model
{
    use HasFactory;

    protected $table = 'account_transaction_image';

    protected $fillable = [
        'docId',
        'indexNo',
        'image'
    ];

    public function accountTransaction() {
        return $this->belongsTo(AccountTransaction::class, 'docId', 'docId');
    }
}
