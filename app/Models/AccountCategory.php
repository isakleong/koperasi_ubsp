<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{
    use HasFactory;

    protected $table = 'account_category';

    protected $fillable = [
        'name',
        'active'
    ];

    public function accounts(){
        return $this->hasMany(Account::class, 'categoryID', 'id');
    }
}
