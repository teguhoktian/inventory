@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">

        <x-box type="success" flat="true" shadow="true">
            <x-slot name="header">
                {{ __('Input Barang Keluar') }}
            </x-slot>

            @include('barangkeluar.form2')

            <x-slot name="footer">

                <a href="{{ route('barang-keluar.index') }}" class="btn-flat btn btn-default">
                    <i class="fa fa-angle-double-left"></i> {{ __('Kembali') }}
                </a>

                <button type="submit" id="emptyCartBtn" class="btn-flat btn btn-danger">
                    <i class="fa fa-trash"></i> {{ __('Kosongkan Cart') }}
                </button>

                <a href="{{ route('barang-keluar.checkout') }}" id="btbSubmit"
                    class="btn-flat btn btn-success pull-right">
                    <i class="fa fa-shopping-cart"></i> {{ __('Check out') }}
                </a>

            </x-slot>
        </x-box>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection


@section('javascript')
<script type="text/javascript">

    const routeIndex = "{{ route('barang-masuk.index') }}";

    const getBarangUrl = "{{ route('api.get-barang', ['kode_barang' => ':kode_barang']) }}";

    // Fetch Barang
    document.getElementById('kodebaranginput').addEventListener('blur', function () {
        const kodeBarang = this.value;

        if (kodeBarang.trim() !== '') {
            const url = getBarangUrl.replace(':kode_barang', kodeBarang);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // console.log(data)
                    if (data.success) {
                        document.getElementById('satuan').value = data.satuan;
                        document.getElementById('nama_barang').value = data.nama_barang;
                        document.getElementById('hargaBeli').value = data.harga;
                    } else {
                        swal("Galat!", "Barang tidak ditemukan", "error");
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    })

    //Delete item from Cart
    function deleteItem(key) {
        // Menampilkan konfirmasi sebelum menghapus
        swal({
            title: "Apakah Anda yakin?",
            text: "Item ini akan dihapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus!"
        }, function (isConfirm) {
            if (isConfirm) {
                // Menggunakan route Laravel untuk mendapatkan URL yang benar
                let deleteUrl = '{{ route("barang-keluar.removecartitem", ":key") }}';

                deleteUrl = deleteUrl.replace(':key', key); // Ganti :key dengan id yang benar
                console.log(deleteUrl)

                // Mengirim permintaan AJAX untuk menghapus item
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Pastikan token CSRF ada
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Menampilkan notifikasi sukses
                            swal(
                                'Dihapus!',
                                'Item telah dihapus.',
                                'success'
                            );
                            // Reload halaman atau mengupdate tampilan cart
                            location.reload();
                        } else {
                            swal(
                                'Gagal!',
                                'Item gagal dihapus.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        swal(
                            'Error!',
                            'Terjadi kesalahan saat menghapus item.',
                            'error'
                        );
                    });
            }
        });
    }

    // jQuery Ajax
    $(function () {

        // Reactive Harga Beli
        $("#hargaBeli, #qty").on("input", function () {
            var Qty = parseFloat($('#qty').val()) || 0;
            var hargaBeli = parseFloat($('#hargaBeli').val()) || 0;
            $("#totalHarga").val(Qty * hargaBeli);
        })

        // Add to Cart
        $('.add-to-cart-form').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'), // URL dari form action
                type: $(this).attr('method'), // Metode POST
                data: formData, // Data form
                processData: false, // Jangan memproses data form
                contentType: false, // Jangan set contentType, biarkan browser menangani multipart
                success: function (response) {
                    if (response.success) {
                        // Jika berhasil, reload halaman
                        location.reload();
                    } else {
                        // Tampilkan pesan kesalahan jika ada
                        swal('Error', response.message, 'error');
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // Menampilkan error dari response JSON
                        var errorMessage = xhr.responseJSON.errors.quantity ? xhr.responseJSON.errors.quantity[0] : 'Terjadi kesalahan';
                        swal('Error', errorMessage, 'error');
                    } else {
                        swal('Error', 'Terjadi kesalahan sistem', 'error');
                    }
                }
            });
        });

        //Kosongkan Cart
        $('#emptyCartBtn').on('click', function (e) {
            e.preventDefault();  // Mencegah form submit secara normal

            // Menampilkan konfirmasi dengan SweetAlert
            swal({
                title: "Apakah Anda yakin?",
                text: "Anda akan mengosongkan cart.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }, function (willDelete) {
                if (willDelete) {
                    // Kirimkan permintaan AJAX
                    $.ajax({
                        url: "{{ route('barang-keluar.emptyCart') }}",  // Gantilah dengan route yang sesuai
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',  // Pastikan csrf token disertakan
                        },
                        success: function (response) {
                            if (response.success) {
                                // Tampilkan pesan sukses dan reload halaman
                                swal("Cart telah dikosongkan!", {
                                    icon: "success",
                                });
                                location.reload();
                            } else {
                                // Tampilkan pesan error jika gagal
                                swal("Terjadi kesalahan, coba lagi.", {
                                    icon: "error",
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            swal("Terjadi kesalahan, coba lagi.", {
                                icon: "error",
                            });
                        }
                    });
                }
            });
        });

        //Datatable modal Barang
        // Inisialisasi DataTable
        var table = $('#barangTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.get-barang-list') }}", // Ganti dengan route API yang mengembalikan data barang
            columns: [
                { data: 'kode', name: 'kode' },
                { data: 'nama', name: 'nama' },
                { data: 'harga', name: 'harga', sortable: false, searchable: false },
                { data: 'satuan.nama', name: 'satuan', sortable: false, searchable: false }
            ]
        });

        // Event listener untuk klik pada baris DataTable
        $('#barangTable tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            //console.log(data)
            var kodeBarang = data.kode;  // Ambil kode barang dari data baris yang dipilih
            var namaBarang = data.nama;  // Ambil kode barang dari data baris yang dipilih
            var satuanBarang = data.satuan.nama;  // Ambil kode barang dari data baris yang dipilih
            var harga = parseInt(data.harga);  // Ambil kode barang dari data baris yang dipilih

            // Isi nilai kode barang ke dalam input field
            $('#kodebaranginput').val(kodeBarang);
            $('#satuan').val(satuanBarang);
            $('#nama_barang').val(namaBarang);
            $('#hargaBeli').val(harga);

            // Optional: Menutup modal setelah memilih kode barang
            $('#modal-list-barang').modal('hide');
        });

    });
</script>
@stop