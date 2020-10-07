@extends('template.header')

@section('konten')
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Table Campaign</h4>
            <button type="button" class="btn mb-1 btn-rounded btn-success upload"><span class="btn-icon-left"><i class="fas fa-angle-double-up"></i> </span>Upload</button>
            <a href="{{url('public\assets\uploadcampaign.xlsx')}}" class="btn mb-1 btn-rounded btn-primary" download><span class="btn-icon-left"><i class="fas fa-download"></i> </span>Download format</a>
            <div class="table-responsive"> 
                <table class="table table-bordered table-striped verticle-middle">
                    <thead>
                        <tr>
                            <th scope="col">CustomerNo</th>
                            <th scope="col">Nama Wakif</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Campaign</th>
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- looping  --}}
                        @foreach ($campaign as $camp)
                            <tr>
                                <td>{{$camp->CustomerNo}}</td>
                                <td>{{$camp->CustomerName}}</td>
                                <td>{{$camp->MobilePhone}}</td>
                                <td>{{$camp->campaignId_3cx}}
                                {{-- </td>
                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                </td> --}}
                            </tr>
                        @endforeach
                        {{-- end looping  --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

  <!-- modal upload Campaign -->
  <div class="modal fade" id="modal_upload" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload File Excel Campaign</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="result_upload"></span>
                <form action="" id="form_upload" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="upload" class="bmd-label-static">Upload Excel Campaign</label>
                        <input type="file"  class="form-control @error('upload') is-invalid @enderror" name="upload" id="upload" value="">
                    </div>
                    </div>
                </div>
                <div id="loadingfira"></div>
                <input type="submit" name="upload_excel" id="upload_excel" class="upload_excel btn btn-primary pull-right mt-3" value="Upload Data Campaign">
                <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection

@push('script')
    <script>
         // show modal uplad file excel dari finnet
        $(document).on('click','.upload', function(){
            $("#modal_upload").modal('show');
        });
        // upload excel
        $('#form_upload').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: "{{route('admin.upload')}}",
                method:"POST",
                data: new FormData(this),
                cache: false,
                processData:false,
                contentType:false,
                dataType: 'JSON',
                beforeSend:function(){
                  $('#result_upload').html(" ");
                  $('#upload_excel').attr('disabled','true');
                  $('#loadingfira').append(
                  `
                  <div class='spinner-border' role='status'>
                  </div>
                  `)
                },
                success:function(data)
                {
                  $('#loadingfira').html(' ');
                  $('#upload_excel').removeAttr('disabled');
                  var html = '';
                    if (data.erorrs) {
                      html = '<div class="alert alert-danger">';
                      for (var count = 0; count < data.erorrs.length; count++) {
                        html += '<p>'+data.erorrs[count]+'</p>';
                      }
                      html += '</div>';
                    }
                    console.log(data);
                    if(data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                      }
                    if(data.failed) {
                        html = '<div class="alert alert-danger">' + data.failed + '</div>';
                      }
                    $('#result_upload').html(html);
                }
            });
        });
    </script>
@endpush