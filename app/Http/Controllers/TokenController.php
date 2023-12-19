<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
<<<<<<<< HEAD:app/Http/Controllers/TokenController.php
========
use App\Models\Makanan;
>>>>>>>> 9f5d545 (first commitu):app/Http/Controllers/MakananController.php
use Illuminate\Http\Request;
use App\Models\Token;

<<<<<<<< HEAD:app/Http/Controllers/TokenController.php
class TokenController extends Controller
========
class MakananController extends Controller
>>>>>>>> 9f5d545 (first commitu):app/Http/Controllers/MakananController.php
=======
<<<<<<<< HEAD:app/Http/Controllers/MakananController.php
use App\Models\Makanan;
========
>>>>>>>> 680cd4c (first commit):app/Http/Controllers/TokenController.php
use Illuminate\Http\Request;
use App\Models\Token;

<<<<<<<< HEAD:app/Http/Controllers/MakananController.php
class MakananController extends Controller
========
class TokenController extends Controller
>>>>>>>> 680cd4c (first commit):app/Http/Controllers/TokenController.php
>>>>>>> e8f7dd6 (first commit)
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
<<<<<<<< HEAD:app/Http/Controllers/TokenController.php
        $token = Token::value('token');
        return view ('token.index', compact('token'));
========
=======
<<<<<<<< HEAD:app/Http/Controllers/MakananController.php
>>>>>>> e8f7dd6 (first commit)
        $tipeMakanan = request('tipe_makanan'); // Ambil parameter 'tipe_makanan' dari URL
        $makanans = Makanan::when($tipeMakanan, function ($query) use ($tipeMakanan) {
            return $query->whereJsonContains('tipe_makanan', $tipeMakanan);
        })->get();
        return view('test.test', compact('makanans'));
<<<<<<< HEAD
>>>>>>>> 9f5d545 (first commitu):app/Http/Controllers/MakananController.php
=======
========
        $token = Token::value('token');
        return view ('token.index', compact('token'));
>>>>>>>> 680cd4c (first commit):app/Http/Controllers/TokenController.php
>>>>>>> e8f7dd6 (first commit)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validasi formulir
         $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'tipe_makanan' => 'required|array',
        ]);

        // Mengonversi array ke dalam format yang sesuai untuk penyimpanan
        $tipeMakanan = json_encode($request->tipe_makanan);

        // Proses penyimpanan data
        $makanan = new Makanan([
            'nama_makanan' => $request->nama_makanan,
            'tipe_makanan' => $tipeMakanan,
        ]);

        $makanan->save();

        // Tampilkan pesan sukses
        return "Data Makanan berhasil disimpan!";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $token = $request->input('token');

        Token::where('id', 1)->update(['token' => $token]);
        return redirect()->back()->with('success', 'Token Berhasil Dibuat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
