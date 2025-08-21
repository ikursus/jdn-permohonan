<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dapatkan senarai users daripada table users menerusi Query Builder
        // $senaraiUsers = DB::table('users')->latest('id')->get();
        $senaraiUsers = DB::table('users')->orderBy('id', 'asc')->get();

        // Kembalikan view dan passing data users
        return view('admin.users.template-index', compact('senaraiUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:filter|unique:users,email',
            'phone' => 'required',
            'password' => 'required|min:6',
            'status' => 'required|in:active,inactive',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Dapatkan data user berdasarkan id
        $user = DB::table('users')->where('id', $id)->first(); // LIMIT 1

        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User tidak ditemui');
        }

        // Kembalikan view dan passing data user
        return view('admin.users.template-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email:filter|unique:users,email,' . $id,
            'phone' => 'required',
            'status' => 'required|in:active,inactive,pending',
        ]);

        // Jika password diisi
        if ($request->password) {

            $request->validate([
                'password' => Password::min(4)
                ->letters()
                // ->mixedCase()
                // ->numbers()
                // ->symbols()
                // ->uncompromised()
            ]);

            $data['password'] = bcrypt($request->password);
        }

        // Dapatkan data user berdasarkan id
        $user = DB::table('users')->where('id', $id)->first(); // LIMIT 1

        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User tidak ditemui');
        }

        // Update data user
        DB::table('users')->where('id', $id)->update($data);

        // Kembalikan user ke halaman edit dengan mesej berjaya
        return redirect()->back()->with('success', 'User berjaya dikemaskini');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Dapatkan data user berdasarkan id
        $user = DB::table('users')->where('id', $id)->first(); // LIMIT 1

        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User tidak ditemui');
        }

        // Check if trying to delete currently logged in user
        if ($id == auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account');
        }

        // Padam data user
        DB::table('users')->where('id', $id)->delete();

        // Kembalikan user ke halaman index dengan mesej berjaya
        return redirect()->route('admin.users.index')->with('success', 'User berjaya dipadam');
        //
    }
}
