<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authentication.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_kp' => 'required|string|size:12|unique:users',
            'no_telefon' => 'required|string|max:15',
        ], [
            'name.required' => 'Nama penuh wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak sah',
            'email.unique' => 'Email telah digunakan',
            'password.required' => 'Kata laluan wajib diisi',
            'password.min' => 'Kata laluan minimum 8 aksara',
            'password.confirmed' => 'Pengesahan kata laluan tidak sepadan',
            'no_kp.required' => 'No. KP wajib diisi',
            'no_kp.size' => 'No. KP mesti 12 digit',
            'no_kp.unique' => 'No. KP telah didaftarkan',
            'no_telefon.required' => 'No. telefon wajib diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Create new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_kp' => $request->no_kp,
                'no_telefon' => $request->no_telefon,
                'role' => 'pemohon', // Default role
            ]);

            return redirect()->route('login')
                ->with('success', 'Pendaftaran berjaya! Sila log masuk dengan akaun anda.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ralat berlaku semasa pendaftaran. Sila cuba lagi.')
                ->withInput();
        }
    }
}
