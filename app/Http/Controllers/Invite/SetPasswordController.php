<?php

namespace App\Http\Controllers\Invite;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetPassword;
use View;
use Hash;
use App\User;

class SetPasswordController extends Controller
{

    /**
     * Where to redirect users after setting their password.
     *
     * @var string
     */
    protected $redirectTo = '/accepted';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function setPassword(SetPassword $request)
    {

    }
}
