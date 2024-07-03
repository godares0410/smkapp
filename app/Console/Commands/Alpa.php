<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\AbsenController;

class Alpa extends Command
{
    protected $signature = 'cek:alpa';
    protected $description = 'Cek siswa alpa setiap hari';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new AbsenController();
        $controller->alpa();
        $this->info('Cek alpa selesai');
    }
}

