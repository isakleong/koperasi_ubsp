<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::all();
        return view('admin.config',compact('config'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Config $config)
    {
        //
    }

    public function edit(Config $config)
    {
        //
    }

    public function update(Request $request, Config $config)
    {
        //
    }

    public function destroy(Config $config)
    {
        //
    }
}
