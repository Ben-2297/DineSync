<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'fname' => $input['fname'],
            'lname' => $input['lname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $userId = $user->id;

        Customer::create([
            'customer_id' => $userId,
            'fname' => $input['fname'],
            'lname' => $input['lname'],
        ]);

        return $user;
    }
}
