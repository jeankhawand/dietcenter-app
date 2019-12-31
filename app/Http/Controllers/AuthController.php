<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $http = new \GuzzleHttp\Client;
        $secret = DB::table('oauth_clients')->where('id', 2)->first();
        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $secret->id,
                    'client_secret' => $secret->secret,
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
//            dd($response->getBody()->getContents()); for debugging

            return  $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());

            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:User',
            'password' => 'required|string|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);
        return response()->json('user created');
    }
    public function logout()
    {
        auth()->user()->tokens->each(function ($token) {
            $token->delete();
        });
        return response()->json('Logged out successfully', 200);
    }
}
