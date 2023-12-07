<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MainController extends Controller
{
    public function test() {
        return view('auth.test');
    }

    public function index() {
        $user = Auth::user();
        return view('main.index', compact(['user']));
    }

    public function userActivation() {
        $user = Auth::user();
        return view('main.user-activation', compact(['user']));
    }

    public function showFormData() {
        $user = Auth::user();

        $parameter = Route::currentRouteName();

        if ($parameter == "add.simpanan") {
            return view('main.simpanan-add', compact(['user']));

        } elseif ($parameter == "recap.simpanan") {
            $startDate = Carbon::now()->subMonth();
            $transaction = Transaction::where('transactionDate', '>=', $startDate)
                            ->where('kind', 'not like', 'tabungan')
                            ->get();

            // $transaction = Transaction::all();

            //format total, tanggal
            $transactionData = $transaction->map(function ($item) {
                $item->total = 'Rp ' . number_format($item->total, 0, ',', ',');

                if ($item->transactionDate !== null) {
                    $item->transactionDate = Carbon::parse($item->transactionDate)->format('d-m-Y H:i:s');
                } else {
                    $item->transactionDate = "-";
                }

                if ($item->approvedOn !== null) {
                    $item->approvedOn = Carbon::parse($item->approvedOn)->format('d-m-Y H:i:s');
                } else {
                    $item->approvedOn = "-";
                }
                
                return $item;
            });
            
            return view('main.simpanan-recap', compact(['user','transactionData','transaction']));

        } elseif ($parameter == "add.tabungan") {
            return view('main.tabungan-add', compact(['user']));

        } elseif ($parameter == "recap.tabungan") {
            $startDate = Carbon::now()->subMonth();
            $transaction = Transaction::where('transactionDate', '>=', $startDate)
                            ->where('kind', 'like', 'tabungan')
                            ->get();

            //format total, tanggal
            $transactionData = $transaction->map(function ($item) {
                $item->total = 'Rp ' . number_format($item->total, 0, ',', ',');

                if ($item->transactionDate !== null) {
                    $item->transactionDate = Carbon::parse($item->transactionDate)->format('d-m-Y H:i:s');
                } else {
                    $item->transactionDate = "-";
                }

                if ($item->approvedOn !== null) {
                    $item->approvedOn = Carbon::parse($item->approvedOn)->format('d-m-Y H:i:s');
                } else {
                    $item->approvedOn = "-";
                }
                
                return $item;
            });

            return view('main.tabungan-recap', compact(['user', 'transactionData']));
        } elseif ($parameter == "add.kredit") {
            //check if user have outstanding loan
            $cntActiveLoan = UserAccount::where('memberId', $user->memberId)
                ->where('kind', 'kredit')
                ->where(function ($query) {
                    $query->whereNull('closedDate')
                        ->orWhereNull('openDate');
                })
                ->count();

            return view('main.kredit-add', compact(['user', 'cntActiveLoan']));

        } elseif ($parameter == "add.angsuran") {
            return view('main.angsuran-add', compact(['user']));

        } elseif ($parameter == "recap.kredit") {
            $startDate = Carbon::now()->subMonth();
            $loan = Loan::where('docId', 'like', '%' . $user->memberId . '%')->get();
            //format total, tanggal
            $loanData = $loan->map(function ($item) {
                $item->total = 'Rp ' . number_format($item->total, 0, ',', ',');

                if ($item->requestDate !== null) {
                    $item->requestDate = Carbon::parse($item->requestDate)->format('d-m-Y H:i:s');
                } else {
                    $item->requestDate = "-";
                }

                if ($item->approvedOn !== null) {
                    $item->approvedOn = Carbon::parse($item->approvedOn)->format('d-m-Y H:i:s');
                } else {
                    $item->approvedOn = "-";
                }
                
                return $item;
            });

            return view('main.kredit-recap', compact(['user', 'loanData']));

        } elseif ($parameter == "recap.angsuran") {
            $dataTotalKredit = 0;
            $dataRates = 0;
            $dataTenor = 0;
            $dataBaseCicilan = 0;
            $dataMonthlyCicilan = 0;
            $dataMonthlyRates = 0;

            $cntPendingLoan = UserAccount::where('memberId', $user->memberId)
                ->where('kind', 'kredit')
                ->where(function ($query) {
                    $query->whereNull('closedDate')
                        ->orWhereNull('openDate');
                })
                ->count();

            if($cntPendingLoan > 0) {
                //get current loan data
                $activeLoan = UserAccount::where('memberId', $user->memberId)
                ->where('kind', 'kredit')
                ->where(function ($query) {
                    $query->whereNull('closedDate')
                        ->orWhereNull('openDate');
                })
                ->first();

                $loan = Loan::where('accountId', $activeLoan['accountId'])->get();

                //format total, tanggal
                $loanData = $loan->map(function ($item) {
                    $loanDocId = $item->docId;

                    $item->total = 'Rp ' . number_format($item->total, 0, ',', ',');
                    $item->baseCicilan = 'Rp ' . number_format($item->baseCicilan, 0, ',', ',');
                    $item->monthlyCicilan = 'Rp ' . number_format($item->monthlyCicilan, 0, ',', ',');
                    $item->monthlyRates = 'Rp ' . number_format($item->monthlyRates, 0, ',', ',');

                    if ($item->requestDate !== null) {
                        $item->requestDate = Carbon::parse($item->requestDate)->format('d-m-Y H:i:s');
                    } else {
                        $item->requestDate = "-";
                    }

                    if ($item->approvedOn !== null) {
                        $item->approvedOn = Carbon::parse($item->approvedOn)->format('d-m-Y H:i:s');
                    } else {
                        $item->approvedOn = "-";
                    }
                    
                    return $item;
                });

                if(count($loanData) > 0) {
                    $dataTotalKredit = $loanData[0]->total;
                    $dataRates = $loanData[0]->rates;
                    $dataTenor = $loanData[0]->tenor;
                    $dataBaseCicilan = $loanData[0]->baseCicilan;
                    $dataMonthlyCicilan = $loanData[0]->monthlyCicilan;
                    $dataMonthlyRates = $loanData[0]->monthlyRates;

                    $loanDetail = LoanDetail::where('loanDocId', $loanData[0]->docId)->get();
                    //format total, tanggal
                    $loanDetailData = $loanDetail->map(function ($item) {
                        $item->total = 'Rp ' . number_format($item->total, 0, ',', ',');
                        $item->charges = 'Rp ' . number_format($item->charges, 0, ',', ',');

                        if ($item->dueDate !== null) {
                            $item->dueDate = Carbon::parse($item->dueDate)->format('d-m-Y');
                        } else {
                            $item->dueDate = "-";
                        }

                        if ($item->transactionDate !== null) {
                            $item->transactionDate = Carbon::parse($item->transactionDate)->format('d-m-Y H:i:s');
                        } else {
                            $item->transactionDate = "Belum bayar";
                        }

                        if ($item->approvedOn !== null) {
                            $item->approvedOn = Carbon::parse($item->approvedOn)->format('d-m-Y H:i:s');
                        } else {
                            $item->approvedOn = "-";
                        }
                        
                        return $item;
                    });
                }

                $arrDataHeader = [];
                $arrDataHeader[0]["totalKredit"] = $dataTotalKredit;
                $arrDataHeader[0]["rates"] = $dataRates;
                $arrDataHeader[0]["tenor"] = $dataTenor;
                $arrDataHeader[0]["baseCicilan"] = $dataBaseCicilan;
                $arrDataHeader[0]["monthlyCicilan"] = $dataMonthlyCicilan;
                $arrDataHeader[0]["monthlyRates"] = $dataMonthlyRates;

                return view('main.angsuran-recap', compact(['user', 'loanData', 'arrDataHeader', 'loanDetailData']));
            } else {
                $loanData = [];
                $loanDetailData = [];

                $arrDataHeader = [];
                $arrDataHeader[0]["totalKredit"] = $dataTotalKredit;
                $arrDataHeader[0]["rates"] = $dataRates;
                $arrDataHeader[0]["tenor"] = $dataTenor;
                $arrDataHeader[0]["baseCicilan"] = $dataBaseCicilan;
                $arrDataHeader[0]["monthlyCicilan"] = $dataMonthlyCicilan;
                $arrDataHeader[0]["monthlyRates"] = $dataMonthlyRates;
                return view('main.angsuran-recap', compact(['user', 'loanData', 'arrDataHeader', 'loanDetailData']));
            }

        } elseif ($parameter == "edit.profile") {
            return view('main.profile-edit', compact(['user']));

        } elseif ($parameter == "edit.password") {
            return view('main.password-edit', compact(['user']));

        }
    }

    public function filterRecapSimpanan(Request $request) {
        $validator = Validator::make(
            [
                'startDate' => $request->input('startDate'),
                'endDate' => $request->input('endDate'),
            ],
            [
                'startDate' => 'required|date',
                'endDate' => 'required|date|after_or_equal:startDate|max_one_month_difference:startDate|before_or_equal:' . now()->toDateString(),
            ],
            [
                'startDate.required' => 'Tanggal awal belum dipilih',
                'startDate.date' => 'Tanggal awal tidak valid',
                'endDate.required' => 'Tanggal akhir belum dipilih',
                'endDate.date' => 'Tanggal akhir tidak valid',
                'endDate.after_or_equal' => 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal',
                'endDate.before_or_equal' => 'Limit periode pencarian adalah 1 bulan',
                'endDate.max_one_month_difference' => 'Limit periode pencarian adalah 1 bulan',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }

        $user = Auth::user();

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $endDate = Carbon::parse($endDate)->endOfDay(); //adjust to include full day

        $transaction = Transaction::whereBetween('transactionDate', [$startDate, $endDate])
                        ->where('kind', 'not like', 'tabungan')
                        ->get();
        

        //format total, tanggal
        $transactionData = $transaction->map(function ($item) {
            $item->total = 'Rp ' . number_format($item->total, 0, ',', ',');

            if ($item->transactionDate !== null) {
                $item->transactionDate = Carbon::parse($item->transactionDate)->format('d-m-Y H:i:s');
            } else {
                $item->transactionDate = "-";
            }

            if ($item->approvedOn !== null) {
                $item->approvedOn = Carbon::parse($item->approvedOn)->format('d-m-Y H:i:s');
            } else {
                $item->approvedOn = "-";
            }
            
            return $item;
        });
        
        return view('main.simpanan-recap', compact(['user','transactionData','transaction']));
    }

    public function filterRecapTabungan(Request $request) {
        $validator = Validator::make(
            [
                'startDate' => $request->input('startDate'),
                'endDate' => $request->input('endDate'),
            ],
            [
                'startDate' => 'required|date',
                'endDate' => 'required|date|after_or_equal:startDate|max_one_month_difference:startDate|before_or_equal:' . now()->toDateString(),
            ],
            [
                'startDate.required' => 'Tanggal awal belum dipilih',
                'startDate.date' => 'Tanggal awal tidak valid',
                'endDate.required' => 'Tanggal akhir belum dipilih',
                'endDate.date' => 'Tanggal akhir tidak valid',
                'endDate.after_or_equal' => 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal',
                'endDate.before_or_equal' => 'Limit periode pencarian adalah 1 bulan',
                'endDate.max_one_month_difference' => 'Limit periode pencarian adalah 1 bulan',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }

        $user = Auth::user();

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $endDate = Carbon::parse($endDate)->endOfDay(); //adjust to include full day

        $transaction = Transaction::whereBetween('transactionDate', [$startDate, $endDate])
                        ->where('kind', 'like', 'tabungan')
                        ->get();

        //format total, tanggal
        $transactionData = $transaction->map(function ($item) {
            $item->total = 'Rp ' . number_format($item->total, 0, ',', ',');

            if ($item->transactionDate !== null) {
                $item->transactionDate = Carbon::parse($item->transactionDate)->format('d-m-Y H:i:s');
            } else {
                $item->transactionDate = "-";
            }

            if ($item->approvedOn !== null) {
                $item->approvedOn = Carbon::parse($item->approvedOn)->format('d-m-Y H:i:s');
            } else {
                $item->approvedOn = "-";
            }
            
            return $item;
        });
        
        return view('main.tabungan-recap', compact(['user','transactionData','transaction']));
    }

    public function filterRecapKredit(Request $request) {
        $validator = Validator::make(
            [
                'startDate' => $request->input('startDate'),
                'endDate' => $request->input('endDate'),
            ],
            [
                'startDate' => 'required|date',
                'endDate' => 'required|date|after_or_equal:startDate|max_one_month_difference:startDate|before_or_equal:' . now()->toDateString(),
            ],
            [
                'startDate.required' => 'Tanggal awal belum dipilih',
                'startDate.date' => 'Tanggal awal tidak valid',
                'endDate.required' => 'Tanggal akhir belum dipilih',
                'endDate.date' => 'Tanggal akhir tidak valid',
                'endDate.after_or_equal' => 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal',
                'endDate.before_or_equal' => 'Limit periode pencarian adalah 1 bulan',
                'endDate.max_one_month_difference' => 'Limit periode pencarian adalah 1 bulan',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }

        $user = Auth::user();

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $endDate = Carbon::parse($endDate)->endOfDay(); //adjust to include full day

        $loan = Loan::whereBetween('requestDate', [$startDate, $endDate])->get();

        //format total, tanggal
        $loanData = $loan->map(function ($item) {
            $item->total = 'Rp ' . number_format($item->total, 0, ',', ',');

            if ($item->transactionDate !== null) {
                $item->transactionDate = Carbon::parse($item->transactionDate)->format('d-m-Y H:i:s');
            } else {
                $item->transactionDate = "-";
            }

            if ($item->approvedOn !== null) {
                $item->approvedOn = Carbon::parse($item->approvedOn)->format('d-m-Y H:i:s');
            } else {
                $item->approvedOn = "-";
            }
            
            return $item;
        });
        
        return view('main.kredit-recap', compact(['user','loanData','loan']));
    }

    public function storeUserActivation(Request $request) {
        $request['nominal'] = str_replace(',', '', $request->input('nominal'));

        $validator = Validator::make(
            [
                'nominal' => $request->input('nominal'),
                'method' => $request->input('method'),
                'image' => $request->file('image'),
            ],
            [
                'nominal' => 'required|numeric|min:1000000',
                'method' => 'required|in:cash,transfer',
                'image' => 'required_if:method,transfer',
            ],
            [
                'nominal.required' => 'Nominal belum diisi',
                'nominal.min' => 'Minimal nominal simpanan adalah Rp 1,000,000',
                'method.required' => 'Jenis pembayaran belum diisi',
                'method.in' => 'Jenis pembayaran tidak valid',
                'image.required_if' => 'Bukti pembayaran belum diisi',
            ],
        );

        if ($validator->fails()) {
            return redirect('/')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
            // return redirect()->back()->withErrors($validator->errors()->first());
        }

        try {
            $input = $request->all();

            if(strtolower($input['method']) == "cash") {
                $input['method'] = 2;
            } else {
                $input['method'] = 1;
            }

            //check if user have user_account
            $user = Auth::user();
            
            //insert into user_account
            $arrUserAccount = [];
            $arrUserAccount["memberId"] = $user->memberId;
            //generate acount id
            $salt_1 = random_int(0, 9);
            $salt_2 = Str::random(7);
            $salt_3 = Str::random(16);
            $arrUserAccount["accountId"] = strtoupper("UAC-".$salt_1.$salt_2."-".$salt_3);
            $arrUserAccount["kind"] = 'pokok';
            $arrUserAccount["balance"] = 0;
            UserAccount::create($arrUserAccount);
            //end of insert into user_account

            $buktiSimpanan = "";
            if($imageSimpanan = $request->file('image')) {
                $destinationPath = 'image/upload/'.$user->memberId.'/'.'simpanan/';
                File::makeDirectory($destinationPath, 0777, true, true);
                $fileName = pathinfo($imageSimpanan->getClientOriginalName(), PATHINFO_FILENAME);
                $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                $imageName = $generatedID.$imageSimpanan->getClientOriginalExtension();

                $buktiSimpanan = $destinationPath.$imageName;
            }

            //insert into transaction
            $arrTransaction = [];
            $arrTransaction["accountId"] = $arrUserAccount["accountId"];
            $arrTransaction["kind"] = 'pokok';
            $arrTransaction["total"] = $input['nominal'];
            $arrTransaction["method"] = $input['method'];
            $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
            if($buktiSimpanan != "") {
                $arrTransaction["image"] = $buktiSimpanan;
            }
            $arrTransaction["notes"] = $input['notes'];
            $arrTransaction["status"] = 1;
            Transaction::create($arrTransaction);
            //end of insert into transaction

            if($buktiSimpanan != "") {
                Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($buktiSimpanan);
            }

            //update status aktivasi
            User::where('memberId', $user->memberId)->update(['status' => 1]);

            // return redirect('/')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function storeSimpanan(Request $request) {
        // $request->validate([
        //     'kind' => ['required', 'not_in:-- Pilih Simpanan --', 'in:Simpanan Wajib,Simpanan Sukarela'],
        //     'nominal' => 'required',
        //     'method' => 'required'
        // ]);

        $request['nominal'] = str_replace(',', '', $request->input('nominal'));

        $validator = Validator::make(
            [
                'kind' => $request->input('kind'),
                'nominal' => $request->input('nominal'),
                'method' => $request->input('method'),
                'image' => $request->file('image'),
            ],
            [
                'kind' => 'required|not_in:-- Pilih Simpanan --|in:Simpanan Wajib,Simpanan Sukarela',
                'nominal' => 'required|numeric|min:50000',
                'method' => 'required|in:cash,transfer',
                'image' => 'required_if:method,transfer',
            ],
            [
                'kind.required' => 'Jenis simpanan belum dipilih',
                'kind.not_in' => 'Jenis simpanan belum dipilih',
                'kind.in' => 'Jenis simpanan tidak valid',
                'nominal.required' => 'Nominal belum diisi',
                'nominal.min' => 'Minimal nominal simpanan adalah Rp 50,000',
                'method.required' => 'Jenis pembayaran belum diisi',
                'method.in' => 'Jenis pembayaran tidak valid',
                'image.required_if' => 'Bukti pembayaran belum diisi',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }

        try {
            $input = $request->all();

            if(strtolower($input['method']) == "cash") {
                $input['method'] = 2;
            } else {
                $input['method'] = 1;
            }

            if(strtolower($input['kind']) == "simpanan wajib") {
                $input['kind'] = 'wajib';
            } else {
                $input['kind'] = 'sukarela';
            }

            //check if user have user_account
            $user = Auth::user();

            //ini aneh, jalan, tapi nda bisa dapat accountId ($checkUAC->accountId)
            // $checkUAC = UserAccount::where('memberId', $user->memberId)
            // ->where('kind', $input['kind'])
            // ->get()->first();

            $checkUAC = DB::table('user_account as uac')
                ->select(DB::raw('uac.*'))
                ->where('memberId', $user->memberId)
                ->where('kind', $input['kind'])
                ->get()->first();
            
            //find data UAC
            if($checkUAC) {
                $buktiSimpanan = "";
                if($imageSimpanan = $request->file('image')) {
                    $destinationPath = 'image/upload/'.$user->memberId.'/'.'simpanan/';
                    File::makeDirectory($destinationPath, 0777, true, true);
                    $fileName = pathinfo($imageSimpanan->getClientOriginalName(), PATHINFO_FILENAME);
                    $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                    $imageName = $generatedID.$imageSimpanan->getClientOriginalExtension();

                    $buktiSimpanan = $destinationPath.$imageName;
                }

                //insert into transaction
                $arrTransaction = [];
                $arrTransaction["accountId"] = $checkUAC->accountId;
                $arrTransaction["kind"] = $input['kind'];
                $arrTransaction["total"] = $input['nominal'];
                $arrTransaction["method"] = $input['method'];
                $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
                $arrTransaction["image"] = $buktiSimpanan;
                $arrTransaction["notes"] = $input['notes'];
                $arrTransaction["status"] = 1;
                Transaction::create($arrTransaction);

                if($buktiSimpanan != "") {
                    Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($buktiSimpanan);
                }
                return redirect('/')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
                // return redirect('/simpanan/pengajuan')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
            } else { //user don't have any account
                //insert into user_account
                $arrUserAccount = [];
                $arrUserAccount["memberId"] = $user->memberId;
                //generate acount id
                $salt_1 = random_int(0, 9);
                $salt_2 = Str::random(7);
                $salt_3 = Str::random(16);
                $arrUserAccount["accountId"] = strtoupper("UAC-".$salt_1.$salt_2."-".$salt_3);
                $arrUserAccount["kind"] = $input['kind'];
                $arrUserAccount["balance"] = 0;
                UserAccount::create($arrUserAccount);
                //end of insert into user_account

                $buktiSimpanan = "";
                if($imageSimpanan = $request->file('image')) {
                    $destinationPath = 'image/upload/'.$user->memberId.'/'.'simpanan/';
                    File::makeDirectory($destinationPath, 0777, true, true);
                    $fileName = pathinfo($imageSimpanan->getClientOriginalName(), PATHINFO_FILENAME);
                    $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                    $imageName = $generatedID.$imageSimpanan->getClientOriginalExtension();

                    $buktiSimpanan = $destinationPath.$imageName;
                }

                //insert into transaction
                $arrTransaction = [];
                $arrTransaction["accountId"] = $arrUserAccount["accountId"];
                $arrTransaction["kind"] = $input['kind'];
                $arrTransaction["total"] = $input['nominal'];
                $arrTransaction["method"] = $input['method'];
                $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
                if($buktiSimpanan != "") {
                    $arrTransaction["image"] = $buktiSimpanan;
                }
                $arrTransaction["notes"] = $input['notes'];
                $arrTransaction["status"] = 1;
                Transaction::create($arrTransaction);
                //end of insert into transaction

                if($buktiSimpanan != "") {
                    Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($buktiSimpanan);
                }
                return redirect('/')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
                // return redirect('/simpanan/pengajuan')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function storeTabungan(Request $request) {
        $request['nominal'] = str_replace(',', '', $request->input('nominal'));

        $validator = Validator::make(
            [
                'nominal' => $request->input('nominal'),
                'method' => $request->input('method'),
                'image' => $request->file('image'),
            ],
            [
                'nominal' => 'required|numeric|min:50000',
                'method' => 'required|in:cash,transfer',
                'image' => 'required_if:method,transfer',
            ],
            [
                'nominal.required' => 'Nominal belum diisi',
                'nominal.min' => 'Minimal nominal tabungan adalah Rp 50,000',
                'method.required' => 'Jenis pembayaran belum diisi',
                'method.in' => 'Jenis pembayaran tidak valid',
                'image.required_if' => 'Bukti pembayaran belum diisi',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }

        try {
            $input = $request->all();

            if(strtolower($input['method']) == "cash") {
                $input['method'] = 2;
            } else {
                $input['method'] = 1;
            }

            //check if user have user_account
            $user = Auth::user();

            $checkUAC = DB::table('user_account as uac')
                ->select(DB::raw('uac.*'))
                ->where('memberId', $user->memberId)
                ->where('kind', 'tabungan')
                ->get()->first();
            
            //find data UAC
            if($checkUAC) {
                $buktiTabungan = "";
                if($imageTabungan = $request->file('image')) {
                    $destinationPath = 'image/upload/'.$user->memberId.'/'.'tabungan/';
                    File::makeDirectory($destinationPath, 0777, true, true);
                    $fileName = pathinfo($imageTabungan->getClientOriginalName(), PATHINFO_FILENAME);
                    $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                    $imageName = $generatedID.$imageTabungan->getClientOriginalExtension();

                    $buktiTabungan = $destinationPath.$imageName;
                }

                //insert into transaction
                $arrTransaction = [];
                $arrTransaction["accountId"] = $checkUAC->accountId;
                $arrTransaction["kind"] = 'tabungan';
                $arrTransaction["total"] = $input['nominal'];
                $arrTransaction["method"] = $input['method'];
                $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
                $arrTransaction["image"] = $buktiTabungan;
                $arrTransaction["notes"] = $input['notes'];
                $arrTransaction["status"] = 1;
                Transaction::create($arrTransaction);

                if($buktiTabungan != "") {
                    Image::make($imageTabungan)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($buktiTabungan);
                }

                return redirect('/tabungan/pengajuan')->withSuccess('Data pengajuan tabungan berhasil dikirim!');
            } else { //user don't have any account
                //insert into user_account
                $arrUserAccount = [];
                $arrUserAccount["memberId"] = $user->memberId;
                //generate acount id
                $salt_1 = random_int(0, 9);
                $salt_2 = Str::random(7);
                $salt_3 = Str::random(16);
                $arrUserAccount["accountId"] = strtoupper("UAC-".$salt_1.$salt_2."-".$salt_3);
                $arrUserAccount["kind"] = 'tabungan';
                $arrUserAccount["balance"] = 0;
                UserAccount::create($arrUserAccount);
                //end of insert into user_account

                $buktiTabungan = "";
                if($imageTabungan = $request->file('image')) {
                    $destinationPath = 'image/upload/'.$user->memberId.'/'.'tabungan/';
                    File::makeDirectory($destinationPath, 0777, true, true);
                    $fileName = pathinfo($imageTabungan->getClientOriginalName(), PATHINFO_FILENAME);
                    $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                    $imageName = $generatedID.$imageTabungan->getClientOriginalExtension();

                    $buktiTabungan = $destinationPath.$imageName;
                }

                //insert into transaction
                $arrTransaction = [];
                $arrTransaction["accountId"] = $arrUserAccount["accountId"];
                $arrTransaction["kind"] = 'tabungan';
                $arrTransaction["total"] = $input['nominal'];
                $arrTransaction["method"] = $input['method'];
                $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
                if($buktiTabungan != "") {
                    $arrTransaction["image"] = $buktiTabungan;
                }
                $arrTransaction["notes"] = $input['notes'];
                $arrTransaction["status"] = 1;
                Transaction::create($arrTransaction);
                //end of insert into transaction

                if($buktiTabungan != "") {
                    Image::make($imageTabungan)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($buktiTabungan);
                }
                return redirect('/tabungan/pengajuan')->withSuccess('Data pengajuan tabungan berhasil dikirim!');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function simulasiKredit(Request $request) {
        $hasilTotalKredit = $request->input('nominal');
        $hasilRates = $request->input('rates');
        $hasilTenor = $request->input('tenor');

        $request['nominal'] = str_replace(',', '', $request->input('nominal'));
        $request['nominal'] = str_replace('Rp', '', $request->input('nominal'));

        $request['rates'] = str_replace('%', '', $request->input('rates'));

        $request['tenor'] = str_replace(' bulan', '', $request->input('tenor'));

        $tenor = $request['tenor'];
        $nominal = $request['nominal'];
        $rates = rtrim(number_format($request['rates'], 2), '0');
        $rates = rtrim($rates, '.');

        //hitung angsuran pokok tiap bulan
        $hasilAngsuranPokok = ceil($nominal / $tenor);
        $hasilBungaPerBulan = ceil(($nominal * $rates / 100) / 12);
        $hasilTotalBunga = $hasilBungaPerBulan * $tenor;

        $hasilTotalAngsuran = ceil($hasilAngsuranPokok+$hasilBungaPerBulan);

        echo $hasilTotalKredit.'|'.$hasilRates.'|'.$hasilTenor.'|'.$hasilAngsuranPokok.'|'.$hasilBungaPerBulan.'|'.$hasilTotalAngsuran;
    }

    public function storeKredit(Request $request) {

        $request['nominal'] = str_replace(',', '', $request->input('nominal'));
        $request['nominal'] = str_replace('Rp', '', $request->input('nominal'));

        $request['rates'] = str_replace('%', '', $request->input('rates'));

        $request['tenor'] = str_replace(' bulan', '', $request->input('tenor'));

        $validator = Validator::make(
            [
                'tenor' => $request->input('tenor'),
                'nominal' => $request->input('nominal'),
                'rates' => $request->input('rates'),
                'notes' => $request->input('notes'),
            ],
            [
                'tenor' => 'required|not_in:-- Pilih Lama Pinjaman --|in:3,6,12,24,36',
                'nominal' => 'required|numeric|min:1000000',
                'notes' => 'required',
                'rates' => 'required|numeric|in:0.50',
            ],
            [
                'tenor.required' => 'Lama pinjaman belum dipilih',
                'tenor.not_in' => 'Lama pinjaman belum dipilih',
                'tenor.in' => 'Lama pinjaman tidak valid',
                'nominal.required' => 'Nominal belum diisi',
                'nominal.min' => 'Minimal nominal pinjaman adalah Rp 1,000,000',
                'nominal.numeric' => 'Nominal tidak valid',
                'notes.required' => 'Tujuan kredit belum diisi',
                'rates.required' => 'Bunga pinjaman belum diisi',
                'rates.in' => 'Bunga pinjaman tidak valid',
                'rates.numeric' => 'Bunga pinjaman tidak valid',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }

        //hitung angsuran
        $tenor = $request['tenor'];
        $nominal = $request['nominal'];
        $rates = rtrim(number_format($request['rates'], 2), '0');
        $rates = rtrim($rates, '.');

        //hitung angsuran pokok tiap bulan
        $hasilAngsuranPokok = ceil($nominal / $tenor);
        $hasilBungaPerBulan = ceil(($nominal * $rates / 100) / 12);
        $hasilTotalBunga = $hasilBungaPerBulan * $tenor;

        $hasilTotalAngsuran = ceil($hasilAngsuranPokok+$hasilBungaPerBulan);

        try {
            //check if user have user_account
            $user = Auth::user();

            $input = $request->all();
            
            //insert into user_account
            $arrUserAccount = [];
            $arrUserAccount["memberId"] = $user->memberId;
            //generate acount id
            $salt_1 = random_int(0, 9);
            $salt_2 = Str::random(7);
            $salt_3 = Str::random(16);
            $arrUserAccount["accountId"] = strtoupper("UAC-".$salt_1.$salt_2."-".$salt_3);
            $arrUserAccount["kind"] = 'kredit';
            $arrUserAccount["balance"] = 0;
            UserAccount::create($arrUserAccount);
            //end of insert into user_account

            //insert into loan
            $arrLoan = [];
            $arrLoan["accountId"] = $arrUserAccount["accountId"];
            $arrLoan["total"] = $input['nominal'];
            $arrLoan["tenor"] = $input['tenor'];
            $arrLoan["rates"] = $input['rates'];
            $arrLoan["monthlyRates"] = $hasilBungaPerBulan;
            $arrLoan["baseCicilan"] = $hasilAngsuranPokok;
            $arrLoan["monthlyCicilan"] = $hasilTotalAngsuran;
            $arrLoan["notes"] = $input['notes'];
            $arrLoan["status"] = 1;
            $arrLoan["requestDate"] = date('Y-m-d H:i:s');
            $loan = Loan::create($arrLoan);
            $loan->save();
            //end of insert into loan

            //insert into loan detail
            for($i = 0; $i < $tenor; $i++) {
                $arrLoanDetail = [];
                $arrLoanDetail["loanDocId"] = $loan->docId;
                $arrLoanDetail["indexCicilan"] = $i;
                $currentDate = Carbon::now();
                $dueDate = $currentDate->addMonths($tenor);
                $arrLoanDetail["dueDate"] = $dueDate;
                $arrLoanDetail["total"] = $hasilTotalAngsuran;
                $arrLoanDetail["charges"] = 0;
                $arrLoanDetail['method'] = 0;
                $arrLoanDetail["status"] = 1;
                // $loanDetail = LoanDetail::create($arrLoanDetail);
                $loan->loanDetails()->create($arrLoanDetail);
            }
            //end of insert into loan detail

            return redirect('/kredit/pengajuan')->withSuccess('Data pengajuan kredit berhasil dikirim!');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function storeAngsuran(Request $request) {        

        $validator = Validator::make(
            [
                'method' => $request->input('method'),
                'image' => $request->file('image'),
            ],
            [
                'method' => 'required|in:cash,transfer',
                'image' => 'required_if:method,transfer',
            ],
            [
                'method.required' => 'Jenis pembayaran belum diisi',
                'method.in' => 'Jenis pembayaran tidak valid',
                'image.required_if' => 'Bukti pembayaran belum diisi',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }

        try {
            //check if user have user_account
            $user = Auth::user();

            $input = $request->all();
            
            $loanDocId = $request->input('loanDocId');
            $indexCicilan = $request->input('indexCicilan');

            if(strtolower($input['method']) == "cash") {
                $input['method'] = 2;
            } else {
                $input['method'] = 1;
            }

            $buktiAngsuran = "";
            if($imageAngsuran = $request->file('image')) {
                $destinationPath = 'image/upload/'.$user->memberId.'/'.'angsuran/';
                File::makeDirectory($destinationPath, 0777, true, true);
                $fileName = pathinfo($imageAngsuran->getClientOriginalName(), PATHINFO_FILENAME);
                $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                $imageName = $generatedID.$imageAngsuran->getClientOriginalExtension();

                $buktiAngsuran = $destinationPath.$imageName;
            }

            DB::beginTransaction();
            DB::table('loan_detail')
                ->where('loanDocId', $loanDocId)
                ->where('indexCicilan', $indexCicilan)
                ->update([
                    'transactionDate' => date('Y-m-d H:i:s'),
                    'method' => $input['method'],
                    'image' => $buktiAngsuran,
                    'notes' => $input['notes'],
                    'status' => 1
                ]);
            DB::commit();

            return redirect('/angsuran/rekap')->withSuccess('Data pengajuan pembayaran angsuran berhasil dikirim!');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function editProfile(Request $request, $id) {
        // Retrieve existing user data
        $user = User::find($id);

        $excludedFields = ['password', 'ktp', 'kk', 'memberId', 'phone', 'email', 'email_verified_at', 'birthdate', 'workAddress'];

        // Compare form data with existing data
        $formData = $request->except($excludedFields);
        $changesDetected = false;

        foreach ($formData as $key => $value) {
            // Check if the form data is different from existing data
            if ($user->{$key} != $value) {
                $changesDetected = true;
                // You can break out of the loop if changes are detected early
                // break;
            }
        }

        // Update data if changes are detected
        if ($changesDetected) {
            dd('there is update');
            // $user->update($formData);
            // Add any additional logic or messages as needed
        } else {
            dd('nope');
            // No changes detected, you may choose to handle this case differently
            // For example, show a message to the user
        }
    }
}
