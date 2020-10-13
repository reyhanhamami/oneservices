<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use App\customer;
use App\donasi_dtl;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function pembayaran(){
        // ambil data pembayaran 
        $pembayaran = DB::connection('mysql')->table('mkas')->get();
        return $pembayaran;
    }
    public function program(){
        // program 
        $program = DB::connection('mysql')->table('mprogram')->get();
        return $program;
    }
    public function project(){
        // project 
        $project = DB::connection('mysql')->table('mproject')->get();
        return $project;
    }
    public function wakif($kd_pelanggan){
        $wakif = customer::where('CustomerNo',$kd_pelanggan)->first();
        return $wakif;
    }
    public function deleteDonasiDtl($kwitansi){
        return donasi_dtl::where('no_kwitansi',$kwitansi)->delete();
    }
}
