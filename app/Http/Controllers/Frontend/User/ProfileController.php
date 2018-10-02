<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;

use App\Models\Auth\User;
use PragmaRX\Google2FA\Google2FA;

use Auth;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Request;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function editpageView()
    {
        return view("frontends.user.editprofile");
    }

    public function register2fa()
    {
        //work for 2fa
        $google2fa = new Google2FA();    
        $companyName = env('APP_NAME');
        $companyEmail= Auth::user()->username;
        $secretKey   = $google2fa->generateSecretKey();
        $result['google2fa']=$secretKey;
        $result['image_url']=$google2fa->getQRCodeInline(
                                            $companyName,
                                            $companyEmail,
                                            $secretKey
                                        );
        echo json_encode($result);
    }
 

    public function changePasswordView()
    {
        return view("frontends.user.changepassword");
    }
    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        $output = $this->userRepository->update(
            $request->user()->id,

            // $request->only('first_name', 'last_name', 'email', 'avatar_type', 'avatar_location', 'timezone','phone', 'blurb', 'gender','google2fa_secret'),

            $request->only('first_name', 'last_name', 'email', 'avatar_type', 'avatar_location', 'timezone', 'blurb', 'gender','country_code', 'authentication_type','google2fa_secret'),
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {
            auth()->logout();

            return redirect()->route('frontend.auth.login')->withFlashInfo(__('strings.frontend.user.email_changed_notice'));
        }

        return redirect()->route('frontend.user.account')->withFlashSuccess(__('strings.frontend.user.profile_updated'));
    }


    public function getUserPicture($userId)
    {
        $user = User::find($userId);
        return $user->picture;
    }


    public function updatePhoneAndSendOTP(Request $request)
    {
        $user = User::find($request->id);
        if(!empty($user))
        {
            $otp = rand(1000, 9999);
            $user->phone_otp = $otp;
			$user->save();
            // $message = "Verification code: $otp for ".url('/').". Don't send this to anyone";
            $message = "Dear $user->username, Your mobile verification code is $otp. Team CrypScrow";
            $url = "http://api.msg91.com/api/sendhttp.php?sender=".env('MSG91_NAME')."&route=4&mobiles=".$request->phone."&authkey=".env('MSG91_KEY')."&country=".$request->country_code."&message=".$message."";
            $response = Curl::to($url)
                            ->get();
            return $response;
        } 
        
    }


    /**
     * @param $token
     *
     * @return mixed
     */
    public function confirmPhone(Request $request)
    {
        $user = User::find($request->id);
        $otp = $request->otp;
		$phone = $request->phone;
		$country_code = $request->country_code;
        $data = $this->userRepository->confirmPhoneProfile($otp,$phone,$country_code);
        return $data;
      
    }


    public function generateQr(Request $request)
    {
        if(auth()->user()->google2fa_flag == 0)
        {
            $google2fa = app('pragmarx.google2fa');

            // save the registration data in an array
            
            // add the secret key to the registration data
            $google2fa_secret = $google2fa->generateSecretKey();

            // save the registration data to the user session for just the next request
            auth()->user()->google2fa_secret  = $google2fa_secret;
            auth()->user()->save();
            // generate the QR image
            $QR_Image = $google2fa->getQRCodeInline(
                config('app.name'),
                auth()->user()->email,
                $google2fa_secret);

            // Pass the QR barcode image to our view.
            return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $google2fa_secret]);
        }else{
            return "already";
        }
    }

    
}
