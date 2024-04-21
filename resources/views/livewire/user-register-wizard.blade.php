<div class="pt-5">
    @if(!empty($successMessage))
    <div class="alert alert-success">
        {{ $successMessage }}
    </div>
    @endif

    <div class="bs-stepper">
        <div class="bs-stepper-header">
            <div class="step {{ $currentStep != 1 ? '' : 'active' }}" data-target="#step1">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label mt-1">
                        <span class="bs-stepper-title">Data Diri</span>
                        <span class="bs-stepper-subtitle">Data diri calon anggota</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step {{ $currentStep != 2 ? '' : 'active' }}" data-target="#step2">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label mt-1">
                        <span class="bs-stepper-title">Identifikasi Diri</span>
                        <span class="bs-stepper-subtitle">Verifikasi diri calon anggota</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step {{ $currentStep != 3 ? '' : 'active' }}" data-target="#step3">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">3</span>
                    <span class="bs-stepper-label mt-1">
                        <span class="bs-stepper-title">Data Simpanan</span>
                        <span class="bs-stepper-subtitle">Data simpanan calon anggota</span>
                    </span>
                </button>
            </div>
        </div>

        <div class="bs-stepper-content">
            <div id="step1" style="display: {{ $currentStep != 1 ? 'none' : '' }}">
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="fname" wire:model="fname" placeholder="" required value="{{ old('fname') }}" />
                        <label for="fname">Nama Depan</label>
                    </div>
                    @error('fname')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="lname" wire:model="lname" placeholder="" required value="{{ old('lname') }}" />
                        <label for="lname">Nama Belakang</label>
                    </div>
                    @error('lname')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="birthplace" wire:model="birthplace"
                            placeholder="" required
                            value="{{ old('birthplace') }}" />
                        <label for="birthplace">Tempat Lahir</label>
                    </div>
                    @error('birthplace')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="date" class="form-control mb-3" id="birthdate" wire:model="birthdate"
                            required value="{{ old('birthdate') }}">
                        <label for="birthdate">Tanggal Lahir</label>
                    </div>
                    @error('birthdate')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="address" wire:model="address"
                            placeholder="" required
                            value="{{ old('address') }}" />
                        <label for="address">Alamat Tinggal</label>
                    </div>
                    @error('address')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="workAddress" wire:model="workAddress"
                            placeholder="" required
                            value="{{ old('workAddress') }}" />
                        <label for="workAddress">Alamat Kerja</label>
                    </div>
                    @error('workAddress')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" wire:model="email"
                            placeholder="" required value="{{ old('email') }}" />
                        <label for="email">Email</label>
                    </div>
                    @error('email')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="phone" wire:model="phone"
                            placeholder="" oninput=validateNumberInput(this) required
                            value="{{ old('phone') }}" />
                        <label for="phone">No Hp</label>
                    </div>
                    @error('phone')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="mothername" wire:model="mothername"
                            placeholder="" required
                            value="{{ old('mothername') }}" />
                        <label for="mothername">Nama Ibu Kandung</label>
                    </div>
                    @error('mothername')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <button class="btn btn-label-secondary btn-prev" disabled>
                      <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                      <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                    </button>
                    <button class="btn btn-primary btn-next" wire:click="firstStepSubmit">
                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Lanjut</span>
                      <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                    </button>
                </div>
            </div>

            <div id="step2" style="display: {{ $currentStep != 2 ? 'none' : '' }}">
                <div class="mb-3">
                    <div class="form-group">
                        <label for="ktp">Foto KTP</label>
                        <input type="file" class="image-resize-filepond" wire:model="ktp" id="ktp" accept="image/*">
                    </div>
                    @error('ktp')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="kk">Foto Kartu Keluarga</label>
                        <input type="file" class="image-preview-filepond" wire:model="kk" id="kk"
                            accept="image/*">
                    </div>
                    @error('kk')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <button class="btn btn-label-danger btn-prev" wire:click="back(1)">
                      <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                      <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                    </button>
                    <button class="btn btn-primary btn-next" wire:click="secondStepSubmit">
                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Lanjut</span>
                      <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                    </button>
                </div>

            </div>

            <div id="step3" style="display: {{ $currentStep != 3 ? 'none' : '' }}">
                {{-- <p>step1</p> --}}
            </div>

        </div>
    </div>
</div>