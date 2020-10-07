@extends('template.header')

@push('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('konten')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Wakif</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration" id="datawakif">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>No Hp</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript"> 
    $(document).ready(function(){
        $(function() {
            var table = $('#datawakif').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('admin.datawakif')}}",
                columns: [
                    {data: 'CustomerName', name: 'CustomerName'},
                    {data: 'MobilePhone', name:'MobilePhone'},
                    {data: 'customeremail', name:'customeremail'},
                    {data: 'address', name:'address'},
                    {data: 'action', name:'action', orderable:false, searchable:false},
                ]
            });
        });
    });
</script>
@endpush