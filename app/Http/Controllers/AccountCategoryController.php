<?php

namespace App\Http\Controllers;

use App\Models\AccountCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AccountCategoryController extends Controller
{
    public function index()
    {
        //
        $category = AccountCategory::all();
        return view('admin.account-category', compact('category'));
    }

    public function create()
    {
        return view('admin.account-category-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'name' => $request->input('name'),
            ],
            [
                'name' => [
                    'required',
                    Rule::unique('account_category')->where(function ($query) use ($request) {
                        // Add conditions if needed to make the validation more specific
                        // For example, if you have a user_id associated with the record:
                        // $query->where('user_id', $request->user()->id);
                    }),
                ],
            ],
            [
                'name.required' => 'Nama kategori belum diisi',
                'name.unique' => 'Nama kategori sudah dipakai, mohon untuk pilih nama kategori yang lain',
            ],
        );
            
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        try {
            $input = $request->all();

            AccountCategory::create($input);

            return redirect('/admin/account_category')->withSuccess('Data kategori akun berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect('/admin/account_category')->with('errorData', $e->getMessage());
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(AccountCategory $accountCategory)
    {
        return view('admin.account-category-edit', compact('accountCategory'));
    }

    public function update(Request $request, AccountCategory $accountCategory)
    {
        $validator = Validator::make(
            [
                'name' => $request->input('name'),
            ],
            [
                'name' => [
                    'required',
                    Rule::unique('account_category')->ignore($accountCategory->id),
                ],
            ],
            [
                'name.required' => 'Nama kategori belum diisi',
                'name.unique' => 'Nama kategori sudah dipakai, mohon untuk pilih nama kategori yang lain',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if(!$request->has('active')) {
            $request->merge(['active'=>'0']);
        } else {
            $request->merge(['active'=>'1']);
        }

        try {
            $input = $request->all();

            $accountCategory->update($input);

            return redirect('/admin/account_category')->withSuccess('Data kategori akun berhasil diupdate!');
        } catch(\Exception $e) {
            return redirect('/admin/account_category')->with('errorData', $e->getMessage());
        }
    }

    public function destroy(AccountCategory $accountCategory)
    {
        try {
            $accountCategory->delete();

            return redirect('/admin/account_category')->withSuccess('Data kategori akun berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect('/admin/account_category')->with('errorData', $e->getMessage());
        }
    }
}
