<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;

class ABCController extends Controller
{
    public static function formatangka($a) 
    {
         $a = str_replace( '.', '', $a);
         return $a;
    }
    public static function round_up($value,$precision)
    {
        $pow = pow ( 10, $precision ); 
        return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;
    }
    public static function getNextDate($index,$day){
      if($index > 12) {
        $bulan = $index % 12;
        //$tahun = date('Y')+floor($index/12);
        $tahun = date('Y',strtotime('+'.floor($index/12).' years'));
      } else {
        $bulan = $index;
        $tahun = date('Y');  
      }
      $lastDate = date('t',strtotime($tahun.'-'.$bulan.'-01'));
      if(intval($day) > intval($lastDate)){
          $nextDay = $lastDate;
      }else{
          $nextDay = $day;
      }
      $tgl = array($nextDay,$bulan,$tahun);
      return $tgl;
    }
    public static function pembulatanAngsuran($a){
        $a = $number = ceil($a/100)*100;
        return $a;
    }
    public static function pembulatan($a){
         $a = $number = ceil($a);
        return $a;
    }
    public static function romanNumerals($num) 
    {
        $n = intval($num);
        $res = '';
     
        /*** roman_numerals array  ***/
        $roman_numerals = array(
                    'M'  => 1000,
                    'CM' => 900,
                    'D'  => 500,
                    'CD' => 400,
                    'C'  => 100,
                    'XC' => 90,
                    'L'  => 50,
                    'XL' => 40,
                    'X'  => 10,
                    'IX' => 9,
                    'V'  => 5,
                    'IV' => 4,
                    'I'  => 1);
     
        foreach ($roman_numerals as $roman => $number) 
        {
            /*** divide to get  matches ***/
            $matches = intval($n / $number);
     
            /*** assign the roman char * $matches ***/
            $res .= str_repeat($roman, $matches);
     
            /*** substract from the number ***/
            $n = $n % $number;
        }
     
        /*** return the res ***/
        return $res;
    }
    public static function paginate($limit,$page,$data,$url){
        $limit = $limit;
        //$offset = ($page-1) * $limit;

        $total = count($data);
        //$data = new Paginator($data, $total, $limit,$page,array("path" => url($url)));
        
        $pagination = new Paginator($data, $total, $limit,$page,array("path" => url($url)));
        $pagination = $pagination->toJson();
        $pagination = json_decode($pagination);

        //return array('data'=>$data,'pagination'=>$pagination);
        return array('pagination'=>$pagination);
    }
    public static function checkListJaminanKendaraan(){
        return array(
                'asli_stnk'  =>  array(
                        'tersedia'  => 0,
                        'tanggal'   => null,
                    ),
                'copy_stnk' => 0,
                'asli_bpkb'  => array(
                        'tersedia'  => 0,
                        'tanggal'   => null,
                    ),
                'copy_bpkb' =>  0,
                'copy_kwitansi_pembelian' => 0,
                'copy_kwitansi_an_bpkb' =>  0,
                'copy_ktp_an_bpkb'  =>  0,
                'copy_faktur'   =>  0,
                'cek_fisik_samsat'  =>  0,
                'asli_gesekan'  =>  0,
                'cover_note' => 1
            );
    }
    public static function checkListJaminanTanahBangunan(){
        return array(
                'asli_sertifikat' => array(
                'tersedia'  =>  0,
                'tanggal'   => null,
                    ),
                'copy_sertifikat'   => 0,
                'copy_ktp'  => 0,
                'cover_note' => 0,
            );
    }
    public static function checkListJaminanMesinBerat(){
        return array(
                'asli_invoice'  =>  array(
                        'tersedia'  => 0,
                        'tanggal'   => null,
                    ),
                'copy_invoice'  => 0,
                'cover_note'    => 0,
            );
    }
    public static function separator($number){
        return number_format($number,0,",",".");
    }
    public static function terbilang($angka) {
        // pastikan kita hanya berususan dengan tipe data numeric
        $angka = (float)$angka;
         
        // array bilangan 
        // sepuluh dan sebelas merupakan special karena awalan 'se'
        $bilangan = array(
                '',
                'satu',
                'dua',
                'tiga',
                'empat',
                'lima',
                'enam',
                'tujuh',
                'delapan',
                'sembilan',
                'sepuluh',
                'sebelas'
        );
         
        // pencocokan dimulai dari satuan angka terkecil
        if ($angka < 12) {
            // mapping angka ke index array $bilangan
            return $bilangan[$angka];
        } else if ($angka < 20) {
            // bilangan 'belasan'
            // misal 18 maka 18 - 10 = 8
            return $bilangan[$angka - 10] . ' belas';
        } else if ($angka < 100) {
            // bilangan 'puluhan'
            // misal 27 maka 27 / 10 = 2.7 (integer => 2) 'dua'
            // untuk mendapatkan sisa bagi gunakan modulus
            // 27 mod 10 = 7 'tujuh'
            $hasil_bagi = (int)($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($angka < 200) {
            // bilangan 'seratusan' (itulah indonesia knp tidak satu ratus saja? :))
            // misal 151 maka 151 = 100 = 51 (hasil berupa 'puluhan')
            // daripada menulis ulang rutin kode puluhan maka gunakan
            // saja fungsi rekursif dengan memanggil fungsi terbilang(51)
            // Log::info('x '.self::terbilang($angka - 100));
            return sprintf('seratus %s', self::terbilang($angka - 100));
        } else if ($angka < 1000) {
            // bilangan 'ratusan'
            // misal 467 maka 467 / 100 = 4,67 (integer => 4) 'empat'
            // sisanya 467 mod 100 = 67 (berupa puluhan jadi gunakan rekursif terbilang(67))
            $hasil_bagi = (int)($angka / 100);
            $hasil_mod = $angka % 100;
            // $x = self::terbilang($hasil_mod);
            return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], self::terbilang($hasil_mod)));
        } else if ($angka < 2000) {
            // bilangan 'seribuan'
            // misal 1250 maka 1250 - 1000 = 250 (ratusan)
            // gunakan rekursif terbilang(250)
            // $x = self::terbilang($angka - 1000);
            return trim(sprintf('seribu %s', self::terbilang($angka - 1000)));
        } else if ($angka < 1000000) {
            // bilangan 'ribuan' (sampai ratusan ribu
            $hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
            $hasil_mod = $angka % 1000;
            // $x = self::terbilang($hasil_bagi);
            // $y = self::terbilang($hasil_mod);
            return sprintf('%s ribu %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod));
        } else if ($angka < 1000000000) {
            // bilangan 'jutaan' (sampai ratusan juta)
            // 'satu puluh' => SALAH
            // 'satu ratus' => SALAH
            // 'satu juta' => BENAR 
            // @#$%^ WT*
             
            // hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
            $hasil_bagi = (int)($angka / 1000000);
            $hasil_mod = $angka % 1000000;
            // $x = self::terbilang($hasil_bagi);
            // $y = self::terbilang($hasil_mod);
            return trim(sprintf('%s juta %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
        } else if ($angka < 1000000000000) {
            // bilangan 'milyaran'
            $hasil_bagi = (int)($angka / 1000000000);
            // karena batas maksimum integer untuk 32bit sistem adalah 2147483647
            // maka kita gunakan fmod agar dapat menghandle angka yang lebih besar
            $hasil_mod = fmod($angka, 1000000000);
            // $x = self::terbilang($hasil_bagi);
            // $y = self::terbilang($hasil_mod);
            return trim(sprintf('%s milyar %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
        } else if ($angka < 1000000000000000) {
            // bilangan 'triliun'
            $hasil_bagi = $angka / 1000000000000;
            $hasil_mod = fmod($angka, 1000000000000);
            // $x = self::terbilang($hasil_bagi);
            // $y = self::terbilang($hasil_mod);
            return trim(sprintf('%s triliun %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
        } else {
            return 'Wow...';
        }
    }
}
