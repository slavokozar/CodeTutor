<?php

namespace App\Http\Controllers\Auth;

use App\_Classes\UUID;
use App\Models\School;
use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Validator;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\RegistersUsers;


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
     * Where to redirect users after login / registration.
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
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'school_id' => 'required',
            'date' => ['required', 'regex:/^(([1-9])|([12][0-9])|(3[01]))(( )?[.\/-]( )?)(([0]?[1-9])|(1[012]))(( )?[.\/-]( )?)(19|20)?[0-9][0-9]$/'],
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $user->notify(new UserRegistered($user));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new profile instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {

        do {
            $code = new UUID;
            $code = $code->limit(6, 4);
        } while (count(User::where('code', $code)->get()) > 0);

        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'code'     => $code,
            'school_id'=> $data['school_id'],
            'birthdate'=> date('Y-m-d H:i:s', strtotime($data['date'])),
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm(){
        $schools = School::all();

//        return $schools;
        return view('auth.register', compact(['schools']));

    }

}
