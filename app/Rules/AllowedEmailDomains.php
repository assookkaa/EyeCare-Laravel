<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AllowedEmailDomains implements Rule
{
    protected $allowedDomains = ['gmail.com', 'yahoo.com'];

    public function passes($attribute, $value)
    {
        $domain = explode('@', $value)[1];
        return in_array($domain, $this->allowedDomains);
    }

    public function message()
    {
        return 'The :attribute must be from gmail.com or yahoo.com domain.';
    }
}