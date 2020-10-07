@extends('template.header')

@section('konten')
<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tab untuk ke halaman selanjutnya</h4>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs mb-3" role="tablist">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#home8"><span><i class="ti-user"></i>Wakif</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages8"><span><i class="ti-receipt"></i>Donasi</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile8"><span><i class="ti-comments"></i>Update Catatan</span></a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content tabcontent-border">
                <div class="tab-pane fade active show" id="home8" role="tabpanel">
                    <div class="p-t-15">
                                            
                        <h5 class="text-center">Data Wakif dan last call</h5>
                        <div class="row">
                        {{-- wakif  --}}
                        <div class="col-5 mt-4">
                            <form action="{{route('admin.wakifupdate')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text gradient-4">No Wakif</span></div>
                                    <input type="text" value="{{$wakif->CustomerNo}}" class="form-control" readonly name="customerno" id="customerno">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text gradient-4">Campaign</span></div>
                                    <input type="text" name="campaign" id="campaign" value="{{($wakif->campaignId_3cx) == NULL ? "-" : $wakif->campaignId_3cx}}" class="form-control" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text gradient-4">Nama</span></div>
                                    <input type="text" class="form-control" name="customername" id="customername" value="{{$wakif->CustomerName}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text gradient-4">Handphone</span></div>
                                    <input type="text" class="form-control" name="mobilephone" id="mobilephone" value="{{$wakif->MobilePhone}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text gradient-4">Email</span></div>
                                    <input type="text" class="form-control" name="customeremail" id="customeremail" value="{{$wakif->customeremail}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text gradient-4">Kota</span></div>
                                    <input type="text" class="form-control" name="city" id="city" value="{{$wakif->City}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text gradient-4">Alamat</span></div>
                                    <input type="text" class="form-control" name="address" id="address" value="{{$wakif->Address}}">
                                </div>
                                <div class="sweetalert">
                                    <button type="submit" class="btn btn-primary sweet-success">Perbaharui data wakif<span class="btn-icon-right"><i class="ti-user"></i></span></button>
                                </div>
                            </form>
                        </div>
                        <!-- last call  -->
                        <div class="col-7">
                            <div class="card-body">
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
                                            @foreach ($listcall as $call)
                                            <tr>
                                                <th>{{$loop->iteration}}</th>
                                                <td><span class="badge badge-primary px-2">{{$call->nm_sales == NULL ? 'No Agent' : $call->nm_sales}} - {{$call->agent}}</span></td>
                                                <td>{{date('d-M-Y', strtotime($call->date))}}</td>
                                                <td>{{$call->Call_note}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile8" role="tabpanel">
                    <div class="p-t-15">
                        <div class="col-5">
                            {{-- <h4 class="card-title">Update status pembicaraan</h4> --}}
                            <form action="">
                                <div class="form-group">
                                    <label id="attention" for="exampleInputEmail1" style="font-weight:bold;"><span class="text-danger">*info</span> Untuk memperbaharui ringkasan obrolan dengan wakif, pastikan telepon sudah ditutup, apakah telepon sudah ditutup? <button type="button" class="btn btn-dark" id="buttonattention"> Iya</button></label>
                                    <label id="showlabel" for="exampleInputEmail1" style="display:none">perbaharui informasi !!, simpan ringkasan hasil obrolan dengan wakif</label>
                                    <textarea class="form-control note" name="note" id="note" cols="30" rows="2" readonly></textarea>
                                </div>
                                <button id="showbutton" type="button" class="btn mb-1 btn-info updatecatatan" style="display:none">Perbaharui catatan<span class="btn-icon-right"><i class="ti-receipt"></i></span></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="messages8" role="tabpanel">
                    <div class="p-t-15">
                        <div class="row">
                            <div class="col-5">
                                <h4 class="card-title">Informasi wakif</h4>
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">Nomer</strong> <span>{{$wakif->CustomerNo}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Nama Pendaftar</strong> <span>{{$wakif->CustomerName}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Handphone</strong> <span>{{($wakif->MobilePhone == null) ? "-" : $wakif->MobilePhone}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Telepon</strong> <span>{{($wakif->phone == null) ? "-" : $wakif->phone}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Email</strong> <span>{{($wakif->customeremail == null) ? "-" : $wakif->customeremail}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Kota</strong> <span>{{($wakif->City == null) ? "-" : $wakif->City}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Alamat</strong> <span>{{($wakif->Address == null) ? "-" : $wakif->Address}}</span></li>
                                </ul>
                            </div>
                            <div class="col-7">
                                <h4 class="card-title">Input Donasi</h4>
                                <div class="basic-form">
                                    <form action="{{route('admin.simpandonasi')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <input type="hidden" value="{{$wakif->CustomerNo}}" name="kd_pelanggan">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                <select name="pembayaran" id="pembayaran" class="custom-select js-example-basic-single">
                                                    <option value="">pilih pembayaran</option>
                                                    @foreach ($pembayaran as $pem)
                                                        <option value="{{$pem->nm_kas}}">{{$pem->nm_kas}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="">Nama Wakif</label>
                                                        <input name="wakif" type="text" id="wakif" class="form-control"  value="{{$wakif->CustomerName}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <input name="tgltra" type="text" onfocus="(this.type='date')" class="form-control"  placeholder="tanggal transaksi">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" name="tglset" onfocus="(this.type='date')" class="form-control"  placeholder="tanggal Setor">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Lampirkan bukti transfer</label>
                                            <input type="file" name="pict" class="form-control-file">
                                        </div>
                                        <a href="javascript:void(0)" class="addMore">
                                            <div class="input-group-addon "> 
                                                <i class="fas fa-plus"> Tambah</i>
                                            </div>
                                        </a>
                                        <div class="form-row fieldGroup">
                                                <div class="col">
                                                    <select name="program[]" id="program" class="custom-select" required="">
                                                        <option value="">-Program-</option>
                                                        @foreach ($program as $prog)
                                                        <option value="{{$prog->kd_program}}">{{$prog->nm_program}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select name="project[]" id="project" class="custom-select" required="">
                                                        <option value="">-Project-</option>
                                                        @foreach ($project as $proj)
                                                            <option value="{{$proj->kd_project}}">{{$proj->nm_project}}</option>
                                                            
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="qty[]" class="form-control" placeholder="Qty" required="">
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="dana[]" class="form-control" placeholder="Dana" required="">
                                                </div>
                                                <!-- <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah"/> -->
                                                <a href="javascript:void(0)" class=" remove">
                                                    <div class="input-group-addon"> 
                                                        <i class="fas fa-trash"></i>
                                                    </div>
                                                </a>
                                        </div>
                                        <div class="buttondonasi" id="buttondonasi">
                                            <button type="submit" class="btn btn-dark">Simpan</button>
                                        </div>
                                    </form>

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
    //select2
    $('#pembayaran').select2();
    $('#program').select2();
    $('#project').select2();
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

        // sweetalert 
        $('.sweet-success').click(function(){
            swal({
                title:"Tunggu sebentar ya ^^",
                text: "data wakif lagi di perbaharui",
                // timer:2e5,
                showConfirmButton:!1
            });
            // location.reload();
        });
        $('#buttondonasi').click(function(){
            swal({"Berhasil !!","data berhasil di anuin","success"});
        });

        // jquery update catatan telpon 
        $('.updatecatatan').click(function(){
            var postdata = {
                'phone' : $('#mobilephone').val(),
                'note' : $('#note').val(),
                '_token': '{{csrf_token()}}'
            };
            $.ajax({
                type:'POST',
                url:"{{route("admin.noteupdate")}}",
                data:postdata,
                beforeSend:function(){
                    swal("Berhasil !!","informasi obrolan ringkas dengan wakif diperbaharui","success")
                },
            });
        });

        // show hide atau validasi untuk telpon yang harus di tutup 
        $("#buttonattention").click(function(){
            $('#note').attr('readonly',false);
            $("#attention").hide();
            $('#showbutton').show();
            $('#showlabel').show();
        });
 
    });
</script>
@endpush