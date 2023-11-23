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
    
    protected static function boot()
    {
        parent::boot();

        // Register a creating event to set the custom primary key
        static::creating(function ($model) {
            // Check if the model doesn't have a primary key yet
            if (!$model->getKey()) {
                // Set the custom primary key
                $model->setAttribute($model->getKeyName(), static::generateCustomPrimaryKey());
            }
        });
    }

    protected static function generateCustomPrimaryKey()
    {
        // Get the latest record
        $latestRecord = static::latest()->first();

        // Extract the numeric part and increment
        $number = $latestRecord ? (int) substr($latestRecord->getKey(), 5) + 1 : 1;

        // Format the custom primary key
        $customPrimaryKey = 'MUAC-'.str_pad($number, 3, '0', STR_PAD_LEFT);

        return $customPrimaryKey;
    }
}