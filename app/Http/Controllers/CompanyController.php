<?php


namespace App\Http\Controllers;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::all();
        return view('admin.company', compact('company'));
    }

    public function create()
    {
        return view('admin.company-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'name' => $request->input('name'),
                'about' => $request->input('about'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'whatsapp' => $request->input('whatsapp'),
                'logo' => $request->file('logo'),
            ],
            [
                'name' => 'required',
                'about' => 'required',
                'address' => 'required',
                'email' => 'required|email',
                'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                'whatsapp' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                'logo' => 'required|image',
            ],
            [
                'name.required' => 'Nama koperasi belum diisi',
                'about.required' => 'Tentang koperasi belum diisi',
                'address.required' => 'Alamat koperasi belum diisi',
                'email.required' => 'Email koperasi belum diisi',
                'email.email' => 'Email koperasi tidak valid',
                'phone.required' => 'No Hp koperasi belum diisi',
                'phone.min' => 'No Hp koperasi tidak valid',
                'phone.regex' => 'No Hp koperasi tidak valid',
                'whatsapp.required' => 'No Whatsapp koperasi belum diisi',
                'whatsapp.min' => 'No Whatsapp koperasi tidak valid',
                'whatsapp.regex' => 'No Whatsapp koperasi tidak valid',
                'logo.required' => 'Logo koperasi belum diisi',
                'logo.image' => 'Logo koperasi tidak valid',
            ],
            );
            
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $input = $request->all();

            if($logo = $request->file('logo')) {
                $destinationPath = 'image/upload/ubsp/';
                File::makeDirectory($destinationPath, 0777, true, true);
                $imageName = "profile_logo".".".$logo->getClientOriginalExtension();
                $input['logo'] = $destinationPath.$imageName;
            }

            DB::beginTransaction();
            
            Image::make($logo)->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($input['logo']);

            Company::create($input);

            DB::commit();

            return redirect('/admin/company')->withSuccess('Data profile UBSP berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/admin/company')->with('errorData', $e->getMessage());
        }
    }

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        return view('admin.company-edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validator = Validator::make(
            [
                'name' => $request->input('name'),
                'about' => $request->input('about'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'whatsapp' => $request->input('whatsapp'),
                'logo' => $request->file('logo'),
            ],
            [
                'name' => 'required',
                'about' => 'required',
                'address' => 'required',
                'email' => 'required|email',
                'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                'whatsapp' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                'logo' => 'required|image',
            ],
            [
                'name.required' => 'Nama koperasi belum diisi',
                'about.required' => 'Tentang koperasi belum diisi',
                'address.required' => 'Alamat koperasi belum diisi',
                'email.required' => 'Email koperasi belum diisi',
                'email.email' => 'Email koperasi tidak valid',
                'phone.required' => 'No Hp koperasi belum diisi',
                'phone.min' => 'No Hp koperasi tidak valid',
                'phone.regex' => 'No Hp koperasi tidak valid',
                'whatsapp.required' => 'No Whatsapp koperasi belum diisi',
                'whatsapp.min' => 'No Whatsapp koperasi tidak valid',
                'whatsapp.regex' => 'No Whatsapp koperasi tidak valid',
                'logo.required' => 'Logo koperasi belum diisi',
                'logo.image' => 'Logo koperasi tidak valid',
            ],
            );
            
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $input = $request->all();

            $logoDelete = "";
            if($logo = $request->file('logo')) {
                $logoDelete = public_path()."/".$company->logo;

                $destinationPath = 'image/upload/ubsp/';
                File::makeDirectory($destinationPath, 0777, true, true);
                $imageName = "profile_logo".".".$logo->getClientOriginalExtension();
                $input['logo'] = $destinationPath.$imageName;
            }

            DB::beginTransaction();

            $company->update($input);

            if (isset($input['logo'])) {
                Image::make($logo)->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($input['logo']);
            }

            if($logoDelete != "") {
                File::delete($logoDelete);
            }

            DB::commit();

            return redirect('/admin/company')->withSuccess('Data profile UBSP berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/admin/company')->with('errorData', $e->getMessage());
        }
    }

    public function destroy(Company $company)
    {
        try {
            $logoDelete = public_path()."/".$company->logo;

            DB::beginTransaction();

            $company->delete();
            
            File::delete($logoDelete);

            DB::commit();
            return redirect('/admin/company')->withSuccess('Data profile UBSP akun berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/admin/company')->with('errorData', $e->getMessage());
        }
    }
}
