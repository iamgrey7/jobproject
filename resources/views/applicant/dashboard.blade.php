@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            {{-- tampilkan upload jika belum upload cv atau reject --}}
            @if($user->profile->cv_path == NULL || $user->profile->cv_status == "4")
            <div class="panel panel-default">
                <div class="panel-heading">Upload CV</div>

                <div class="panel-body">                
                   
                    <form class="form-inline" enctype='multipart/form-data'
                        action={{ route('cv.upload') }} method="POST" files='true'>
                        
                        Silakan upload CV anda 
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" value={{ $user->id }}>
                        <input type="file" class="form-control" id="upload_cv" name="upload_cv" 
                        accept="application/pdf">                        
                        <button id='upload'  type="submit" class="btn btn-primary">Upload</button>
                    </form> 
                </div>                    
            </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Status CV</div>

                <div class="panel-body"> 
                   Status CV Anda adalah : 
                   <span style="color:orange"><strong> {{ $user->profile->cvStatus->status_desc }} </strong></span>
                </div>                    
            </div>

        </div>
    </div>

</div>
@endsection


@section('script')
<script>

</script>
@endsection