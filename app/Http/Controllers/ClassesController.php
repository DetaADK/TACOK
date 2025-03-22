<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = Classes::all();
        return view('clas.index', compact('classes'));
    }

    public function create()
    {
        return view('clas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        Classes::create($request->all());

        return redirect()->route('clas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }
}
