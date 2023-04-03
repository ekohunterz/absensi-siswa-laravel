<?php

namespace App\Exports;

use App\Models\Absen;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class RekapExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('guru.absen.cetak', [
            'data' => $this->data
        ]);
    }


}
