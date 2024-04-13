<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\AccountTransactionDetail;
use App\Models\AccountTransactionImage;
use App\Models\User;
use App\Models\Config;
use App\Models\Transaction;
use App\Models\UserAccount;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function showUserMenu() {
        return view('admin.anggota');
    }

    public function showSimpananMenu() {
        return view('admin.simpanan');
    }

    public function showTabunganMenu() {
        return view('admin.tabungan');
    }

    public function showKreditMenu() {
        return view('admin.kredit');
    }

    public function showAngsuranMenu() {
        return view('admin.angsuran');
    }

    //TRANSACTION UBSP
    public function saveTransactionUBSP(Request $request) {
        $request->merge([
            'amountDebit' => array_map(function ($value) {
                return str_replace(['Rp ', ','], '', $value);
            }, $request->input('amountDebit', [])),
            'amountKredit' => array_map(function ($value) {
                return str_replace(['Rp ', ','], '', $value);
            }, $request->input('amountKredit', [])),
        ]);
        
        $validator = Validator::make(
            $request->all(),
            [
                'transactionDate' => 'required|date',
                'debitAccountID.*' => 'required',
                'kreditAccountID.*' => 'required',
                'amountDebit.*' => 'required|decimal:0,2',
                'amountKredit.*' => 'required|decimal:0,2',
            ],
            [
                'transactionDate.required' => 'Tanggal transaksi belum dipilih',
                'debitAccountID.*.required' => 'Setiap akun debit harus dipilih',
                'kreditAccountID.*.required' => 'Setiap akun kredit harus dipilih',
                'amountDebit.*.required' => 'Setiap total akun kredit harus diisi',
                'amountKredit.*.required' => 'Setiap total akun kredit harus diisi',
                'amountDebit.*.decimal:0,2' => 'Total akun debit harus berupa angka',
                'amountKredit.*.decimal:0,2' => 'Total akun kredit harus berupa angka',
            ],
        );

        if ($validator->fails()) {
            dd("catch 1");
            return redirect()->back()->withErrors($validator->errors())->withInput();
            
            // return response()->json( [ 'errors' => $validator->errors() ] );
            // return response()->json([
            //     'errors' => $validator->errors(),
            //     'oldInput' => $request->all()
            // ]);
        } else {
            DB::beginTransaction();
            try {
                $input = $request->all();

                $totalDebit = 0;
                $totalKredit = 0;
                foreach ($input['amountDebit'] as $item) {
                    $totalDebit += $item;
                }

                foreach ($input['amountKredit'] as $item) {
                    $totalKredit += $item;
                }

                //insert into account transaction
                $now = Carbon::now();
                $timestamp = $now->format('ymdHi');

                $input['transactionDate'] = date('Y-m-d', strtotime($input['transactionDate']));
                $totalData = AccountTransaction::where('transactionDate', 'LIKE', '%'.$input['transactionDate'].'%')->count();

                $idx = "000".strval($totalData+1);
                $cnt = substr($idx, -3);
                $docId = 'TR-UBSP-'.$timestamp.'-'.$cnt;

                $model = new AccountTransaction();
                $model->fill($input);
                $model->docId = $docId;
                $model->kind = 'others';
                $model->totalDebit = $totalDebit;
                $model->totalKredit = $totalKredit;
                $model->save();

                //insert account transaction detail
                $cntIndex = 0;
                foreach ($input['debitAccountID'] as $index => $accountNo) {
                    $detail = new AccountTransactionDetail();
                    $detail->docId = $docId;
                    $detail->indexNo = $cntIndex;
                    $detail->accountNo = $accountNo;
                    $detail->kind = 'D';
                    $detail->total = $input['amountDebit'][$index];
                    $detail->save();
                    $cntIndex++;
                }

                foreach ($input['kreditAccountID'] as $index => $accountNo) {
                    $detail = new AccountTransactionDetail();
                    $detail->docId = $docId;
                    $detail->indexNo = $cntIndex;
                    $detail->accountNo = $accountNo;
                    $detail->kind = 'K';
                    $detail->total = $input['amountKredit'][$index];
                    $detail->save();
                    $cntIndex++;
                }

                //insert account transaction image
                if($imageData = $request->file('image')) {
                    foreach ($imageData as $index => $image) {
                        $imgTime = Carbon::now()->format('ymd');

                        $imgName = $docId.'-'.$index.'.'.$image->getClientOriginalExtension();
                        $tempDir = 'image/upload/ubsp/transaction/'.$imgTime;
                        $imgPath = $tempDir.'/'.$imgName;

                        File::makeDirectory($tempDir, 0777, true, true);
                        Image::make($image)->resize(800, 600, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($imgPath);

                        AccountTransactionImage::create([
                            'docId' => $docId,
                            'indexNo' => $index,
                            'image' => $imgPath,
                        ]);

                        $index++;
                    }   
                }

                DB::commit();

                return redirect('/admin/transaction/ubsp')->withSuccess('Data transaksi UBSP berhasil ditambahkan!');
            } catch (\Exception $e) {
                dd("catch 3 ".$e->getMessage());
                DB::rollback();
                return redirect('/admin/transaction/ubsp')->with('errorData', $e->getMessage());
            }
        }
    }

    public function searchTransactionUBSP(Request $request) {
        $startDate = Carbon::createFromFormat('d-m-Y', $request->input('startDate'))->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d-m-Y', $request->input('endDate'))->format('Y-m-d');

        $transaction = AccountTransaction::with('debitDetail.account', 'creditDetail.account')->whereBetween('transactionDate', [$startDate, $endDate])->orderBy('transactionDate', 'desc')->get();

        return view('admin.transaction-ubsp', compact('transaction'));
    }
    //TRANSACTION UBSP

    public function showFormData(Transaction $transaction) {
        $parameter = Route::currentRouteName();

        if ($parameter == "admin.add.simpanan.deposit") {
            $configName = ['JENIS SIMPANAN', 'SIMPANAN WAJIB', 'MIN SIMPANAN SUKARELA', 'MIN SIMPANAN SIBUHAR'];
            $configuration = Config::whereIn('name', $configName)->get();

            $configStatus = false;
            $kind = array();
            $minWajib = "";
            $minSibuhar = "";
            $minSukarela = "";

            if(count($configuration) == 4) {
                $configStatus = true;
                foreach($configuration as $item) {
                    if(strtolower($item->name) == "jenis simpanan") {
                        $kind =  explode('|', $item->value);
                    } elseif(strtolower($item->name) == "simpanan wajib") {
                        $minWajib = $item->value;
                    } elseif(strtolower($item->name) == "min simpanan sukarela") {
                        $minSukarela = $item->value;
                    } elseif(strtolower($item->name) == "min simpanan sibuhar") {
                        $minSibuhar = $item->value;
                    }
                }
            }

            $member = User::where('status', 2)->get();
            return view('admin.simpanan-deposit-create', compact('member', 'configStatus', 'kind', 'minWajib', 'minSukarela', 'minSibuhar'));

        } elseif ($parameter == "admin.transaction") {
            return view('admin.transaction');
        } elseif ($parameter == "admin.transaction.ubsp") {
            $transaction = AccountTransaction::with('debitDetail.account', 'creditDetail.account')->orderBy('transactionDate', 'desc')->get();
            // dd($transaction);
            return view('admin.transaction-ubsp', compact('transaction'));
        } elseif ($parameter == "admin.transaction.ubsp.store") {
            $account = Account::where('parent_id', null)->get();
            return view('admin.transaction-ubsp-create', compact('account'));
        }
        
        elseif ($parameter == "admin.review.simpanan") {

            return view('admin.simpanan-deposit-review');

        } elseif ($parameter == "admin.recap.simpanan") {
            // $transaction = Transaction::join('user_account', 'transaction.accountId', '=', 'user_account.accountId')
            //     ->join('users', 'user_account.memberId', '=', 'users.memberId')
            //     ->select('transaction.docId as transactionDocId', 'transaction.kind', 'transaction.total', 'transaction.method', 'transaction.transactionDate', 'transaction.image', 'transaction.notes', 'transaction.status', 'transaction.approvedOn', 'users.fname', 'users.lname', 'users.memberId')
            //     ->get();

            // $user = User::all();

            //////////////////////////////////////////////////////////////////
            $userAccounts = UserAccount::with(['transaction' => function ($query) {
                $query->select('accountId', DB::raw('SUM(total) as totalTransactions'))
                    ->groupBy('accountId');
            }])->get();
            
            foreach ($userAccounts as $userAccount) {
                echo "User: {$userAccount->user->fname}<br>";
                echo "Account Kind: {$userAccount->kind}<br>";
                
                $totalTransactions = $userAccount->transaction->first();
                $totalTransactions = $totalTransactions ? $totalTransactions->totalTransactions : 0;
            
                echo "Total Transactions: {$totalTransactions}<br><br><br>";
            }

            //////////////////////////////////////////////////////////////////
            // $users = User::with(['userAccounts.transactions' => function ($query) {
            //     $query->select('kind', DB::raw('COUNT(*) as total'))
            //         ->groupBy('kind');
            // }])->get();
            
            // // Now, you can iterate through $users and access the total transactions for each kind
            // foreach ($users as $user) {
            //     echo "User: {$user->name}\n";
            
            //     foreach ($user->userAccounts as $userAccount) {
            //         echo "Kind: {$userAccount->kind}\n";
            //         echo "Total Transactions: " . ($userAccount->transactions->first() ? $userAccount->transactions->first()->total : 0) . "\n";
            //     }
            
            //     echo "\n";
            // }

            return view('admin.simpanan-deposit-recap');

        } 
        
        elseif ($parameter == "admin.detail.review.simpanan.deposit") {
            $member = User::where('status', 2)->get();
            return view('admin.simpanan-deposit-edit-detail', compact('transaction', 'member'));

        } elseif ($parameter == "admin.add.simpanan.withdrawal") {
            
            return view('admin.kredit');
        } elseif ($parameter == "admin.review.simpanan.withdrawal") {
            
            return view('admin.kredit');
        }
    }

    // public function getReviewSimpananDeposit(Request $request) {
    //     $transaction = Transaction::join('user_account', 'transaction.accountId', '=', 'user_account.accountId')
    //             ->join('users', 'user_account.memberId', '=', 'users.memberId')
    //             ->select('transaction.docId as transactionDocId', 'transaction.kind', 'transaction.total', 'transaction.method', 'transaction.transactionDate', 'transaction.image', 'transaction.notes', 'transaction.status', 'transaction.approvedOn', 'users.fname', 'users.lname', 'users.memberId')
    //             ->paginate($request->input('length'));
    //     return DataTables::of($transaction)->make(true);
    // }

    public function checkSimpananWajib(Request $request) {
        $memberId = $request->input('memberId');

        $user = User::with(['userAccount' => function ($query) {
            $query->where('kind', 'wajib');
        }])->where('memberId', $memberId)->first();

        $UAC = $user->userAccount;
        if(count($UAC) > 0) {
            $recordTransaction = Transaction::join('user_account', 'transaction.accountId', '=', 'user_account.accountId')
                ->join('users', 'user_account.memberId', '=', 'users.memberId')
                ->where('user_account.memberId', $memberId)
                ->whereDate('users.joinDate', '<=', now()->toDateString())
                ->whereDate('transaction.transactionDate', '>=', now()->toDateString())
                ->get();

            echo count($recordTransaction);
        } else {
            echo "error hee";
        }

    }

    public function storeSimpananDeposit(Request $request) {
        $configName = ['JENIS SIMPANAN', 'SIMPANAN WAJIB', 'MIN SIMPANAN SUKARELA', 'MIN SIMPANAN SIBUHAR'];
        $config = Config::whereIn('name', $configName)->pluck('value', 'name');

        $allowedKind = explode('|', strtoupper($config['JENIS SIMPANAN']));
        $selectedKind = strtoupper($request->input('kind'));
        $nominalRule = "";
        if (in_array($selectedKind, $allowedKind)) {
            if (Str::contains("wajib", strtolower($selectedKind))) {
                $nominalRule = 'required|numeric|min:' . $config['SIMPANAN WAJIB'];
            } elseif (Str::contains("sukarela", strtolower($selectedKind))) {
                $nominalRule = 'required|numeric|min:' . $config['MIN SIMPANAN SUKARELA'];
            } elseif (Str::contains("sibuhar", strtolower($selectedKind))) {
                $nominalRule = 'required|numeric|min:' . $config['MIN SIMPANAN SIBUHAR'];
            }
        } else {
            return redirect()->back()->withWarning("Formulir setoran simpanan belum diisi secara lengkap (jenis simpanan tidak valid)")->withInput();
        }

        $validator = Validator::make(
            [
                'kind' => $selectedKind,
                'memberId' => $request->input('memberId'),
                'nominal' => $request->input('nominal'),
                'method' => $request->input('method'),
                'image' => $request->file('image'),
            ],
            [
                'kind' => [
                    'required',
                    Rule::notIn(['-- Pilih Simpanan --']),
                    Rule::in($allowedKind)
                ],
                'memberId' => 'required',
                'nominal' => $nominalRule,
                'method' => 'required|in:cash,transfer',
                'image' => 'required_if:method,transfer',
            ],
            [
                'kind.required' => 'Jenis simpanan belum dipilih',
                'kind.not_in' => 'Jenis simpanan belum dipilih',
                'kind.in' => 'Jenis simpanan tidak valid',
                'memberId.required' => 'Anggota belum dipilih',
                'nominal.required' => 'Nominal belum diisi',
                'nominal.min' => 'Minimal nominal simpanan adalah Rp 50,000',
                'method.required' => 'Jenis pembayaran belum diisi',
                'method.in' => 'Jenis pembayaran tidak valid',
                'image.required_if' => 'Bukti pembayaran belum diisi',
            ],
        );

        $request['nominal'] = intval(str_replace(['Rp', ','], '', $request->input('nominal')));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $input = $request->all();

            $input['kind'] = strtolower(str_replace("Simpanan ", "", $input['kind']));

            if(strtolower($input['method']) == "cash") {
                $input['method'] = 2;
            } else {
                $input['method'] = 1;
            }

            $user = User::with(['userAccount' => function ($query) use ($input) {
                $query->where('kind', $input['kind']);
            }])->where('memberId', $input['memberId'])->first();
            
            $checkUAC = $user->userAccount;
            if(count($checkUAC) > 0) {
                if($input['kind'] == 'wajib') {
                    //check transaction (prevent duplicate transaction for simpanan wajib in a month)
                    $month = date('m');
                    $year = date('Y');

                    $recordTransaction = Transaction::where('accountId', $checkUAC->first()->accountId)
                        ->where('kind', 'wajib')
                        ->whereYear('transactionDate', $year)
                        ->whereMonth('transactionDate', $month)
                        ->get();
                    
                    if(count($recordTransaction) > 0) {
                        return redirect('/admin/simpanan/setoran')->with('warning', 'Simpanan wajib untuk '.$checkUAC->first()->user->fname.' '.$checkUAC->first()->user->lname.' untuk bulan ini sudah dibayar, data gagal disimpan!');
                    } else {
                        $buktiSimpanan = "";
                        if($imageSimpanan = $request->file('image')) {
                            $destinationPath = 'image/upload/'.$input['memberId'].'/'.'simpanan/'.$input['kind'].'/';
                            File::makeDirectory($destinationPath, 0777, true, true);

                            $imageName = $input['memberId']."_".time().Str::random(5).'.'.$imageSimpanan->getClientOriginalExtension();
                            $buktiSimpanan = $destinationPath.$imageName;
                        }

                        //insert into transaction
                        DB::beginTransaction();
                        $arrTransaction = [];
                        $arrTransaction["accountId"] = $checkUAC->accountId;
                        $arrTransaction["kind"] = $input['kind'];
                        $arrTransaction["total"] = $input['nominal'];
                        $arrTransaction["method"] = $input['method'];
                        $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
                        $arrTransaction["image"] = $buktiSimpanan;
                        $arrTransaction["notes"] = $input['notes'];
                        $arrTransaction["status"] = 2;
                        Transaction::create($arrTransaction);

                        if($buktiSimpanan != "") {
                            Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                                $constraint->aspectRatio();
                            })->save($buktiSimpanan);
                        }

                        //update user account balance
                        $recordUAC = UserAccount::find($checkUAC->accountId);
                        if($recordUAC) {
                            $currentSaldo = $recordUAC->balance + $input['nominal'];
                            $recordUAC->update([
                                'balance' => $currentSaldo,
                            ]);
                        }

                        DB::commit();

                        return redirect()->back()->withSuccess('Data setoran simpanan berhasil disimpan!');
                    }
                } else {
                    dd($checkUAC->kind);
                    $buktiSimpanan = "";
                    if($imageSimpanan = $request->file('image')) {
                        $destinationPath = 'image/upload/'.$input['memberId'].'/'.'simpanan/'.$input['kind'].'/';
                        File::makeDirectory($destinationPath, 0777, true, true);

                        $imageName = $input['memberId']."_".time().Str::random(5).'.'.$imageSimpanan->getClientOriginalExtension();
                        $buktiSimpanan = $destinationPath.$imageName;
                    }

                    //insert into transaction
                    DB::beginTransaction();
                    $arrTransaction = [];
                    $arrTransaction["accountId"] = $checkUAC->accountId;
                    $arrTransaction["kind"] = $input['kind'];
                    $arrTransaction["total"] = $input['nominal'];
                    $arrTransaction["method"] = $input['method'];
                    $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
                    $arrTransaction["image"] = $buktiSimpanan;
                    $arrTransaction["notes"] = $input['notes'];
                    $arrTransaction["status"] = 2;
                    Transaction::create($arrTransaction);

                    if($buktiSimpanan != "") {
                        Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($buktiSimpanan);
                    }

                    //update user account balance
                    $recordUAC = UserAccount::find($checkUAC->accountId);
                    if($recordUAC) {
                        $currentSaldo = $recordUAC->balance + $input['nominal'];
                        $recordUAC->update([
                            'balance' => $currentSaldo,
                        ]);
                    }

                    DB::commit();

                    return redirect()->back()->withSuccess('Data setoran simpanan berhasil disimpan!');
                }
            } else {
                //insert into user_account
                $arrUserAccount = [];
                $arrUserAccount["memberId"] = $input['memberId'];
                //generate acount id
                $salt_1 = random_int(0, 9);
                $salt_2 = Str::random(7);
                $salt_3 = Str::random(16);
                $arrUserAccount["accountId"] = strtoupper("UAC-".$salt_1.$salt_2."-".$salt_3);
                $arrUserAccount["kind"] = $input['kind'];
                $arrUserAccount["balance"] = $input['nominal'];
                $arrUserAccount["openDate"] = date('Y-m-d H:i:s');
                UserAccount::create($arrUserAccount);
                //end of insert into user_account

                $buktiSimpanan = "";
                if($imageSimpanan = $request->file('image')) {
                    $destinationPath = 'image/upload/'.$input['memberId'].'/'.'simpanan/'.$input['kind'].'/';
                    File::makeDirectory($destinationPath, 0777, true, true);

                    $imageName = $input['memberId']."_".time().Str::random(5).'.'.$imageSimpanan->getClientOriginalExtension();
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
                $arrTransaction["status"] = 2;
                Transaction::create($arrTransaction);
                //end of insert into transaction

                if($buktiSimpanan != "") {
                    Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($buktiSimpanan);
                }
                return redirect()->back()->withSuccess('Data setoran simpanan berhasil disimpan!');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
