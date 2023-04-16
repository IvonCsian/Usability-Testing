<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Check if another user is already logged in with this account
        if (Auth::guard('admin')->check()) {
            $response = [
                'success' => false,
                'message' => 'Login Gagal, Akun ini sedang digunakan',
                'data' => null,
            ];
            return view('multiple-login', $response);
        }

        else if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::guard('admin')->user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            session(['bearer_token' => $success['token']]);

//            return response()->json([
//                'success' => true,
//                'message' => 'Login Sukses',
//                'data' => $success
//            ]);

            return redirect()->route('admin')->with('token', $success['token']);

        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal',
                'data' => null,
            ]);
        }
    }
    public function logout(Request $request)
    {
        // Revoke the token for the authenticated user
        $request->user('admin')->tokens()->delete();

        // Clear the authentication information for the user
        Auth::guard('admin')->logout();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (Auth::guard('admin')->check()) {
           return 'masih log in boss';
        }
        else {
            session()->forget('bearer_token');
        }

        return redirect()->route('admin.login');
    }
}
