<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dapatkan senarai users daripada table users menerusi Query Builder
        $senaraiUsers = DB::table('users')->get();

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
