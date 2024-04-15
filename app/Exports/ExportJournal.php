<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AccountTransaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportJournal implements FromView
{
    public function view(): View
    {
        // return view('admin.report.excel.journal-export', [
        //     'dataReport' => User::orderBy('id', 'desc')->get()
        // ]);

        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');

        $transaction = AccountTransaction::with('debitDetail', 'creditDetail')->whereBetween('transactionDate', [$startDate, $endDate])->orderBy('transactionDate', 'desc')->get();

        $totalDebit = $transaction->sum(function ($item) {
            return $item->debitDetail->sum('total');
        });
        $totalCredit = $transaction->sum(function ($item) {
            return $item->creditDetail->sum('total');
        });

        return view('admin.report.excel.journal-export', compact('transaction', 'totalDebit', 'totalCredit', 'startDate', 'endDate'));
    }
}
