<?php

namespace App\Helpers;

use App\Constants\AccountTypes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserHelper {
    public static function checkUserType(string $accountType): bool
    {
        return Auth::user() && User::findCurrent()->account_type === $accountType;
    }
}