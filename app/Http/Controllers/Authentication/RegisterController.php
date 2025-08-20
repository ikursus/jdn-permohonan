<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone' => 'required|string|max:15',
        ]);

        try {
            // Create new user
            $data['password'] = bcrypt($data['password']);
            
            DB::table('users')->insert($data);

            return redirect()->route('login')
                ->with('success', 'Pendaftaran berjaya! Sila log masuk dengan akaun anda.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ralat berlaku semasa pendaftaran. Sila cuba lagi.')
                ->withInput();
        }
    }
}
