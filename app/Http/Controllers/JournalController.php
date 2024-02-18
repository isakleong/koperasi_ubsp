<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JournalController extends Controller
{
    public function index()
    {
        return (view('admin.journal'));
    }

    public function create()
    {
        $account = Account::where('parent_id', null)->get();
        return (view('admin.journal-create', compact('account')));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'accountID.*' => 'required|exists:account,id',
                'debit.*' => 'required',
                'kredit.*' => 'required',
            ],
            [
                'accountID.*.required' => 'Akun belum dipilih',
                'debit.*.required' => 'Nominal debit belum diisi',
                'kredit.*.required' => 'Nominal kredit belum diisi',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            dd("hello");
        }
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
