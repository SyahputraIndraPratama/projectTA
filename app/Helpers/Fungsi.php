<?php


class Fungsi {

    public static function bulanindo($inputan)
    {
        $bulanindo = 'Januari';
        if ($inputan == '01') {
            $bulanindo = 'Januari';
        } elseif ($inputan == '02') {
            $bulanindo = 'Februari';
        } elseif ($inputan == '03') {
            $bulanindo = 'Maret';
        } elseif ($inputan == '04') {
            $bulanindo = 'April';
        } elseif ($inputan == '05') {
            $bulanindo = 'Mei';
        } elseif ($inputan == '06') {
            $bulanindo = 'Juni';
        } elseif ($inputan == '07') {
            $bulanindo = 'Juli';
        } elseif ($inputan == '08') {
            $bulanindo = 'Agustus';
        } elseif ($inputan == '09') {
            $bulanindo = 'September';
        } elseif ($inputan == '10') {
            $bulanindo = 'Oktober';
        } elseif ($inputan == '11') {
            $bulanindo = 'November';
        } else {
            $bulanindo = 'Desember';
        }

        return $bulanindo;
    }
    

}