<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function create()
    {
        return view('pendaftaran');
    }

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'title_id' => 'nullable|string|max:255',
        'title_en' => 'nullable|string|max:255',
        'thumbnail' => 'nullable|string|max:255',
        'thumbnail_id' => 'nullable|string|max:255',
        'thumbnail_en' => 'nullable|string|max:255',
        'content' => 'nullable|string',
        'content_id' => 'nullable|string',
        'content_en' => 'nullable|string',
        'link' => 'nullable|string|max:255',
    ]);

    Pendaftaran::create($request->all());

    return redirect()->route('pendaftaran.form')->with('success', 'Pendaftaran berhasil!');
}


    public function index()
    {
        $data = Pendaftaran::all();
        return view('admin.pendaftaran.index', compact('data'));
    }
}
