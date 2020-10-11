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
                                <label id="attention" for="exampleInputEmail1" style="font-weight:bold;"><span class="text-danger">*info</span> Untuk memperbaharui ringkasan obrolan dengan wakif, pastikan telepon sudah ditutup, apakah telepon sudah ditutup? <button type="button" class="btn btn-dark" id="buttonattention"> Iya</button></label>
                                <label id="showlabel" for="exampleInputEmail1" style="display:none">perbaharui informasi !!, simpan ringkasan hasil obrolan dengan wakif</label>
                                <div class="form-row mb-2">
                                    <select name="status_call" id="status_call" class="custom-select" style="display: none">
                                        <option value="SC">Success Contact</option>
                                        <option value="NSC">Not Success Contactt</option>
                                        <option value="SS">Salah Sambung</option>
                                        <option value="BTP">Belum Terpasang</option>
                                        <option value="TDH">Tidak Dapat Dihubungi, no hape tidak aktif</option>
                                        <option value="TDR">Tidak Di Respon/Angkat</option>
                                    </select>
                                </div>
                                <div class="form-group">
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
                                    <form id="formdonasi" action="{{route('admin.simpandonasi')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <input type="hidden" value="{{$wakif->CustomerNo}}" name="kd_pelanggan">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                <select name="pembayaran" id="pembayaran" class="custom-select js-example-basic-single">
                                                    <option value="">pilih pembayaran</option>
                                                    @foreach ($pembayaran as $pem)
                                                        <option value="{{$pem->kd_kas}}">{{$pem->nm_kas}}</option>
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
                                                        <input name="tgltra" type="text" onfocus="(this.type='date')" class="form-control"  placeholder="tanggal komitmen">
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
                                            <label for="">Lampirkan bukti transfer <span class="text-danger text-small">*(Optional) bukti setelah wakif transfer</span></label>
                                            <input type="file" name="pict" class="form-control-file">
                                        </div> 
                                        <a href="javascript:void(0)" class="addMore btn btn-sm gradient-2 mb-3">
                                            <div class="input-group-addon "> 
                                                <i class="fas fa-plus"> Tambah Project</i>
                                            </div>
                                        </a>
                                        <div id="tambah">
                                        </div>
                                            <div class="form-row mb-2">
                                                <label for="">Total</label>
                                                <input type="text" name="total" id="total" class="form-control total" readonly>
                                            </div>
                                            <button type="submit" class="btn btn-dark buttondonasi" disabled>Simpan</button>
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
        $('#pembayaran').select2({ width: '100%' }); 
        // jika tidak ada projeck/program maka tombol submit disabled 
        //melakukan proses multiple input 
        $(".addMore").click(function(){
            var random = Math.floor((Math.random() * 100000) + 1);
            a = `
            <div class="form-row">
            <div class="col">
                <select name="program[]" id="program`+random+`" data-id="`+random+`" class="custom-select program" required="">
                    <option value="">-Program-</option>
                    @foreach ($program as $prog)
                    <option value="{{$prog->kd_program}}">{{$prog->nm_program}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="project[]" id="project`+random+`" data-id="`+random+`" class="custom-select project" required="" style="margin-left:0px !important">
                    <option value="">-Project-</option>
                    @foreach ($project as $proj)
                        <option value="{{$proj->kd_project}}">{{$proj->nm_project}}</option>
                        
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="text" name="qty[]" id="qty`+random+`" data-id="`+random+`" class="form-control qty" placeholder="Qty" required="">
            </div>
            <div class="col">
                <input type="text" name="dana[]" class="form-control dana" id="dana`+random+`" data-id="`+random+`" placeholder="Dana" required="">
            </div>
                <input type="text" name="jumlah[]" class="form-control jumlah" id="jumlah`+random+`" data-id="`+random+`" placeholder="jumlah" required="" style="display:none">
            <a href="javascript:void(0)" id="remove`+random+`" data-id="`+random+`" class="remove">
                <div class="input-group-addon"> 
                    <i class="fas fa-trash"></i>
                </div>
            </a>
            </div>
            `
            $('#tambah').append(a);
            // format RP menggunakan input mask 
            Inputmask.extendAliases({
                'Rupiah' : {
                    alias: 'numeric',
                    prefix : 'Rp ',
                    rightAlign : false,
                    digits : 0,
                    autoUnmask : true,
                    RemoveMaskOnSubmit : true,
                    unmaskAsNumber : true,
                    allowPlus : false,
                    allowMinus : false,
                    autoGrup : true,
                    groupSeparator : ",",
                }
            });
            $('.dana').inputmask('Rupiah');

            // select2 
            $('.program').select2({ width: '100%' }); 
            $('.project').select2({ width: '100%' }); 
            // tombol submit disabled false 
            $('.buttondonasi').attr('disabled',false);
        });
        
        //remove fields group
        $('#tambah').on('click','.remove',function(){
            var id = $(this).attr('data-id');
            var total = $('#total').val();
            var jmh = $('#jumlah'+id).val();
            var hasil = parseFloat(total) - parseFloat(jmh);
            $('#total').val(hasil);
            $(this).parent().remove();
        });

        // update jumlah
        $(document).on('change','.dana', function(){
            var id = $(this).attr('data-id');
            var dana = $('#dana'+id).val();
            var qty = $('#qty'+id).val();
            var jmh = qty * dana;
            $('#jumlah'+id).val(jmh).trigger('change');
        });
        $(document).on('change','.qty',function(){
            var id = $(this).attr('data-id');
            var dana = $('#dana'+id).val();
            var qty = $('#qty'+id).val();
            var jmh = qty * dana;
            $('#jumlah'+id).val(jmh).trigger('change');
        });
        // update total 
        $(document).on('change','.jumlah', function(){
            var totalSum = 0;
            $('.jumlah').each(function(){
                var thisVal = $(this).val();
                if ($.isNumeric(thisVal)) {
                    totalSum += parseFloat(thisVal);
                }
            });
            $('#total').val(totalSum).trigger('change');
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
        $('.buttondonasi').click(function(){
            swal({
                title:"Tunggu sebentar ya ^^",
                text: "Donasi sedang di proses",
                showConfirmButton: !1
            });
        });

        // jquery update catatan telpon 
        $('.updatecatatan').click(function(){
            var postdata = {
                'phone' : $('#mobilephone').val(),
                'note' : $('#note').val(),
                'status_call' : $('#status_call').val(),
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
            $('#status_call').show();
            $("#attention").hide();
            $('#showbutton').show();
            $('#showlabel').show();
        });



 
    });
</script>
@endpush