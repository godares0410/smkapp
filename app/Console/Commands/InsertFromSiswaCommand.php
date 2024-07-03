<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SiswaAlpaController;

class InsertFromSiswaCommand extends Command
{
    protected $signature = 'siswa:insert-from-siswa';

    protected $description = 'Insert data into siswa_alpa from siswa table.';

    public function handle()
    {
        $controller = new SiswaAlpaController();
        $controller->insertFromSiswa();
    }
}
