@extends('template.header')

@section('konten')
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
            <form id="formdonasi" action="{{route('admin.formeditdonasi',$donasi->no_kwitansi)}}" method="post" enctype="multipart/form-data">
            @csrf
                <input type="hidden" value="{{$wakif->CustomerNo}}" name="kd_pelanggan">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                        <select name="pembayaran" id="pembayaran" class="custom-select js-example-basic-single">
                            <option value="">pilih pembayaran</option>
                            @foreach ($pembayaran as $pem)
                                <option value="{{$pem->kd_kas}}" 
                                {{$pem->kd_kas == $donasi->kd_kas ? 'selected' : ''}}
                                >{{$pem->nm_kas}}</option>
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
                                <input name="wakif" type="text" id="wakif" class="form-control"  value="{{$donasi->nm_wakif}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <div class="form-group">
                                <input name="tgltra" value="{{formattanggal($donasi->tgl_transaksi)}}" type="text" onfocus="(this.type='date')" class="form-control"  placeholder="tanggal komitmen">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input type="text" name="tglset" value="{{formattanggal($donasi->tgl)}}" onfocus="(this.type='date')" class="form-control"  placeholder="tanggal Setor">
                        </div>
                    </div> 
                </div>
                <div class="form-group">
                    <label for="">Lampirkan bukti transfer <span class="text-danger text-small">*(Optional) bukti setelah wakif transfer</span></label>
                    <input type="file" name="pict" class="form-control-file">
                    @if ($donasi->bukti == null)
                        <span id="store_image"><img src="{{url('public/assets/images/avatar/foto.png')}}" class="img-thumbnail" width="100"><input type="hidden" name="hidden_image" value="{{$donasi->bukti}}"></span>
                    @else
                      <span id="store_image"><img src="{{url('public/assets/images/bukti/'.$donasi->bukti)}}" class="img-thumbnail" width="100"><input type="hidden" name="hidden_image" value="{{$donasi->bukti}}"></span>
                    @endif
                    
                </div> 
                <a href="javascript:void(0)" class="addMore btn btn-sm gradient-2 mb-3">
                    <div class="input-group-addon "> 
                        <i class="fas fa-plus"> Tambah Project</i>
                    </div>
                </a>
                <div id="tambah">
                    @foreach ($donasi_dtl as $key => $don_dtl)
                    <div class="form-row">
                        <div class="col">
                            <select name="program[]" id="program{{$key}}" data-id="{{$key}}" class="custom-select program" required="">
                                @foreach ($program as $prog)
                                <option value="{{$prog->kd_program}}"
                                @if ($prog->kd_program == $don_dtl->kd_program)
                                    selected        
                                @endif  
                                    >{{$prog->nm_program}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select name="project[]" id="project{{$key}}" data-id="{{$key}}" class="custom-select project" required="" style="margin-left:0px !important">
                                <option value="">-Project-</option>
                                @foreach ($project as $proj)
                                    <option value="{{$proj->kd_project}}"
                                    {{ $don_dtl->kd_project == trim($proj->kd_project) ? 'selected':'' }}
                                        >{{$proj->nm_project}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" name="qty[]"  value="{{$don_dtl->qty}}" id="qty{{$key}}" data-id="{{$key}}" class="form-control qty" placeholder="Qty" required="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="col">
                            <input type="text" name="dana[]" value="{{$don_dtl->jmh/$don_dtl->qty}}" class="form-control dana" id="dana{{$key}}" data-id="{{$key}}" placeholder="Dana" required="">
                        </div>
                        <input type="text" name="jumlah[]" class="form-control jumlah" id="jumlah{{$key}}" data-id="{{$key}}" placeholder="jumlah" value="{{$don_dtl->jmh}}" required="" style="display:none">
                        <a href="javascript:void(0)" id="remove{{$key}}" data-id="{{$key}}" class="remove">
                            <div class="input-group-addon"> 
                                <i class="fas fa-trash"></i>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                    <div class="form-row mb-2">
                        <label for="">Total</label>
                        <input type="text" value="{{$donasi->total}}" name="total" id="total" class="form-control total" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary buttondonasi">perbaharui</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        //select2
        $('#pembayaran').select2({ width: '100%' }); 
        $('.program').select2({ width: '100%' }); 
        $('.project').select2({ width: '100%' }); 
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
                <input type="text" name="qty[]"  id="qty`+random+`" data-id="`+random+`" class="form-control qty" placeholder="Qty" required="">
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
            // format ngk boleh selain angka 
            Inputmask.extendAliases({
                'myQty' : {
                    alias : 'numeric',
                    digits: 0,
                    rightAlign: false,
                    autoUnmask: true,
                    removeMaskOnSubmit: true,
                    unmaskAsNumber: true,
                    allowPlus: false,
                    allowMinus: false,
                    autoGroup: true,
                }
            });
            $('.qty').inputmask('myQty');

            // select2 
            $('.program').select2({ width: '100%' }); 
            $('.project').select2({ width: '100%' }); 
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
        $('.buttondonasi').click(function(){
            swal({
                title:"Tunggu sebentar ya ^^",
                text: "Donasi lagi diperbaharui",
                showConfirmButton: !1
            });
        });
    });
</script>
@endpush