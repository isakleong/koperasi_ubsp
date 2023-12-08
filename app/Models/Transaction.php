<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $primaryKey = 'docId';

    protected $fillable = [
        'docId',
        'accountId',
        'kind',
        'total',
        'method',
        'transactionDate',
        'image',
        'notes',
        'status',
        'approvedOn',
    ];

    public function userAccount() {
        return $this->belongsTo(UserAccount::class, 'accountId', 'accountId');
    }

    protected static function boot()
    {
        parent::boot();

        // Register a creating event to set the custom primary key
        static::creating(function ($model) {
            // Check if the model doesn't have a primary key yet
            if (!$model->getKey()) {
                // Set the custom primary key
                $model->setAttribute($model->getKeyName(), static::generateCustomPrimaryKey($model->kind, $model->transactionDate, $model->accountId));
            }
        });
    }

    protected static function generateCustomPrimaryKey($kind, $transactionDate, $accountId)
    {
        // Determine the prefix based on the kind
        $prefix = ($kind === 'pokok' || $kind === 'wajib' || $kind === 'sukarela') ? 'TS' : (($kind === 'tabungan') ? 'TT' : 'TR');

        // Get the memberId from the related userAccount
        $memberId = UserAccount::where('accountId', $accountId)->value('memberId');

        // Convert $transactionDate to a DateTime object if it's a string
        if (is_string($transactionDate)) {
            $transactionDate = new \DateTime($transactionDate);
        }

        // Format the transactionDate (assuming $transactionDate is a valid DateTime object)
        $formattedDate = $transactionDate->format('ymd');

        // Count the total transactions on that date
        // $totalTransactions = static::whereDate('transactionDate', $transactionDate->toDateString())->count();

        $totalTransactions = static::where('docId', 'LIKE', '%' . $memberId . '%')
        ->where('transactionDate', 'LIKE', '%' . $transactionDate->format('Y-m-d') . '%')->count();

        // Increment the total transactions
        $increment = str_pad($totalTransactions + 1, 3, '0', STR_PAD_LEFT);

        // Build the custom primary key
        $customPrimaryKey = $prefix . '-' . $memberId . '-' . $formattedDate . '-' . $increment;

        return $customPrimaryKey;
    }

}
