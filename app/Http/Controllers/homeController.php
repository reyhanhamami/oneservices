<?php

namespace App\Http\Controllers;

use App\customer;
use App\Exports\uploadcampaign;
use Validator;
use Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Http\Request;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }
    public function uploadcampaign(){
        $campaign = customer::whereNotNull('campaignId_3cx')->orWhere('campaignId_3cx','=','')->get();
        return view('upload.uploadcampaign',compact('campaign'));
    }

    public function upload(Request $request){
        $error = Validator::make($request->all(),[
            'upload' => 'required|mimes:xls,xlsx'
        ]);    
        if ($error->fails()) {
            return response()->json(['erorrs' => $error->errors()->all()]);
        }
        if ($request->hasFile('upload')) {
            $file = $request->file('upload'); //get name file upload
            // Excel::import(new transaksi_import, $file);
            $tes = Excel::toArray(new uploadcampaign, $file);
            foreach ($tes as $index => $te) {
                if ($te[$index]['no_hp_wakif'] != null) {
                    foreach ($te as $t) {
                        customer::where('MobilePhone','=', $t['no_hp_wakif'])
                        ->whereNull('Parent_CustomerNo')
                        ->orderBy('CustomerNo','ASC')
                        ->update([
                            'campaignId_3cx' => $t['nama_campaign'],
                            '3cx_callPriority' => $t['prioritas_di_telpon'],
                            '3cx_queue' => $t['extension'],
                            '3cx_callStatus' => '0',
                            '3cx_callResult' => 'False'
                        ]);
                    }
                } else {
                    return response()->json(['failed' => 'Harap Isi No Hp Wakif dengan benar']);
                }
            }
            return response()->json(['success' => 'File Berhasil diupload']);

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        //
    }
}
