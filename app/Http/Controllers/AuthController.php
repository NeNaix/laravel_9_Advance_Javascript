<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Validator;
class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login','register','refresh']]);
    }

    public function login(Request $request)
    {
        // if ($request->ajax()){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }


            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                if(auth()->user()->hasVerifiedEmail()) {
                    return response()->json([
                        'status' => 'Login Successfully',
                        'user' => auth()->user(),
                        'authorisation' => [
                            'token' =>  auth()->user()->createToken(time())->plainTextToken,
                            'type' => 'bearer',
                        ]
                    ],200);
                }else{
                    auth()->user()->sendEmailVerificationNotification();
                    auth()->guard('web')->logout();
                    return response()->json([
                        'message' => 'Email Not verified. We Send a new email veirification Please Click the link to Verify the Account'
                    ],200);
                }
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized : check your Email, Password and Email verification',
            ], 401);

        // }

    }

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
                'lname'=> 'required|min:2',
                'fname'=> 'required|min:2',
                'address'=>'required',
        ]);

        if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'lname'=> $request['lname'],
            'fname'=> $request['fname'],
            'address'=> $request['address'],
            'email'=> $request['email'],
            'role'=> $request['role'],
            'img'=> 'storage/images/tao.png',
            'password'=> Hash::make($request['password']),
        ]);


        event(new Registered($user));
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        Auth::user()->sendEmailVerificationNotification();
        auth()->guard('web')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function logout() {
        auth()->guard('web')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh()
    {   
        if ($token = Auth::check()) {
            return response()->json([
                'status' => 'success',
                'user' => Auth::user(),
                'authorisation' => [
                    'token' => auth()->user()->createToken(time())->plainTextToken,
                    'type' => 'bearer',
                ]
            ]);
        }

        return response()->json([
            'status' => 'check',
            'message' => 'no user login',
        ], 200);
    }

}
