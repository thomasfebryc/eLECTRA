<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Token;

class TokenController extends Controller
{
    // Tampilkan daftar semua token
    public function index()
    {
        $tokens = Token::all();
        return view('admin.tokens.index', compact('tokens'));
    }

    // Tampilkan form tambah token
    public function create()
    {
        return view('admin.tokens.create');
    }

    // Simpan token baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'harga'   => 'required|numeric',
            'stok'    => 'required|integer',
        ]);

        Token::create([
            'nama'    => $request->input('nama'),
            'nominal' => $request->input('nominal'),
            'harga'   => $request->input('harga'),
            'stok'    => $request->input('stok'),
        ]);

        return redirect()->route('admin.tokens.index')->with('success', 'Token berhasil ditambahkan!');
    }

    // Tampilkan form edit token
    public function edit(Token $token)
    {
        return view('admin.tokens.edit', compact('token'));
    }

    // Update data token yang sudah ada
    public function update(Request $request, Token $token)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'harga'   => 'required|numeric',
            'stok'    => 'required|integer',
        ]);

        $token->update([
            'nama'    => $request->input('nama'),
            'nominal' => $request->input('nominal'),
            'harga'   => $request->input('harga'),
            'stok'    => $request->input('stok'),
        ]);

        return redirect()->route('admin.tokens.index')->with('success', 'Token berhasil diperbarui!');
    }

    // Hapus token
    public function destroy(Token $token)
    {
        $token->delete();
        return redirect()->route('admin.tokens.index')->with('success', 'Token berhasil dihapus!');
    }
}
