<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\Journal;
use App\Models\JournalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JournalController extends Controller
{
    public function index()
    {
        // $transaction = AccountTransaction::with('debitDetail', 'creditDetail')->get();
        // return view('admin.journal', compact('transaction'));

        $transaction = AccountTransaction::with('debitDetail', 'creditDetail')->get();

        // Calculate total debit amount
        $totalDebit = $transaction->sum(function ($item) {
            return $item->debitDetail->sum('total');
        });

        $totalCredit = $transaction->sum(function ($item) {
            return $item->creditDetail->sum('total');
        });

        return view('admin.journal', compact('transaction', 'totalDebit', 'totalCredit'));
    }

    public function create()
    {
        $account = Account::where('parent_id', null)->get();
        return (view('admin.journal-create', compact('account')));
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'accountID.*' => 'required|exists:account,id',
        //     'debit.*' => 'required',
        //     'kredit.*' => 'required',
        // ], [
        //     'accountID.*.required' => 'Akun belum dipilih',
        //     'accountID.*.exists' => 'Akun tidak valid',
        //     'debit.*.required' => 'Nominal debit belum diisi',
        //     'kredit.*.required' => 'Nominal kredit belum diisi',
        // ]);

        $validator = Validator::make(
            $request->all(), 
            [
                "accountID"    => "required|array|min:2",
                "accountID.*"  => "required|exists:account,id",
                "debit"    => "required|array|min:2",
                "debit.*"  => "required",
                "kredit"    => "required|array|min:2",
                "kredit.*"  => "required",
            ],
            [
                'accountID.*.required' => 'Akun belum dipilih',
                'accountID.*.exists' => 'Akun tidak valid',
                'debit.*.required' => 'Nominal debit belum diisi',
                'kredit.*.required' => 'Nominal kredit belum diisi',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $docId = "sdsd";

        foreach ($request->input('accountID') as $key => $value) {
            $debit = intval(str_replace(['Rp', ','], '', $request->input('debit')[$key]));
            $kredit = intval(str_replace(['Rp', ','], '', $request->input('kredit')[$key]));
            $docId.=$key;

            JournalDetail::create([
                'docId' => $docId,
                'accountNo' => $value,
                'indexNo' => $key,
                'description' => $request->input('description')[$key],
                'debit' => $debit,
                'kredit' => $kredit,
            ]);
        }

        return redirect('/admin/journal/create')->withSuccess('Data jurnal berhasil ditambahkan!');


    }

    public function show(Journal $journal)
    {
        //
    }

    public function edit(Journal $journal)
    {
        //
    }

    public function update(Request $request, Journal $journal)
    {
        //
    }

    public function destroy(Journal $journal)
    {
        //
    }
}
