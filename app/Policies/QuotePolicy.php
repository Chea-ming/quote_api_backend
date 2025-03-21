<?php

// app/Policies/QuotePolicy.php
namespace App\Policies;

use App\Models\Quote;
use App\Models\User;

class QuotePolicy
{
    // Method to determine if the user can delete a quote

    public function delete(User $user, Quote $quote)
    {
        return $user->id === $quote->user_id;
    }
}