<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UserRegisterWizard extends Component
{
    use WithFileUploads;
    
    public $currentStep = 1;
    public $fname, $lname, $birthdate, $birthplace, $address, $workAddress, $email, $phone, $mothername, $method, $simpanan, $ktp, $kk;
    public $successMessage = '';

    public function render()
    {
        return view('livewire.user-register-wizard');
    }

    public function firstStepSubmit()
    {
        // $this->validate(
        //     // [
        //     //     'fname' => 'required',
        //     //     'lname' => 'required',
        //     //     'birthdate' => 'required|date|before:' . now()->subYears(17)->format('Y-m-d'),
        //     //     'birthplace' => 'required',
        //     //     'address' => 'required',
        //     //     'workAddress' => 'required',
        //     //     'email' => 'required|email|unique:users,email',
        //     //     'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
        //     //     'mothername' => 'required'
        //     // ],
        //     // [
        //     //     'fname.required' => 'Nama depan belum diisi',
        //     //     'lname.required' => 'Nama belakang belum diisi',
        //     //     'birthdate.required' => 'Tanggal lahir belum diisi',
        //     //     'birthdate.date' => 'Tanggal lahir tidak valid',
        //     //     'birthdate.before' => 'Anggota UBSP harus berusia minimal 17 tahun',
        //     //     'birthplace.required' => 'Tempat lahir belum diisi',
        //     //     'address.required' => 'Alamat tinggal belum diisi',
        //     //     'workAddress.required' => 'Alamat kerja belum diisi',
        //     //     'email.required' => 'Email belum diisi',
        //     //     'email.unique' => 'Email sudah ada',
        //     //     'email.email' => 'Email tidak valid',
        //     //     'phone.required' => 'No Hp belum diisi',
        //     //     'phone.min' => 'No Hp tidak valid',
        //     //     'phone.regex' => 'No Hp tidak valid',
        //     //     'mothername.required' => 'Nama ibu kandung belum diisi'
        //     // ]

        //     [
        //         'ktp' => 'required|image',
        //         'kk' => 'required|image'
        //     ],
        //     [
        //         'ktp.required' => 'Foto KTP belum diisi',
        //         'ktp.image' => 'Foto KTP tidak valid',
        //         'kk.required' => 'Foto KK belum diisi',
        //         'kk.image' => 'Foto KK tidak valid'
        //     ],
        // );
        
        if (!$this->ktp && !$this->kk) {
            $this->addError('ktp', 'At least one file must be uploaded');
            $this->addError('kk', 'At least one file must be uploaded');
        }
    
        // Perform validation if at least one file is uploaded
        if ($this->ktp || $this->kk) {
            dd($this);
            $this->validate(
                [
                    'ktp' => 'required|image',
                    'kk' => 'required|image'
                ],
                [
                    'ktp.required' => 'Foto KTP belum diisi',
                    'ktp.image' => 'Foto KTP tidak valid',
                    'kk.required' => 'Foto KK belum diisi',
                    'kk.image' => 'Foto KK tidak valid'
                ]
            );
        }
 
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate(
            [
                'ktp' => 'required|image',
                'kk' => 'required|image'
            ],
            [
                'ktp.required' => 'Foto KTP belum diisi',
                'ktp.image' => 'Foto KTP tidak valid',
                'kk.required' => 'Foto KK belum diisi',
                'kk.image' => 'Foto KK tidak valid'
            ],
        );
  
        $this->currentStep = 3;
    }

    public function thirdStepSubmit()
    {
        $this->validate(
            [
                'method' => 'required|in:cash,transfer',
                'simpanan' => 'required_if:method,transfer'
            ],
            [
                'method.required' => 'Jenis pembayaran belum diisi',
                'method.in' => 'Jenis pembayaran tidak valid',
                'simpanan.required_if' => 'Bukti pembayaran belum diisi'
            ],
        );
  
        $this->currentStep = 4;
    }

    public function submitForm()
    {
        dd("submit");
        // Product::create([
        //     'name' => $this->name,
        //     'amount' => $this->amount,
        //     'description' => $this->description,
        //     'stock' => $this->stock,
        //     'status' => $this->status,
        // ]);
  
        // $this->successMessage = 'Product Created Successfully.';
  
        // $this->clearForm();
  
        $this->currentStep = 1;
    }

    public function back($step)
    {
        $this->currentStep = $step;    
    }

    public function clearForm()
    {
        dd("clear form");
        // $this->name = '';
        // $this->amount = '';
        // $this->description = '';
        // $this->stock = '';
        // $this->status = 1;
    }

}
