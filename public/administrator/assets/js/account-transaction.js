document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.debitAccount').forEach(function(input) {
        $(input).select2({
            placeholder: 'Pilih Akun Debit',
            allowClear: true,
            theme: 'bootstrap-5',
            width: '100%',
        });
    });

    document.querySelectorAll('.kreditAccount').forEach(function(input) {
        $(input).select2({
            placeholder: 'Pilih Akun Kredit',
            allowClear: true,
            theme: 'bootstrap-5',
            width: '100%',
        });
    });

    document.querySelectorAll('.amountInputDebit').forEach(function(input) {
        new AutoNumeric(input, {
            currencySymbol: 'Rp ',
            digitGroupSeparator: ',',
            decimalCharacter: '.',
            emptyInputBehavior: "zero",
            watchExternalChanges: true,
            modifyValueOnWheel: false
        });
    });

    document.querySelectorAll('.amountInputKredit').forEach(function(input) {
        new AutoNumeric(input, {
            currencySymbol: 'Rp ',
            digitGroupSeparator: ',',
            decimalCharacter: '.',
            emptyInputBehavior: "zero",
            watchExternalChanges: true,
            modifyValueOnWheel: false
        });
    });

    new AutoNumeric('.totalDebit', {
        currencySymbol: 'Rp ',
        digitGroupSeparator: ',',
        decimalCharacter: '.',
        emptyInputBehavior: "zero",
        watchExternalChanges: true,
        modifyValueOnWheel: false
    });

    new AutoNumeric('.totalKredit', {
        currencySymbol: 'Rp ',
        digitGroupSeparator: ',',
        decimalCharacter: '.',
        emptyInputBehavior: "zero",
        watchExternalChanges: true,
        modifyValueOnWheel: false
    });

    function updateTotal(kind) {
        if (kind == 'debit') {
            var totalDebit = 0;
            var debitInput = document.querySelectorAll('.amountInputDebit');
            debitInput.forEach(function(item) {
                var val = AutoNumeric.getNumericString(item);
                totalDebit += parseFloat(val);
            });
            document.getElementById("totalDebit").textContent = totalDebit;
            new AutoNumeric('.totalDebit', {
                currencySymbol: 'Rp ',
                digitGroupSeparator: ',',
                decimalCharacter: '.',
                emptyInputBehavior: "zero",
                watchExternalChanges: true,
                modifyValueOnWheel: false
            });
        } else {
            var totalKredit = 0;
            var kreditInput = document.querySelectorAll('.amountInputKredit');
            kreditInput.forEach(function(item) {
                var val = AutoNumeric.getNumericString(item);
                totalKredit += parseFloat(val);
            });
            document.getElementById("totalKredit").textContent = totalKredit;
            new AutoNumeric('.totalKredit', {
                currencySymbol: 'Rp ',
                digitGroupSeparator: ',',
                decimalCharacter: '.',
                emptyInputBehavior: "zero",
                watchExternalChanges: true,
                modifyValueOnWheel: false
            });
        }
    }

    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('amountInputDebit')) {
            updateTotal('debit');
        } else if (event.target.classList.contains('amountInputKredit')) {
            updateTotal('kredit');
        }
    });

    //event handler (prevent duplicate accountID in debit and kredit)
    $('select[name="debitAccountID[]"]').change(function() {
        var selectedAccountId = $(this).val();
        var isDuplicate = checkDuplicateAccount(selectedAccountId,
            'select[name="kreditAccountID[]"]');
        if (isDuplicate) {
            Swal.fire({
                title: 'Info',
                html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                    '<p class="mt-2">Nomor akun yang sama tidak dapat dipilih di bagian debit dan kredit.</p>',
                showCloseButton: true,
                focusConfirm: false,
                didOpen: () => {
                    var animation = lottie.loadAnimation({
                        container: document.getElementById('lottie-container'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: '/assets/animations/info.json',
                        rendererSettings: {
                            preserveAspectRatio: 'xMidYMid slice'
                        }
                    });
                }
            });
            $(this).val("default");
            $(this).trigger("change");
        }
    });

    $('select[name="kreditAccountID[]"]').change(function() {
        var selectedAccountId = $(this).val();
        var isDuplicate = checkDuplicateAccount(selectedAccountId,
            'select[name="debitAccountID[]"]');
        if (isDuplicate) {
            Swal.fire({
                title: 'Info',
                html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                    '<p class="mt-2">Nomor akun yang sama tidak dapat dipilih di bagian debit dan kredit.</p>',
                showCloseButton: true,
                focusConfirm: false,
                didOpen: () => {
                    var animation = lottie.loadAnimation({
                        container: document.getElementById('lottie-container'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: '/assets/animations/info.json',
                        rendererSettings: {
                            preserveAspectRatio: 'xMidYMid slice'
                        }
                    });
                }
            });
            $(this).val("default");
            $(this).trigger("change");
        }
    });

    function checkDuplicateAccount(selectedAccountId, otherSectionSelector) {
        var isDuplicate = false;
        $(otherSectionSelector).each(function() {
            if($(this).val() != '') {
                if ($(this).val() == selectedAccountId) {
                    isDuplicate = true;
                    return false;
                }
            }
        });
        return isDuplicate;
    }
    //event handler (prevent duplicate accountID in debit and kredit)

    $("#addRowDebit").click(function(event) {
        event.preventDefault();

        //destroy select2
        // https://stackoverflow.com/questions/39142484/multiple-clone-not-working-when-append-in-select-2
        $("#rowDebit .row:first").find('.debitAccount').select2('destroy');

        const newRow = $("#rowDebit .row:first").clone();
        newRow.find(".deleteRowDebit").show();
        newRow.find('.notesInputDebit').val('').removeAttr('id');
        newRow.find('.amountInputDebit').val('').removeAttr('id');
        newRow.find('.amountInputDebit').each(function() {
            new AutoNumeric(this, {
                currencySymbol: 'Rp ',
                digitGroupSeparator: ',',
                decimalCharacter: '.',
                emptyInputBehavior: "zero",
                watchExternalChanges: true,
                modifyValueOnWheel: false
            });
        });

        $("#rowDebit").append(newRow);

        $('.debitAccount').select2({
            placeholder: 'Pilih Akun Debit',
            allowClear: true,
            theme: 'bootstrap-5',
            width: '100%',
        });
    });

    $("#addRowKredit").click(function(event) {
        event.preventDefault();

        $("#rowKredit .row:first").find('.kreditAccount').select2('destroy');

        const newRow = $("#rowKredit .row:first").clone();
        newRow.find(".deleteRowKredit").show();
        newRow.find('.notesInputKredit').val('').removeAttr('id');
        newRow.find('.amountInputKredit').val('').removeAttr('id');
        newRow.find('.amountInputKredit').each(function() {
            new AutoNumeric(this, {
                currencySymbol: 'Rp ',
                digitGroupSeparator: ',',
                decimalCharacter: '.',
                emptyInputBehavior: "zero",
                watchExternalChanges: true,
                modifyValueOnWheel: false
            });
        });

        $("#rowKredit").append(newRow);

        $('.kreditAccount').select2({
            placeholder: 'Pilih Akun Kredit',
            allowClear: true,
            theme: 'bootstrap-5',
            width: '100%',
        });
    });

    $("#rowDebit").on("click", ".deleteRowDebit", function(event) {
        const row = $(this).closest(".row");
        row.remove();
        updateTotal('debit');
    });

    $("#rowKredit").on("click", ".deleteRowKredit", function(event) {
        const row = $(this).closest(".row");
        row.remove();
        updateTotal('kredit');
    });
});

