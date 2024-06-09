<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportDaftar implements FromView
{
    protected $pendaftar;

    public function __construct($pendaftar)
    {
        $this->pendaftar = $pendaftar;
    }

    public function view(): View
    {
        return view('data_ppdb.export', ['pendaftar' => $this->pendaftar]);
    }
}
