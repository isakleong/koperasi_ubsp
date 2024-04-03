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
        'normalBalance',
        'balance',
        'description',
        'active'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function category(){
        return $this->belongsTo(AccountCategory::class, 'categoryID', 'id');
    }
}
