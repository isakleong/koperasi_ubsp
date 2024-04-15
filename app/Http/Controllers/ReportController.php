<?php

namespace App\Http\Controllers;

use App\Exports\ExportJournal;
use App\Exports\ExportUser;
use App\Models\AccountTransaction;
use App\Models\User;
use Carbon\Carbon;
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
                    $dataReport = User::whereIn('status', $status)->orderBy('id', 'desc')->get();
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
                    $dataReport = User::whereIn('status', $status)->orderBy('id', 'desc')->get();
                } else {
                    $dataReport = User::orderBy('id', 'desc')->get();
                }
                
                return Excel::download(new ExportUser, "Laporan Anggota UBSP.xlsx");
                break;
        }   
    }

    public function exportJournal(Request $request) {
        switch ($request->input('action')) {
            case 'pdf':
                $status = $request->input('status');

                if (!empty($status)) {
                    $dataReport = User::whereIn('status', $status)->orderBy('id', 'desc')->get();
                } else {
                    $dataReport = User::orderBy('id', 'desc')->get();
                }

                $pdf = PDF::loadView('admin.report.anggota-report', compact('dataReport'));
                $pdf->setOption('enable-local-file-access', true);

	            return $pdf->download('Laporan Anggota UBSP.pdf');
                break;
            case 'excel':
                

                return Excel::download(new ExportJournal, "Laporan Anggota UBSPs.xlsx");

                // return view('admin.journal', compact('transaction', 'totalDebit', 'totalCredit', 'startDate', 'endDate'));


                // $status = $request->input('status');

                // if (!empty($status)) {
                //     $dataReport = User::whereIn('status', $status)->orderBy('id', 'desc')->get();
                // } else {
                //     $dataReport = User::orderBy('id', 'desc')->get();
                // }
                
                // return Excel::download(new ExportUser, "Laporan Anggota UBSP.xlsx");
                break;
        }
    }
}
