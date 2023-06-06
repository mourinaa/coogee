<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Validator;



// references: https://stackoverflow.com/questions/36883728/save-vs-update-in-laravel
class AuthController extends Controller
{



    /**
    * Create user
    *
    * @param  [string] name
    * @param  [string] email
    * @param  [string] password
    * @param  [string] password_confirmation
    * @return [string] message
    */
    public function update(Request $request, $id)
    {
        $userAt = User::find($id);

        if (!$userAt) {
             return response()->json([
                'error'=> 'No User Found'
            ], 405);
        }

        // $userAt->update([ 'name' => $request->name, ]);
        // return $userAt;


        if($userAt->update($request->all())) {
            return response()->json([
                'data' => $userAt
            ], 202);
        }

        return response()->json([
            'error'=> 'Failure Update User'
        ], 403);
    }




    /**
    * Create user
    *
    * @param  [string] name
    * @param  [string] email
    * @param  [string] password
    * @param  [string] password_confirmation
    * @return [string] message
    */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'c_password' => 'required|same:password'
        ]);

        $user = new User([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
            'message' => 'Successfully created user!',
            'accessToken'=> $token,
            ],201);
        }
        return response()->json([
            'error'=>'Provide proper details'
        ]);
    }

    
    /**
    * Login user and create token
    *
    * @param  [string] email
    * @param  [string] password
    * @param  [boolean] remember_me
    */

    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
        'remember_me' => 'boolean'
        ]);

        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
        'accessToken' =>$token,
        'token_type' => 'Bearer',
        ]);
    }


      /**
  * Get the authenticated User
  *
  * @return [json] user object
  */
  public function user(Request $request)
  {
    return response()->json($request->user());
  }


}
