@extends('layouts.backend')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Perpustakaan
      </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Pengembalian</h3>
            </div>
            <div class="box-body">
                <a class="btn btn-success" href="javascript:void(0)" id="createNewPengembalian">Buat Pengembalian</a>
                <a href="viewpdf" class="btn btn-success" target="_blank">Cetak PDF</a>
                <a href="pengembalian-export_excel" class="btn btn-success" target="_blank">EXPORT EXCEL</a>

                <br>
                <br/>
                <table class="table table-bordered data-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kembali</th>
                            <th>Kode Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Jatuh Tempo</th>
                            <th>Jumlah Hari</th>
                            <th>Total Denda</th>
                            <th>Petugas</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="modal" id="ajaxModel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modelHeading"></h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger" style="display:none"></div>
                                <form id="pengembalianForm" name="pengembalianForm" class="form-horizontal" >
                                <input type="hidden" name="pengembalian_id" id="pengembalian_id">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Kode Kembali</label>
                                            <input type="text" class="form-control" id="kode_kembali" name="kode_kembali" placeholder="Kode Kembali" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Kode Pinjam</label>
                                            <select name="kode_pinjam" class="form-control" id="kode_pinjam">
                                                <option selected disabled>Pilih Kode Pinjam</option>
                                            </select>
                                            <input type="hidden">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Tanggal Kembali</label>
                                            <input type="text" class="form-control datepicker" id="tanggal_kembali" name="tanggal_kembali" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Jatuh Tempo</label>
                                            <input type="hidden" name="jatuh_tempo" class="jatuh_tempo" value="">
                                            <input type="text" class="form-control datepicker" nama="jatuh_tempo" id="jatuh_tempo" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Petugas</label>
                                            <input type="hidden" name="kode_petugas" class="kode_petugas" value="">
                                            <input type="text" class="form-control" id="kode_petugas" placeholder="Nama Petugas" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Anggota</label>
                                            <input type="hidden" name="kode_anggota" class="kode_anggota" value="">
                                            <input type="text" class="form-control" id="kode_anggota" placeholder="Nama Anggota" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Buku</label>
                                            <input type="text" class="form-control" id="kode_buku" placeholder="Nama Buku" value="" disabled>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan</button>
                                    <button type="submit" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $("#e1").select2();
    });
