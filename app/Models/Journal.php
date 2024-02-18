<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $table = 'journal_entry';

    protected $fillable = [
        'docId',
        'journalDate',
        'active'
    ];

    public function journalDetail(){
        return $this->hasMany(JournalDetail::class, 'docId', 'docId');
    }
}
