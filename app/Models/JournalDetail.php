<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalDetail extends Model
{
    use HasFactory;

    protected $table = 'journal_entry_detail';

    protected $fillable = [
        'docId',
        'accountNo',
        'indexNo',
        'description',
        'debit',
        'kredit'
    ];

    public function journal() {
        return $this->belongsTo(Journal::class, 'docId', 'docID');
    }
}
