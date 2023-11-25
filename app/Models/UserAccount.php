<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    protected $table = 'user_account';

    protected $primaryKey = 'accountId';

    protected $fillable = [
        'accountId',
        'memberId',
        'kind',
        'balance',
        'openDate',
        'closedDate',
    ];
}