@extends('layout.admin.main')

@section('content')
    @include('sweetalert::alert')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Daftar Akun / </span> Edit Akun
        </h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Akun</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.account.update', $account->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="accountNo" name="accountNo"
                                        placeholder="" oninput=capitalizeName(this) required
                                        value="{{ old('accountNo', $account->accountNo) }}" />
                                    <label for="accountNo">Kode Akun</label>
                                </div>
                                @error('accountNo')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="" oninput=capitalizeName(this) required
                                        value="{{ old('name', $account->name) }}" />
                                    <label for="name">Nama Akun</label>
                                </div>
                                @error('name')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="categoryID">Kategori Akun</label>
                                    <select class="choices form-select" id="categoryID" name="categoryID">
                                        <option value="" selected disabled>---Pilih Kategori---</option>  
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}" {{ old('categoryID', $account->category->id ?? null) == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('categoryID')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3" id="relation" style="display: none;">
                                <div class="form-group">
                                    <label for="accountRelation">Relasi Akun</label>
                                    <select id="accountRelation" class="choices form-select" name="accountRelation">
                                        <option value="" selected disabled>---Pilih Relasi---</option>
                                        <option value="none" {{ old('accountRelation') =='none' ? 'selected' : '' }}>Tidak Ada</option>
                                        <option value="header" {{ old('accountRelation') =='header' ? 'selected' : '' }}>Akun Header</option>
                                        <option value="child" {{ old('accountRelation') =='child' ? 'selected' : '' }}>Sub Akun</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3" id="relationDetail" style="display: none;">
                                <div class="form-group">
                                    <label for="parentID">Detail Relasi:</label>
                                    <select id="parentID" name="parentID" class="choices form-select">
                                        <option value="">---Pilih Akun---</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder=""
                                        oninput=capitalizeName(this) required value="{{ old('description') }}"></textarea>
                                </div>
                                @error('description')
                                    <p class="mt-1" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                    name="active" {{ $account->active == '1' ? 'checked' : '' }} />
                                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary show_confirm">Update Akun</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section('vendorJS')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/sweetalert/sweetalert2.js"></script>

    <script>
        //capitalize input
        function capitalizeName(input) {
            const name = input.value.toLowerCase();
            const words = name.split(' ');
            const capitalizedWords = words.map(word => word.charAt(0).toUpperCase() + word.slice(1));
            input.value = capitalizedWords.join(' ');
        }
        //end of capitalize input

        $(document).ready(function() {
            var checkSelectedCategory = $("#categoryID").val();
            if(checkSelectedCategory != null) {
                $('#accountRelation').val('').trigger('change');
            }

            $('#categoryID').change(function() {
                $("#relation").show();
                $("#relationDetail").hide();
                $('#accountRelation').val('').trigger('change');
            });

            $('#accountRelation').change(function() {
                var relation = $(this).val();

                if (relation == 'none' || relation == null) {
                    $("#relationDetail").hide();
                } else {
                    $("#relationDetail").show();

                    var categoryId = $("#categoryID").val();
                    $.ajax({
                        url: '/admin/xxx',
                        type: 'GET',
                        data: {
                            categoryID: categoryId
                        },
                        success: function(data) {
                            console.log(data);
                            var select = $('#parentID');
                            select.empty();
                            $.each(data, function(key, value) {
                                select.append('<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                            
                        }
                    });
                }
            });

            $('.show_confirm').click(function(event) {
                event.preventDefault();

                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Simpan Data?',
                    text: '',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Ya, simpan',
                    denyButtonText: 'Batal',
                    customClass: {
                        confirmButton: "btn btn-primary",
                        denyButton: "btn btn-danger"
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });
        });
    </script>
@endsection
