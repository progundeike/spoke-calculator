<?php

namespace App\Http\Controllers\Auth;

use App\Mail\RegisteredNotification;
use App\Http\Controllers\Controller;
use App\Jobs\SendRegistrationMail;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Notifications\RegisterNotification;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * ユーザー登録後、入力画面に遷移する
     * @param UserCreateRequest $request
     * @return RedirectResponse
     */
    public function register(UserCreateRequest $request)
    {
        $user = User::create([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //メール送信
        $user->sendRegisterNotification();

        $this->guard()->login($user);
        return redirect()->route('input');
    }
}
