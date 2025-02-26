<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends BaseTestCase
{
    public function signIn()
    {
        $user = User::factory()->create();
        Auth::login($user);

        return $user;
    }
}
