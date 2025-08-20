<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Show the login form
     *
     * @return \Illuminate\View\View
     */
    public function borangLogin()
    {
        return view('authentication.template-login');
    }

    /**
     * Process login form submission
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function prosesBorangLogin(Request $request)
    {
        // $data = $request->input('username');
        // $data = $request->all();
        // $data = $request->only('username', 'password');
        // $data = $request->except('password');
        $data = $request->validate([
            'email' => 'required|email:filter', // string
            'password' => ['required', 'min:3'] // array
        ]);

        // $email = $_POST['username']; // $_REQUEST $_GET

        // return $data;


        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak sah',
            'password.required' => 'Kata laluan wajib diisi',
            'password.min' => 'Kata laluan minimum 6 aksara',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Selamat datang, ' . $user->name . '!');
            } else {
                return redirect()->intended(route('pemohon.dashboard'))
                    ->with('success', 'Selamat datang, ' . $user->name . '!');
            }
        }

        // Authentication failed
        return redirect()->back()
            ->withErrors([
                'email' => 'Email atau kata laluan tidak sah.',
            ])
            ->withInput($request->only('email'));
    }
}
