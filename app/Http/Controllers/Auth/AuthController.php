<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use Socialite;
use Auth;
use Validator;
use Cookie;
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

     public function redirectToProvider(Request $request, $provider=null)
    {
        return Socialite::driver($provider)->redirect();
    }
 
    /**
     * Obtain the user information from Provider.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request, $provider=null)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('auth/' . $provider);
        }
 
        $authUser = $this->findOrCreateUser($user, $request);
 
        Auth::login($authUser, true);
 
        return Auth::user()->is_admin ? redirect('/admin') : redirect('/student');
    }
 
    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($socialUser, $request)
    {
        $authUser = User::where('social_id', $socialUser->id)->first();
 
        //var_dump($authUser);
        
        if ($authUser){
            return $authUser;
        }

        $user = User::whereId($request->session()->pull('cuid', 'default'))->where('confirm_code', $request->session()->pull('ccode', 'default'))->whereConfirmed(false)->first();
        $user->social_id = $socialUser->id;
        $user->avatar = $socialUser->avatar;
        //$user->confirmed = true;//change - remove comment
        $user->save();
        
        Auth::login($authUser, true);
 
        return redirect('/')->withSuccess('Aktywacja konta zakończona.');


    }

    public function confirm(Request $request, $id, $code)
    {
        $user = User::whereId($id)->where('confirm_code', $code)->whereConfirmed(false)->first();
        if(! $user) {
            return redirect()->route('home')->withErrors("Próbujesz się podać za kogoś innego lub konto jest już aktywne");
        }
        $request->session()->put(['cuid' => $id, 'ccode' => $code]);
        return view('auth.confirm',compact('user','id','code'));
    }

    public function confirmSetPassword (Request $request)
    {
        $req = $request->all();
        $validator = $this->passwordValidator($req);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $user = User::whereId($req['id'])->where('confirm_code', $req['code'])->first();
        if($user){
            $user->password = bcrypt($req['password']);
            //$user->confirmed = true;//change - remove comment
            $user->save();
            //Auth::login($authUser, true);
            if (Auth::attempt(['email' => $user->email, 'password' => $user->$password, 'confirm' => true])) {
                return redirect()->route('student')->withSuccess('Aktywacja konta zakończona.');
            } else {
                return redirect()->route('home')->withSuccess('Aktywacja konta zakończona.');
            }
        } else {
            return redirect()->route('home')->withErrors("Próbujesz się podać za kogoś innego");
        }
    }

    protected function passwordValidator ( array $data) 
    {
        return Validator::make($data, [
            'password' => 'required|min:6|max:64',
        ]);
    }
}
