<?php

namespace App\Http\Controllers;

use App\customer;
use App\call_journaling;
use App\donasi;
use App\donasi_dtl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class dataController extends Controller
{
    // datatable untuk data wakif 
    public function datawakif(Request $request){
        if ($request->ajax()) {
            $data = customer::whereNull('Parent_CustomerNo')
                    ->whereNotNull('MobilePhone')
                    ->select('CustomerNo','CustomerName','MobilePhone','customeremail','address');
            return Datatables::of($data)
                    ->addColumn('action', function($row){
                        $btn = "<a href='../../oneservice/datawakif/donasi/".$row->MobilePhone."' class='edit btn btn-primary btn-sm'>Donasi</a>";
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('data.datawakif');
    }

    public function donasi(Request $request){
        return view('data.donasi');
    }
    public function simpandonasi(Request $request){
        // nokwitansi 
        $nokwi = "TF-".date('YmdHis');
        // total 
        $total = 0;
        foreach ($request->program as $key => $prog) {
            $qty = $request[0]['qty'];
            $dana = $request->dana;
            $jumlah = (int)$qty * (int)$dana;
            dd($qty);
            $jumlah += $jumlah;
            $total = $jumlah; 
        }
        
        if ($request->pict) {
            $images = $request->file('pict');
            // kasihnama 
            $nama = date("Y-m-d,His").'.'.$images->getClientOriginalExtension();
            // lokasi naro bukti 
            $lokasi = public_path('public/assets/images/bukti');
            // jika folder bukti tidak ada maka buat 
            if (!file_exists($lokasi)) {
                mkdir($lokasi);
            }
            // pindahin imagenya 
            $images->move($lokasi.'/'.$nama);

            $data['bukti'] = $nama;
        } else {
            // insert ke table tdonasi 
            $tdonasi = new donasi;
            $tdonasi->no_kwitansi = $nokwi;
            $tdonasi->nm_wakif = $request->wakif;
            $tdonasi->kd_kas = $request->pembayaran;
            $tdonasi->kd_pelanggan = $request->kd_pelanggan;
            $tdonasi->kd_agen = '1';
            $tdonasi->tgl = $request->tgltra ;
            $tdonasi->total = $request->total ;
            $tdonasi->sah  = 0;
            $tdonasi->kd_tkm  = $ac_tkm->kd_tkm;
            $tdonasi->uid = Auth::user()->nm_login;
            $tdonasi->tgl_tambah = $datetime;
            $tdonasi->uid_edit = Auth::user()->nm_login ;
            $tdonasi->tgl_edit = $datetime ;
            $tdonasi->ket = 'Uji Coba Reyhan' ;
            $tdonasi->tgl_transaksi = $tgl_transaksi_time;
            $tdonasi->kd_sales = "";
            $tdonasi->posting = 1 ;
            $tdonasi->sumber = 'uji_coba_reyhan' ;
            $tdonasi->fkd_akun = NULL ;
            $tdonasi->fjenis_aktivitas = NULL ;
            $tdonasi->fsub_jenis_aktivitas = NULL ;
            $tdonasi->fnm_pendaftar = ''   ;
            $tdonasi->kd_cabang = $request->cabang  ;
            $tdonasi->alur_kerja = $request->alur_kerja ;
            $tdonasi->biaya_bank = $request->biaya_bank ;
            $tdonasi->konfirmasi  = NULL;
            $tdonasi->tgl_konfirmasi = NULL ;
            $tdonasi->catatan_konfirmasi  = NULL;
            $tdonasi->update_project = NULL ;
            $tdonasi->save();
            
            // looping berdasarkan banyaknya milih program 
            // insert ke table tdonasi_dtl
            foreach ($request->mprogram as $index => $program) {
                $tdonasi_dtl = new donasi_dtl ;
                $tdonasi_dtl->no_kwitansi = $request->no_kwitansi ;
                $tdonasi_dtl->kd_program = $request->mprogram[$index];
                $tdonasi_dtl->kd_project = $request->mproject[$index];
                $tdonasi_dtl->qty = $request->qty[$index];
                $tdonasi_dtl->jmh = $request->jmh[$index];
                $tdonasi_dtl->fid_program = NULL ;
                $tdonasi_dtl->fid_sub_program = NULL ;
                $tdonasi_dtl->fqty = NULL;
                $tdonasi_dtl->fharga = NULL;
                $tdonasi_dtl->frealisasi = NULL;
                $tdonasi_dtl->fid_detail = NULL ;
                $tdonasi_dtl->sumber = 'uji_coba_reyhan' ;
                $tdonasi_dtl->save();
            }
        }



    }

    public function popupcus(Request $request){
        // get url 
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        // pecah url 
        $url_component = parse_url($actual_link);
        parse_str($url_component['query'], $params);
        // parameter phone 
        $phone = $params['v_phone'];
        // get data wakif
        $wakif = customer::whereNull('Parent_CustomerNo')->where('MobilePhone',$phone)->orderBy('customerid','ASC')->first();
        // get data list last call
        $listcall = DB::connection('mysqltwo')->table('call_journaling')->where('phone',$phone)->leftJoin('khidma.msales','msales.3cx_ext','call_journaling.agent')->orderBy('id','DESC')->paginate('5');
        // get last call 
        $lastcall = DB::connection('mysqltwo')->table('call_journaling')->where('phone',$phone)->orderBy('id','desc')->first();
        // ambil data pembayaran 
        $pembayaran = DB::connection('mysql')->table('mkas')->get();
        // program 
        $program = DB::connection('mysql')->table('mprogram')->get();
        // project 
        $project = DB::connection('mysql')->table('mproject')->get();
        return view('popup.cuspopup', compact(['wakif','listcall','lastcall','pembayaran','program','project']));
    }

    public function wakifupdate(Request $request) {
        $cusno = $request->customerno;
        $tes = customer::where('CustomerNo',$cusno)->update([
            'CustomerName' => $request->customername,
            'MobilePhone' => $request->mobilephone,
            'customeremail' => $request->customeremail,
            'city' => $request->city,
            'address' => $request->address
        ]);
            return redirect()->back();
    }

    public function noteupdate(Request $request) {
        $phone = $request->phone;
        // kasih waktu 100 detik baru update notenya 
        sleep(3);
        // get last id 
        $carilast = DB::connection('mysqltwo')->table('call_journaling')->where('phone',$phone)->orderBy('id','desc')->pluck('id')->first();
        // update catatan last id 
        call_journaling::whereId($carilast)->update([
            'Call_note' => $request->note
        ]);
    }
}
