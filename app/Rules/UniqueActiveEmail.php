<?php
 
namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
 
class UniqueActiveEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!User::where('email', $value)->where('status', '!=', 3)->exists()) {
            $fail('Email sudah ada');
        }
    }
}