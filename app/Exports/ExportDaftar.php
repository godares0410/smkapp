<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromView;

class ExportDaftar implements FromView
{
    public function view(): View
    {
        $pendaftar = Pendaftaran::all();
        return view('data_ppdb.table', $pendaftar);
        // return view('data_ppdb.table', compact('pendaftar'));
    }
}
