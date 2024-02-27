<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::orderBy('kind')->get();
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
        return view('admin.config-edit', compact('config'));
    }

    public function update(Request $request, Config $config)
    {
        // dd($request);
        $validator = Validator::make(
            [
                'name' => $request->input('name'),
                'value' => $request->input('value')
            ],
            [
                'name' => 'nullable|exists:config,name',
                'value' => 'required',
            ],
            [
                'name.exists' => 'Nama konfigurasi tidak valid',
                'value.required' => 'Nilai konfigurasi belum diisi'
            ],
            );
            
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $input = $request->all();

            DB::beginTransaction();
            $config->update($input);
            DB::commit();

            return redirect('/admin/config')->withSuccess('Data konfigurasi berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/admin/config')->with('errorData', $e->getMessage());
        }
    }

    public function destroy(Config $config)
    {
        //
    }
}
