<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    use HasFactory;

    protected $table = 'loan_detail';

    protected $fillable = [
        'loanDocId',
        'indexCicilan',
        'dueDate',
        'transactionDate',
        'total',
        'charges',
        'method',
        'image',
        'notes',
        'status',
        'approvedOn',
    ];

    public function loan() {
        return $this->belongsTo(Loan::class, 'loanDocId', 'docID');
    }

    // public function loanDetail(): BelongsTo {
    //     return $this->belongsTo(Loan::class, 'loanDocId', 'docId');
    // }
}
