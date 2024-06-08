<div>
    @if (!empty($successMessage))
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
                {{-- <div class="mb-3">
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
                </div> --}}

                <div class="mb-3">
                    <div class="form-group">

                        {{-- alternatif 1 --}}
                        {{-- <div wire:ignore x-data x-init="document.addEventListener('DOMContentLoaded', function() {
                            const pond = FilePond.create($refs.kk, {
                                server: {
                                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                        @this.upload('kk', file, load, error, progress)
                                    },
                                    revert: (filename, load) => {
                                        @this.removeUpload('kk', filename, load)
                                    },
                                },
                            });
                            this.addEventListener('pondReset', e => {
                                pond.removeFiles();
                            });
                        
                        });">
                            <input type="file" x-ref="kk" wire:model="kk">
                        </div> --}}


                        <div 
                            wire:ignore
                            x-data="{pond: null}"
                            x-init="
                                FilePond.registerPlugin(FilePondPluginImagePreview);
                                const inputElements = document.querySelectorAll('input.kk');
                                pond = FilePond.create($refs.kk);

                                pond.setOptions({
                                    server: {
                                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                            @this.upload('kk', file, (filename) => { load(filename) }, error, progress)
                                        },
                                        revert: (filename, load) => {
                                            @this.removeUpload('kk', filename, load)
                                        }
                                    }
                                });
                        ">
                            <label>Foto KK</label>
                            <input type="file" x-ref="kk" wire:model="kk" name="kk" class="kk">
                        </div>
                    </div>
                    @error('kk')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <div 
                            wire:ignore
                            x-data="{pond: null}"
                            x-init="
                                FilePond.registerPlugin(FilePondPluginImagePreview);
                                const inputElements = document.querySelectorAll('input.ktp');
                                pond = FilePond.create($refs.ktp);

                                pond.setOptions({
                                    server: {
                                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                            @this.upload('ktp', file, (filename) => { load(filename) }, error, progress)
                                        },
                                        revert: (filename, load) => {
                                            @this.removeUpload('ktp', filename, load)
                                
                                        }
                                    }
                                });
                        ">
                            <label>Foto KTP</label>
                            <input type="file" x-ref="ktp" wire:model="ktp" name="ktp" class="ktp">
                        </div>
                    </div>
                    @error('ktp')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                    <div class="form-group">
                        <div
                            wire:ignore
                            x-data 
                            x-init="
                                FilePond.setOptions({
                                server: {
                                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                        @this.upload('kk', file, (filename) => { load(filename) }, error, progress)
                                    },
                                    revert: (filename, load) => {
                                        @this.removeUpload('kk', filename, load)
                            
                                    }
                                }
                            })
                            
                            FilePond.create($refs.kk);
                        ">
                            <label>Foto Kartu Keluarga</label>
                            <input type="file" x-ref="kk" wire:model.lazy="kk" id="2-upload-file">
                        </div>
                    </div>
                    @error('kk')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div> --}}

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
                        <div wire:ignore x-data x-init="FilePond.setOptions({
                            server: {
                                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                    @this.upload('ktp', file, (filename) => { load(filename) }, error, progress)
                                },
                                revert: (filename, load) => {
                                    @this.removeUpload('ktp', filename, load)
                        
                                }
                            }
                        })
                        
                        FilePond.registerPlugin(FilePondPluginImagePreview);
                        FilePond.create($refs.input);">
                            <label>Foto KTP</label>
                            <input type="file" x-ref="input" wire:model="ktp">
                        </div>
                    </div>
                    @error('ktp')
                        <p class="mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <div wire:ignore x-data x-init="FilePond.setOptions({
                            server: {
                                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                    @this.upload('kk', file, (filename) => { load(filename) }, error, progress)
                                },
                                revert: (filename, load) => {
                                    @this.removeUpload('kk', filename, load)
                        
                                }
                            }
                        })
                        
                        FilePond.registerPlugin(FilePondPluginImagePreview);
                        FilePond.create($refs.input);">
                            <label>Foto Kartu Keluarga</label>
                            <input type="file" x-ref="input" wire:model="kk">
                        </div>
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
            @once
                <script>
                    document.addEventListener('livewire:load', function() {
                        Livewire.on('reinitializeFilepond', () => {
                            // Reinitialize or setup Filepond
                            // For example:
                            FilePond.create(document.querySelector('.image-resize-filepond'));
                            FilePond.create(document.querySelector('.image-preview-filepond'));
                        });
                    });
                </script>
            @endonce

            <div id="step3" style="display: {{ $currentStep != 3 ? 'none' : '' }}">
                {{-- <p>step1</p> --}}
            </div>

        </div>
    </div>
</div>
