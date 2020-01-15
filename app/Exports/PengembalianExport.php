<?php

namespace App\Exports;

use App\Pengembalian;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengembalianExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = [];

        $pengembalian = pengembalian::all();
        foreach ($pengembalian as $row){
            foreach($row->peminjaman->buku as $key){
                $buku[] = $key->judul;
            }
            $obj = new \stdClass();
            $obj->kode_kembali =$row->kode_kembali;
            $obj->kode_peminjamam =$row->peminjaman->kode_peminjamam;
            $obj->tangaal_kembali =$row->peminjaman->tangaal_kembali;
            $obj->jatuh_tempo =$row->jatuh_tempo;
            $obj->jumlah_hari =$row->jumlah_hari;
            $obj->total_denda =$row->total_denda;
            $obj->petugas =$row->petugas->nama;
            $obj->anggota =$row->anggota->nama;
            $obj->buku = $buku;
            $data[] = $obj;
        }
        return collect($data);
    }
}
