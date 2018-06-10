<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';

    protected $fillable = [
        'image', 'caption', 'is_active', 'posted_by', 'modified_by'
    ];

    public function created_at()
    {
        $date = $this->created_at;

        $bln = [
            "",
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
        $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
        $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
        $jam = substr($date,10);

        return $tgl . " " . $bln[(int)$bulan] . " ". $tahun. " ".$jam;

    }

    public function updated_at()
    {
        $date = $this->updated_at;

        $bln = [
            "",
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
        $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
        $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
        $jam = substr($date,10);

        return $tgl . " " . $bln[(int)$bulan] . " ". $tahun. " ".$jam;

    }
}
