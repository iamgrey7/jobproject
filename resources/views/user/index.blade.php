@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                      
                    {{-- {!! Form::model($id,[
                        'route' => 'users.upload', 
                        'method' => 'PUT', 
                        'files' => 'true',
                        'class' => 'form-inline',   
                        'enctype' => 'multipart/form-data'
                        ]) 
                    !!}  --}}
                    <form class="form-inline" enctype='multipart/form-data'
                    action={{ route('users.upload', $id) }} method="POST" files='true'>
                        
                        Silakan upload CV anda 
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" value={{ $id }}>
                        <input type="file" class="form-control" id="upload_cv" name="upload_cv" 
                        accept="application/pdf">                        
                        <button id='upload'  type="submit" class="btn btn-primary">Upload</button>
                   </form>
                   {{-- {!! Form::close() !!} --}}

                </div>                    
            </div>
        </div>
    </div>


    {{-- modal percobaan --}}
    <div id="testModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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