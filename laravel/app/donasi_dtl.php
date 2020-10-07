<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class donasi_dtl extends Model
{
    protected $connection = 'mysqlthree';
    public $table = 'tdonasi_dtl';
    protected $fillable = ['kd','no_kwitansi','kd_program','kd_project','qty','jmh','fid_program',
    'fid_sub_program','fqty','fharga','frealisasi','fid_detail','sumber'];
    protected $primaryKey = 'kd';
    public $timestamps = false;

}
