<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index()
    {
        // $account = Account::all();
        // return view('admin.chart-of-account', compact('account'));

        // $account = Account::with('category')->get();
        // return view('admin.chart-of-account', compact('account'));

        // $nodes = Account::get()->toTree();

        // $account = Account::where('parent_id', null)->withDepth()->reversed()->with('ancestors')->get()->toFlatTree();
        $account = Account::with('category')->withDepth()->with('ancestors')->get()->toTree();
        // dd($account);
        return view('admin.chart-of-account', compact('account'));
    }

    public function create()
    {
        $category = AccountCategory::where('active', 1)->get();
        $account = Account::all(); // Get only root accounts initially
        return view('admin.chart-of-account-create', compact('category','account'));
    }

    public function getAccountsByCategory(Request $request)
    {
        $categoryId = $request->input('categoryID');
        $account = Account::where('categoryID', $categoryId)->get();

        return response()->json($account);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'name' => $request->input('name'),
                'accountNo' => $request->input('accountNo'),
                'categoryID' => $request->input('categoryID'),
                'parentID' => $request->input('parentID'),
                'accountRelation' => $request->input('accountRelation'),
            ],
            [
                'name' => [
                    'required',
                    Rule::unique('account')->where(function ($query) use ($request) {}),
                ],
                'accountNo' => [
                    'required',
                    Rule::unique('account')->where(function ($query) use ($request) {}),
                ],
                'categoryID' => 'required',
                'parentID' => 'nullable|exists:account,id',
                'accountRelation' => 'required|in:none,header,child',
            ],
            [
                'name.required' => 'Nama akun belum diisi',
                'name.unique' => 'Nama akun sudah dipakai, mohon untuk pilih nama akun yang lain',
                'accountNo.required' => 'Nomor akun belum diisi',
                'accountNo.unique' => 'Nomor akun sudah dipakai, mohon untuk pilih nomor akun yang lain',
                'categoryID.required' => 'Kategori akun belum dipilih',
                'parentID.exists' => 'XXXX',
                'accountRelation.required' => 'Relasi akun belum dipilih',
                'accountRelation.in' => 'Relasi akun tidak valid',
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

            // Create a new account
            $newAccount = new Account([
                'name' => $input['name'],
                'accountNo' => $input['accountNo'],
                'categoryID' => $input['categoryID'],
                'active' => $input['active'],
            ]);

            // Check if a parent account is selected
            if (isset($input['parentID'])) {
                if($input['accountRelation'] == 'child') {
                    $parentAccount = Account::find($input['parentID']);
                    $newAccount->appendToNode($parentAccount)->save();
                } elseif($input['accountRelation'] == 'header') {
                    dd($input['parentID']);
                    $parentAccount = Account::find($input['parentID']);
                    $newAccount->prependToNode($parentAccount)->save();
                }
            } else {
                $newAccount->saveAsRoot();
            }

            return redirect('/admin/account')->withSuccess('Data akun berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect('/admin/account')->with('errorData', $e->getMessage());
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
