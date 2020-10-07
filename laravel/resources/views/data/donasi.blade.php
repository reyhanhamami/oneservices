@extends('template.header')

@section('konten')
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted">Update Status call</h5>
                <form action="">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal terakhir telpon</label>
                        <input class="form-control lastcall" name="lastcall" type="text" readonly="" placeholder="Last call" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <input class="form-control calltype" type="text" readonly="" name="calltype" placeholder="Status" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Durasi</label>
                        <input class="form-control duration" type="text" readonly="" placeholder="Duration" name="duration" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Catatan</label>
                        <textarea class="form-control note" name="note" id="" cols="30" rows="2"></textarea>
                    </div>
                    <button type="button" class="btn mb-1 btn-success ">Update <span class="btn-icon-right"><i class="fa fa-check"></i></span></button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card card-widget">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Input Donasi</h4>
                <div class="basic-form">
                    <form>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                <select name="pembayaran" id="pembayaran" class="custom-select">
                                    <option>pilih pembayaran</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-group">
                                        <input name="tgltra" type="text" onfocus="(this.type='date')" class="form-control", placeholder="tanggal transaksi">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="tglset" onfocus="(this.type='date')" class="form-control", placeholder="tanggal Setor">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Lampirkan bukti transfer</label>
                            <input type="file" class="form-control-file">
                        </div>
                        <a href="javascript:void(0)" class="addMore">
                            <div class="input-group-addon "> 
                                <i class="fas fa-plus"> Tambah</i>
                            </div>
                        </a>
                        <div class="form-row fieldGroup">
                                <div class="col">
                                    <select name="program[]" id="program" class="custom-select" required>
                                        <option value="">-Program-</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="project[]" id="" class="custom-select" required>
                                        <option value="">-Project-</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" name="qty[]" class="form-control" placeholder="Qty" required/>
                                </div>
                                <div class="col">
                                    <input type="text" name="dana[]" class="form-control" placeholder="Dana" required/>
                                </div>
                                <!-- <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah"/> -->
                                <a href="javascript:void(0)" class=" remove">
                                    <div class="input-group-addon"> 
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </a>
                        </div>
                        <button type="submit" class="btn btn-dark">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Table Striped</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Agent</th>
                                <th>Last Call</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>Kolor Tea Shirt For Man</td>
                                <td><span class="badge badge-primary px-2">Sale</span>
                                </td>
                                <td>January 22</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            // membatasi jumlah inputan
            var maxGroup = 10;
            
            //melakukan proses multiple input 
            $(".addMore").click(function(){
                if($('body').find('.fieldGroup').length < maxGroup){
                    var fieldHTML = '<div class="form-row fieldGroup">'+$(".fieldGroup").html()+'</div>';
                    $('body').find('.fieldGroup:last').after(fieldHTML);
                }else{
                    alert('Maximum '+maxGroup+' groups are allowed.');
                }
            });
            
            //remove fields group
            $("body").on("click",".remove",function(){ 
                if ($('.remove').length > 1) {
                    $(this).parents(".fieldGroup").remove();
                } else {

                }
            });
        });
    </script>
@endpush