@extends('template.header')

@section('konten')
<div class="row">
    <a href={{url('form_customer/form_customer.php?v_phone='.$phone.'')}} class="btn btn-sm gradient-1 text-center mx-auto"><i class="fas fa-plus"></i> Tambah Donasi</a>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="active-member">
                    <div class="table-responsive">
                        <table class="table table-xs mb-0">
                            <thead>
                                <tr>
                                    <th>Wakif</th>
                                    <th>Tanggal</th>
                                    <th>Sumber</th>
                                    <th>Total</th>
                                    <th>Bukti Transfer</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donasi as $don)
                                    <tr>
                                        <td><img src={{url('public/assets/images/avatar/foto.png')}} class="bg-primary rounded-circle mr-3" alt="">{{$nama}}</td>
                                        <td>{{date('d M Y',strtotime($don->tgl_tambah))}}</td>
                                        <td>{{$don->sumber}}</td>
                                        <td>Rp.{{number_format($don->total)}}</td>
                                        @if ($don->bukti == null)
                                          <td><i class="fa fa-circle-o text-danger  mr-2"></i> Belum ada bukti transfer</td>  
                                          @else
                                          <td><i class="fa fa-circle-o text-success  mr-2"></i> Terdapat bukti transfer</td>  
                                        @endif
                                        <td>
                                            <a href="" class="btn btn-sm gradient-4"><i class="fas fa-edit"> Edit</i></a>
                                        </td>
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
@endsection

@push('script')
    <script>
        
    </script>
@endpush