</script>
<script type="text/javascript">
$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('pengembalian') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kode_kembali', name: 'kode_kembali'},
            {data: 'kode_pinjam', name: 'kode_pinjam'},
            {data: 'tanggal_kembali', name: 'tanggal_kembali'},
            {data: 'jatuh_tempo', name: 'jatuh_tempo'},
            {data: 'jumlah_hari', name: 'jumlah_hari'},
            {data: 'total_denda', name: 'total_denda'},
            {data: 'nama_petugas', name: 'kode_petugas'},
            {data: 'nama_anggota', name: 'kode_anggota'},
            {data: 'buku', name: 'buku'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewPengembalian').click(function () {
        $('#ajaxModel').fadeIn('slow');
        $('#saveBtn').val("create-pengembalian");
        $('#pengembalian_id').val('');
        $('#pengembalianForm').trigger("reset");
        $('#modelHeading').html("Buat Pengembalian");
        $('#ajaxModel').modal({backdrop: 'static', keyboard: false});
        $('#ajaxModel').modal('show');
        $('.alert-danger').html('');
        $('.alert-danger').css('display','none');

    });

     $.ajax({
        url: "{{ url('buku') }}",
        method: "GET",
        dataType: "json",
        success: function (berhasil) {
            console.log(berhasil)
            $.each(berhasil.data, function (key, value) {
                $("#kode_buku").append(
                    `
                        <option value="${value.id}">${value.judul}</option>
                    `
                )
            })
        },
    });

    $.ajax({
        url: "{{ url('anggota') }}",
        method: "GET",
        dataType: "json",
        success: function (berhasil) {
            console.log(berhasil)
            $.each(berhasil.data, function (key, value) {
                $("#kode_anggota").append(
                    `
                        <option value="${value.id}">${value.nama}</option>
                    `
                )
            })
        },
    });

    $.ajax({
        url: "{{ url('petugas') }}",
        method: "GET",
        dataType: "json",
        success: function (berhasil) {
            console.log(berhasil)
            $.each(berhasil.data, function (key, value) {
                $("#kode_petugas").append(
                    `
                        <option value="${value.id}">${value.nama}</option>
                    `
                )
            })
        },
    });

    $.ajax({
        url: "{{ url('peminjaman') }}",
        method: "GET",
        dataType: "json",
        success: function (berhasil) {
            console.log(berhasil)
            $.each(berhasil.data, function (key, value) {
                $("#kode_pinjam").append(
                    `
                        <option value="${value.id}">${value.kode_pinjam}</option>
                    `
                )
            })
        },
    });

    $('body').on('click', '.editPengembalian', function () {
        var pengembalian_id = $(this).data('id');
        $.get("{{ url('pengembalian') }}" +'/' + pengembalian_id +'/edit', function (data) {
            $('#ajaxModel').fadeIn('slow');
            $('#modelHeading').html("Edit Pengembalian");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal({backdrop: 'static', keyboard: false});
            $('#ajaxModel').modal('show');
            $('#pengembalian_id').val(data.kem.id);
            $('#kode_kembali').val(data.kem.s);
            $('#kode_pinjam').val(data.kem.kode_pinjam);
            $('.jatuh_tempo').val(data.kem.jatuh_tempo);
            $.each(data.dit, function(key, value){

                console.log(data.dit);
                $('#tanggal_kembali').val(value.tanggal_kembali);
                $('#jatuh_tempo').val(value.jatuh_tempo);
                $('#kode_anggota').val(value.nama_anggota);
                $('#kode_petugas').val(value.nama_petugas);
                $('.kode_anggota').val(value.id_anggota);
                $('.kode_petugas').val(value.id_petugas);
            });
            console.log(data);
            $('#kode_buku').val(data.databuku);
            $('.alert-danger').html('');
            $('.alert-danger').css('display','none');
        });
    });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Simpan');
            $.ajax({
            data: $('#pengembalianForm').serialize(),
            url: "{{ url('pengembalian-store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#pengembalianForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
                Swal.fire({
                    position : 'center',
                    type : 'success',
                    animation : 'false',
                    title : 'Berhasil di Simpan',
                    showConfirmButton : false,
                    timer : 1000,
                    customClass : {
                        popup : 'animated bounceOut'
                    }
                });
            },
            error: function (request, status, error) {
                $('.alert-danger').html('');
                json = $.parseJSON(request.responseText);
                $.each(json.errors, function(key, value){
                    $('.alert-danger').show();
                    $('.alert-danger').append('<p>'+value+'</p>');
                });
            }
        });
    });

    $('body').on('click', '.deletePengembalian', function () {
        var pengembalian_id = $(this).data("id");
        Swal.fire({
        title: 'Apakah Kamu Yakin?',
        text: "Kamu Tidak Dapat Mengembalikannya Lagi!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('pengembalian-store') }}"+'/'+pengembalian_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            Swal.fire(
            'Hapus!',
            'Berhasil Dihapus.',
            'success'
            )
        }
        })
    });

    $(function() {
        $('input').keypress(function() {
            $('.alert-danger').css('display','none');
        });
    });

    $('#kode_pinjam').on('change', function(){
        var kode_pinjam = $(this).val();
        $.ajax({
            url : 'pengembalian-db/'+kode_pinjam,
            method : 'get',
            dataType : 'json',
            success : function (berhasil) {
                $.each(berhasil.pengembalian, function(key, value){
                    console.log(value);
                    $('#kode_anggota').val(value.nama_anggota);
                    $('#kode_petugas').val(value.nama_petugas);
                    $('#jatuh_tempo').val(value.jatuh_tempo);
                    $('.jatuh_tempo').val(value.jatuh_tempo);
                    $('.kode_anggota').val(value.id_anggota);
                    $('.kode_petugas').val(value.id_petugas);
                });
                $('#kode_buku').val(berhasil.buku);
            },
        });
    });

    $(function () {
        $('input').keypress(function() {
            $('.alert-danger').css('display','none');
        });

        $('#tanggal_kembali').change(function() {
            if(!$('#kode_pinjam').val()) {
                Swal.fire(
                    'Oops..',
                    'kode pinjam harus di isi terlebih dahulu',
                    'warning'
                )
                var now = new Date();
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var today = now.getFullYear()+"-"+(month)+"-"+(day);

                $(this).val(today);
                return;
            }
            let tgl_kembali = new Date ($(this).val());
            let tgl_pinjam = new Date($('#tanggal_pinjam').val());
            let diff = new Date(tgl_kembali - tgl_pinjam);
            let days = diff/1000/60/24;

            if(days < 0)
            {
                Swal.fire(
                    'Oops..',
                    'tangal pengembalian tidak boleh kurang dari tanggal peminjaman',
                    'warning'
                )
                var now = new Date();
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var today = now.getFullYear()+"-"+(month)+"-"+(day);

                $(this).val(today);
                return;
            }
        })
    });

    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
    });
});
</script>
@endsection
