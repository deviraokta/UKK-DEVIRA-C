<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PeminjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjams =User::where('role' , 'peminjam')->get();

        return view('peminjam.index', compact('peminjams'));
    }

    public function edit(string $id)
    {
        $peminjam = User::findOrFail($id);
        return view('peminjam.edit', compact('peminjam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ],
        [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah ada.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah ada.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $data = $request->only('name', 'username', 'email');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $peminjam = User::findOrFail($id);
        $peminjam->update($data);
        return redirect()->route('peminjam.index')
            ->with('success', 'Peminjam berhasil diupdate.');

    }

        public function destroy(string $id)
        {
            $peminjam = User::findOrFail($id);
            $peminjam->delete();
            return redirect()->route('peminjam.index')
                ->with('success', 'Peminjam berhasil dihapus.');
    }
}
