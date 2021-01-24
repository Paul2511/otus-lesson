<?php


namespace App\Http\ViewModels\Auth;

use App\Http\ViewModels\ViewModel;
use App\Models\User;
class LoginAuthViewModel extends ViewModel
{
    public function __construct(string $token)
    {
        /** @var User $user */
        $user = auth()->user();

        $this->data['accessToken'] = $token;
        $this->data['userData'] = $user->toArray();
    }
}