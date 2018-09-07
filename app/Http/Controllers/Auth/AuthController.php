<?php

namespace App\Http\Controllers\Auth;
use Hash;
use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
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
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getRegister(){
        return view('auth.register');
    }

    public function postRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect() -> back()
                ->withInput()
                ->withErrors($validator->errors());
        }
        
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);/* Hash::make($request->password)*/
        $data->remember_token = $request->_token;
        $data->save();
        
        // return response()->json([
        //     'status' => 200,
        //     'message' => 'User created successfully',
        //     'data' => $data
        // ])->setStatusCode(200);
        
        return redirect('login')->with('success', 'Successful account registration...');
    }

    
    public function getLogin(){
        return view('auth.login');
    }

    public function postlogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect() -> back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        $auth = array(
            'email' => $request->email,
            'password' => $request->password
        );

        $token = null;
        try {
            if (!$token = JWTAuth::attempt($auth)) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        
        if(Auth::attempt($auth)){
            $result = response()->json(compact('token'));
            // return $result;
            return redirect('form/add-task')->with('success', 'You are now logged in...');
        }else{
            return redirect('login')->with('error', 'Wrong login account...');
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect('login')->with('success', 'You have logged out of the account...');
    }

    public function getAuthUser(Request $request){
        return view('auth.infor-user');
        // $user = JWTAuth::toUser($request->token);
        // return response()->json(['result' => $user]);
    }

    public function testAuthen(Request $request){
        return "OK";
    }
}
