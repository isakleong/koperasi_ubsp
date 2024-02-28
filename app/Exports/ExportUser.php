<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportUser implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     $data = User::orderBy('id', 'desc')->get();
    //     return $data;
    // }

    public function view(): View
    {
        return view('admin.report.excel.anggota-report', [
            'dataReport' => User::orderBy('id', 'desc')->get()
        ]);
    }
}
