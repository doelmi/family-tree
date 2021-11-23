<?php

namespace App\Rules;

use App\Partner;
use App\Person;
use Illuminate\Contracts\Validation\Rule;

class PersonDeleteRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $asParent = Person::where('father_id', $value)->orWhere('mother_id', $value)->count() == 0;
        $asPartner = Partner::where('husband_id', $value)->orWhere('wife_id', $value)->count() == 0;

        return $asParent && $asPartner;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.delete_forbidden');
    }
}
