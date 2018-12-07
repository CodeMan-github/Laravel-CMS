<?php namespace App\Http\Controllers;

use App\Libraries\Utils;
use App\Settings;
use App\Users;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Input;
use Mail;
use Session;
use URL;
use Validator;

class AuthController extends Controller
{

    protected $loginPath = '/login';


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;



    }

    public function getLogin()
    {

        if (Input::has('setup')) {
            \Artisan::call('cache:clear');
            \Artisan::call('migrate', ['--force' => 'yes']);
        }

        return view('admin.login');
    }

    public function getCustomerLogin()
    {

        if (Input::has('setup')) {
            \Artisan::call('cache:clear');
            \Artisan::call('migrate', ['--force' => 'yes']);
        }

        return view('customer.login');
    }

    public function customerPostLogin(Request $request)
    {

        $v = Validator::make(
            ['email' => $request->input('email'), 'password' => $request->input('password')],
            ['email' => 'required|email', 'password' => 'required']
        );

        if ($v->fails()) {
            Session::flash('error_msg', Utils::messages($v));
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended('/customer');
        }

        Session::flash('error_msg', trans('messages.invalid_login_try_again'));

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function getCustomerRegister()
    {

        if (Input::has('setup')) {
            \Artisan::call('cache:clear');
            \Artisan::call('migrate', ['--force' => 'yes']);
        }

        return view('customer.register');
    }

    public function registerCustomer()
    {

        if (Input::has('setup')) {
            \Artisan::call('cache:clear');
            \Artisan::call('migrate', ['--force' => 'yes']);
        }

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        $v = \Validator::make([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Input::get('password'),

        ], [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',

        ]);

        if ($v->fails()) {
            Session::flash('error_msg', Utils::messages($v));
            return redirect()->back();
        }

        $user = new Users();
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->slug = "customer";

        $user->password = \Hash::make(Input::get('password'));

        $user->activated = 1;



        $user->save();


        Session::flash('success_msg', trans('messages.user_created_success'));
        return redirect()->back();
    }

    public function postLogin(Request $request)
    {

        $v = Validator::make(
            ['email' => $request->input('email'), 'password' => $request->input('password')],
            ['email' => 'required|email', 'password' => 'required']
        );

        if ($v->fails()) {
            Session::flash('error_msg', Utils::messages($v));
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended('/admin');
        }

        Session::flash('error_msg', trans('messages.invalid_login_try_again'));

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function getForgotPassword()
    {
        return view("admin.forgot-password");
    }

    public function postForgotPassword()
    {
        $email = Input::get("email");

        $user = Users::where('email', $email)->first();

        if (sizeof($user) <= 0) {
            Session::flash("error_msg", trans('messages.account_not_found_with_email'));
            return redirect()->back();
        } else {
            $reset_code = Utils::generateResetCode();
            $user->reset_password_code = $reset_code;
            $user->reset_requested_on = \Carbon\Carbon::now();
            $user->save();

            $email_arr = ['name' => $user->name,
                'reset_url' => URL::to('/') . "/reset_password/" . $user->email . "/" . $user->reset_password_code,
                'email' => $user->email];

            Mail::send('emails.reset_password', $email_arr, function ($message) use ($user) {
                $message->to($user->email, $user->name)->subject(trans('messages.rss_reset_password'));
            });

            Session::flash('success_msg', trans('messages.click_link_to_reset_password'));
            return redirect()->to('/forgot-password');
        }

    }

    public function getReset($email, $code)
    {

        if (strlen($email) <= 0 || strlen($code) <= 0) {
            Session::flash("error_msg", trans('messages.invalid_request_please_reset_password'));
            return redirect()->to('/forgot-password');
        }

        //Check code and email
        $user = Users::where('email', $email)->where('reset_password_code', $code)->first();

        if (sizeof($user) <= 0) {
            Session::flash("error_msg", trans('messages.invalid_request_please_reset_password'));
            return redirect()->to('/forgot-password');
        } else {
            //check for 24 hrs for token
            $reset_requested_on = \Carbon\Carbon::createFromFormat('Y-m-d G:i:s', $user->reset_requested_on);
            $present_day = \Carbon\Carbon::now();

            if ($reset_requested_on->addDay() > $present_day) {
                //Show new password view
                return view('admin.reset-password', ['email' => $email, 'code' => $code]);
            } else {
                Session::flash("error_msg", trans('messages.your_password_token_expired'));
                return redirect()->to('/forgot-password');
            }
        }
    }

    public function postReset()
    {

        $password = Input::get('password', '');
        $password_confirmation = Input::get('password_confirmation', '');

        if ($password == $password_confirmation) {

            $validate_reset = Users::where('email', Input::get('email', ''))->where('reset_password_code', Input::get('code', ''))->first();

            if (sizeof($validate_reset) > 0) {
                $user = Users::where('email', Input::get('email'))->first();
                $user->password = \Hash::make($password);
                $user->save();

                Session::flash('success_msg', trans('messages.your_password_changed_success'));
                return redirect()->to('/login');
            } else {
                Session::flash('error_msg', trans('messages.an_invalid_password_entered'));
                return redirect()->back();
            }
        } else {
            Session::flash('error_msg', trans('messages.both_new_confirm_must_be_same'));
            return redirect()->back();
        }
    }

    public function getLogout()
    {
        $this->auth->logout();

        return redirect('/login');
    }

    public function getCustomerLogout()
    {
        $this->auth->logout();

        return redirect('/customer/login');
    }


}