$(document).ready(function() {
    $(".dob-picker").flatpickr({
        monthSelectorType: "static",
        dateFormat: "d-m-Y"
    });

    $('input[type=text]').on("scroll", function(){
        $(this).scrollLeft(0);
    });

    $('.show_confirm').click(function(event) {
        event.preventDefault();
        var form = $(this).closest("form");
        var item = $('input[name="name"]').val();
        if (item === "") {
            item = "(Nama Kategori Belum Diisi)";
        }

        Swal.fire({
            title: 'Konfirmasi',
            html: '<div style="width: 50%; margin: auto;" id="lottie-container"></div>' +
                '<p class="mt-2">Apakah Anda yakin ingin menambahkan transaksi?</p>',
            confirmButtonText: 'Ya, Tambah',
            denyButtonText: 'Batal',
            customClass: {
                confirmButton: "btn btn-primary",
                denyButton: "btn btn-danger"
            },
            showDenyButton: true,
            showCloseButton: true,
            focusConfirm: false,
            didOpen: () => {
                var animation = lottie.loadAnimation({
                    container: document.getElementById('lottie-container'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: '/assets/animations/confirm.json',
                    rendererSettings: {
                        preserveAspectRatio: 'xMidYMid slice'
                    }
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                // let formz = $('#company_form')[0];
                // let data = new FormData(formz);

                // $.ajax({
                //     url: "{{ route('admin.ubsp.transaction.store') }}",
                //     type: "POST",
                //     data: data,
                //     dataType: "JSON",
                //     processData: false,
                //     contentType: false,
                //     success: function (response) {
                //         console.log('masuk success');
                //         if (response.errors) {
                //             console.log('ini error');
                //             // Show validation errors
                //             var errorMsg = '';
                //             $.each(response.errors, function (field, errors) {
                //                 console.log(field);
                //                 console.log(errors);
                //                 $.each(errors, function (index, error) {
                //                     errorMsg += error + '<br>';
                //                 });
                //                 // Show validation error messages next to corresponding input fields
                //                 $('[name="' + field + '"]').after('<p class="mt-1" style="color: blue">' + errors[0] + '</p>');
                //             });
                //         } else {
                //             console.log('ini success');
                //             iziToast.success({
                //                 message: response.success,
                //                 position: 'topRight'
                //             });
                //         }
                //     },
                //     error: function (xhr, status, error) {
                //         console.log('masuk error');
                //         iziToast.error({
                //             message: 'An error occurred: ' + error,
                //             position: 'topRight'
                //         });
                //     }
                // });
            }
        });
    });

    $('form').submit(function() {
        $(':submit', this).prop('disabled', true);

        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-loading'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '/assets/animations/loading.json',
            rendererSettings: {
                preserveAspectRatio: 'xMidYMid slice'
            }
        });
        $('#overlay').show();
        $('body, html').css('overflow', 'hidden');
        return true;
    });
});