@extends('layout.admin.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="fw-light">Transaksi Anggota</span>
        </h4>
        <div class="row">
            <div class="col-lg-12 col-xl-4 col-12">
                <div class="card mb-4 bg-gradient">
                    <div class="card-body">
                        <div class="row justify-content-between mb-3">
                            <div
                                class="col-md-12 col-lg-7 col-xl-12 col-xxl-7 text-center text-lg-start text-xl-center text-xxl-start order-1  order-lg-0 order-xl-1 order-xxl-0">
                                <h4 class="card-title text-white text-nowrap">Simpanan</h4>
                                <p class="card-text">Simpanan anggota koperasi UBSP</p>
                            </div>
                            <span class="col-md-12 col-lg-5 col-xl-12 col-xxl-5 text-center mx-auto mx-md-0 mb-2"><img
                                    src="/assets/images/simpanan.svg"
                                    class="w-85 m-2" style="mix-blend-mode: multiply;filter: contrast(1);"></span>
                        </div>
                        <button type="button" class="btn btn-primary text-white w-100 fw-medium shadow-sm" data-bs-toggle="modal" data-bs-target="#simpanan">Transaksi Simpanan</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-xl-4 col-12">
                <div class="card mb-4 bg-gradient">
                    <div class="card-body">
                        <div class="row justify-content-between mb-3">
                            <div
                                class="col-md-12 col-lg-7 col-xl-12 col-xxl-7 text-center text-lg-start text-xl-center text-xxl-start order-1  order-lg-0 order-xl-1 order-xxl-0">
                                <h4 class="card-title text-white text-nowrap">Pinjaman</h4>
                                <p class="card-text">Pinjaman anggota koperasi UBSP</p>
                            </div>
                            <span class="col-md-12 col-lg-5 col-xl-12 col-xxl-5 text-center mx-auto mx-md-0 mb-2"><img
                                    src="/assets/images/pinjaman.svg" class="w-85 m-2" style="mix-blend-mode: multiply;filter: contrast(1);"></span>
                        </div>

                        <a href="{{ route('admin.transaction.member') }}" class="btn btn-primary text-white w-100 fw-medium shadow-sm">Transaksi Pinjaman</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-xl-4 col-12">
                <div class="card mb-4 bg-gradient">
                    <div class="card-body">
                        <div class="row justify-content-between mb-3">
                            <div
                                class="col-md-12 col-lg-7 col-xl-12 col-xxl-7 text-center text-lg-start text-xl-center text-xxl-start order-1  order-lg-0 order-xl-1 order-xxl-0">
                                <h4 class="card-title text-white text-nowrap">Angsuran</h4>
                                <p class="card-text">Angsuran anggota koperasi UBSP</p>
                            </div>
                            <span class="col-md-12 col-lg-5 col-xl-12 col-xxl-5 text-center mx-auto mx-md-0 mb-2"><img
                                    src="/assets/images/angsuran.svg" class="w-85 m-2" style="mix-blend-mode: multiply;filter: contrast(1);"></span>
                        </div>

                        <a href="{{ route('admin.transaction.member') }}" class="btn btn-primary text-white w-100 fw-medium shadow-sm">Transaksi Angsuran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="simpanan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
          <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="text-center mb-4">
                <h3 class="mb-2">Transaksi Simpanan</h3>
                <p class="text-muted">Silahkan pilih jenis transaksi</p>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                  <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content ps-3" for="customRadioTemp1" data-bs-target="#twoFactorAuthOne" data-bs-toggle="modal">
                      <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp1" />
                      <span class="d-flex align-items-start">
                        <i class="bx bx-message-square-add bx-md me-3"></i>
                        <span>
                          <span class="custom-option-header">
                            <span class="h4 mb-2">Pengajuan Simpanan</span>
                          </span>
                          <span class="custom-option-body">
                            <span class="mb-0">Tambah transaksi setoran simpanan</span>
                          </span>
                        </span>
                      </span>
                    </label>
                  </div>
                </div>

                <div class="col-12 mb-3">
                  <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content ps-3" for="customRadioTemp2" data-bs-target="#twoFactorAuthTwo" data-bs-toggle="modal">
                      <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp2" />
                      <span class="d-flex align-items-start">
                        <i class="bx bx-money bx-md me-3"></i>
                        <span>
                          <span class="custom-option-header">
                            <span class="h4 mb-2">Penarikan Simpanan</span>
                          </span>
                          <span class="custom-option-body">
                            <span class="mb-0">Tambah transaksi penarikan simpanan</span>
                          </span>
                        </span>
                      </span>
                    </label>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content ps-3" for="customRadioTemp2" data-bs-target="#twoFactorAuthTwo" data-bs-toggle="modal">
                      <input name="customRadioTemp" class="form-check-input d-none" type="radio" value="" id="customRadioTemp2" />
                      <span class="d-flex align-items-start">
                        <i class="bx bx-message-square-check bx-md me-3"></i>
                        <span>
                          <span class="custom-option-header">
                            <span class="h4 mb-2">Approval Simpanan</span>
                          </span>
                          <span class="custom-option-body">
                            <span class="mb-0">Review pengajuan simpanan dari anggota</span>
                          </span>
                        </span>
                      </span>
                    </label>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- / Content -->
@endsection

@section('vendorJS')
    <script src="/vendor/jquery/jquery.min.js"></script>
@endsection
