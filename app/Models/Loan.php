<?php

namespace App\Models;

use App\Models\LoanDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loan';

    protected $primaryKey = 'docId';

    public $incrementing = false;

    protected $fillable = [
        'docId',
        'accountId',
        'total',
        'tenor',
        'rates',
        'baseCicilan',
        'monthlyCicilan',
        'notes',
        'status',
        'requestDate',
        'approvedOn',
    ];

    public function loanDetails(){
        return $this->hasMany(LoanDetail::class, 'loanDocId', 'docId');
    }

    protected static function boot()
    {
        parent::boot();

        // Register a creating event to set the custom primary key
        static::creating(function ($model) {
            // Check if the model doesn't have a primary key yet
            if (!$model->getKey()) {
                // Set the custom primary key
                $model->setAttribute($model->getKeyName(), static::generateCustomPrimaryKey($model->requestDate, $model->accountId));
            }
        });
    }

    protected static function generateCustomPrimaryKey($requestDate, $accountId)
    {
        $prefix = 'TK';

        // Get the memberId from the related userAccount
        $memberId = UserAccount::where('accountId', $accountId)->value('memberId');

        // Convert $transactionDate to a DateTime object if it's a string
        if (is_string($requestDate)) {
            $requestDate = new \DateTime($requestDate);
        }

        // Format the transactionDate (assuming $transactionDate is a valid DateTime object)
        $formattedDate = $requestDate->format('ymd');

        // Build the custom primary key
        $customPrimaryKey = $prefix . '-' . $memberId . '-' . $formattedDate;

        return $customPrimaryKey;
    }
}
