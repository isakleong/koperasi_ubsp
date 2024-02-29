<?php

namespace App\Http\Controllers;
use App\Exports\ExportUser;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function exportData(Request $request) {
        switch ($request->input('action')) {
            case 'pdf':
                $status = $request->input('status');

                if (!empty($status)) {
                    $dataReport = User::where('status', 'IN', $status)->orderBy('id', 'desc')->get();
                } else {
                    $dataReport = User::orderBy('id', 'desc')->get();
                }

                $pdf = PDF::loadView('admin.report.anggota-report', compact('dataReport'));
                $pdf->setOption('enable-local-file-access', true);

	            return $pdf->download('Laporan Anggota UBSP.pdf');
                break;
            case 'excel':
                $status = $request->input('status');

                if (!empty($status)) {
                    $dataReport = User::where('status', 'IN', $status)->orderBy('id', 'desc')->get();
                } else {
                    $dataReport = User::orderBy('id', 'desc')->get();
                }
                
                return Excel::download(new ExportUser, "Laporan Anggota UBSP.xlsx");
                break;
        }   
    }
}
