<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\User;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout() {
      $correo = Auth::user()->email;
      session(['correo' => $correo ]);
      Auth::logout();
      return redirect()->route('login');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
     public function redirectToProvider($provider)
     {
       return Socialite::driver($provider)->redirect();
     }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
     public function handleProviderCallback($provider)
     {
       try
          {
            //El controlador que obtiene la informacion de google
            $user = Socialite::driver($provider)->user();
            // var_dump($user);
            // return $user->token;
          }
       catch(\Exception $e)
          {
            return redirect('/');
          }

          $find = User::whereEmail($user->email)->first();
          if ($find) {
            Auth::login($find);
            return redirect('/home');
          }
          else {
            // echo 'No permitido';
            notificationMsg('danger', 'Operation Abort! La cuenta de Gmail asociada, no está registrada en el sistema. Nota: Comunicarse con el administrador para obtener permisos necesarios..!!');
            return redirect('/');
          }

     }
}
