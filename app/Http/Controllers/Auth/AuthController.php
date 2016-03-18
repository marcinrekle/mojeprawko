<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use Socialite;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $redirectAfterLogout = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'osk_id' => 1,
            'is_admin' => '0',
        ]);
    }

     public function redirectToProvider($provider=null)
    {
        return Socialite::driver($provider)->redirect();
    }
 
    /**
     * Obtain the user information from Provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider=null)
    {
        var_dump($provider);
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('auth/' . $provider);
        }
 
        $authUser = $this->findOrCreateUser($user);
 
        Auth::login($authUser, true);
 
        return redirect('/');
    }
 
    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($socialUser)
    {
        $authUser = User::where('social_id', $socialUser->id)->first();
 
        //var_dump($authUser);
        
        if ($authUser){
            return $authUser;
        }

 
        $new = User::create([
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'password' => '',
            'social_id' => $socialUser->id,
            'avatar' => $socialUser->avatar,
            'social_token' => $socialUser->token,
            'osk_id' => 1,
            'is_admin' => '0',
        ]);

        $student = new Student;
        $student->hours_count = 30;
        $student->cost = 1400;
        $new->student()->save($student);

        //var_dump($socialUser);
        //dd($new);
        

        return $new;

        /*return User::create([
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'password' => '',
            'social_id' => $socialUser->id,
            'avatar' => $socialUser->avatar
        ]);*/

    }
}
