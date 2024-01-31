<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        return (view('admin.journal'));
    }

    public function create()
    {
        //
        return (view('admin.journal-create'));
    }

    public function store(Request $request)
    {
        //
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
