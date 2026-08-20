<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Display the password reset form.
     *
     * @param  string  $token
     * @return \Illuminate\Contracts\View\View
     */
    public function showResetPasswordForm(Request $request, $token)
    {
        // dd($request->email);
        $email = $request->email;
        return view('auth.reset-password', ['token' => $token])->with('email', $email);
    }

    /**
     * Reset the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = User::where('email',$request->email)->first();
        // dd($user);
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('login')->with('status', 'Your password has been reset successfully.');
    }

        
}
