@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if ($user->profile->cv_status == "1") 
            <div class="alert alert-success" role="alert">
                Anda dapat mengupload CV anda sebanyak satu kali, dan 
                mengupload kembali apabila status CV anda <b>Ditolak</b>
            </div>
            @endif

            @if ($user->profile->cv_status == "3") 
            <div class="alert alert-success" role="alert">
                Selamat CV anda telah kami periksa dan Anda telah <b>Diterima</b>
            </div>
            @endif

            @if ($user->profile->cv_status == "4") 
            <div class="alert alert-danger" role="alert">
                Mohon maaf, Lamaran anda <b>Ditolak</b> silakan 
                mengupload kembali CV anda ..
            </div>
            @endif

            {{-- tampilkan upload jika belum upload cv atau reject --}}
            @if($user->profile->cv_path == NULL || $user->profile->cv_status == "4")
            <div class="panel panel-default">
                <div class="panel-heading">Upload CV</div>

                <div class="panel-body">                
                   
                    <form class="form-inline" enctype='multipart/form-data'
                        method="POST" files='true'
                        action={{ route('cv.upload') }}>                            
                        
                            <div class="container">
                            Silakan upload CV anda 
                            {{ csrf_field() }}
                            
                            <input name="_method" type="hidden" value="PUT">
                            <input id="input_id" type="hidden" value={{ $user->id }}> 

                            <input type="file" class="form-control" id="upload_cv" name="upload_cv" 
                            accept="application/pdf" required>  
                           

                            <button id='upload'  type="submit" class="upload btn btn-primary">Upload</button>
                        </div>
                        @if ($errors->has('upload_cv'))
                        <div class='col-md-offset-4'>
                            <span class="help-block">
                                <strong>{{ $errors->first('upload_cv') }}</strong>
                            </span>
                        </div>
                        @endif                  
                    
                    </form> 
                </div>                    
            </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Status CV</div>

                <div class="panel-body"> 
                    Status CV Anda adalah :
                    @if ($user->profile->cv_status == "1")  
                    <span style="color:orange"><strong> 
                    @endif    
                    @if ($user->profile->cv_status == "3")  
                    <span style="color:green"><strong> 
                    @endif   
                    @if ($user->profile->cv_status == "4")  
                    <span style="color:red"><strong> 
                    @endif   
                    

                       {{ $user->profile->cvStatus->status_desc }} 
                   
                    </strong></span>
                </div>                    
            </div>

        </div>
    </div>

</div>
@endsection


@section('script')
<script>
// $(document).on('click', '#upload', function() { 
//     id = $('#input_id').val(),  
//     type: 'PUT',
//     url: 'users/upload/'+id,
//     data: {
//         '_token': $('input[name=_token]').val(),                     
//         'id': id,
//         'file': $('#upload_cv').val(),            
//     },
//     success: function(data) {
//         // toastr.success('Berhasil update artikel ..', 'Success Alert', {timeOut: 5000});
//     }
//     });
// });
</script>
@endsection