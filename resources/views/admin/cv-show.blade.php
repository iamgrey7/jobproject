
@extends('layouts.app')

@section('title')
    <title>Profil</title>
@endsection


@section('content')

<div class="container">

    {{-- row 1 --}}
    <div class="row">        
        <div class="panel panel-default">
            <div class="panel-heading">Biodata Pelamar</div>

            <div class="panel-body">                
                <div class="container">

                    <div class="col-md-2">
                        <img src={{ asset($user->path_foto) }}
                        height="150px" width="auto">
                    </div>
                    <div class="col-md-10">
                        <h3>{{ $user->first_name}} {{$user->last_name}}</h3>
                        <h5><i class="fa fa-envelope"></i> {{ $user->email }}</h5>
                        <h5><i class="fa fa-map-marker"></i> {{ $user->address }}</h5>
                    </div>

                </div>                
            </div>   

            <div class="panel-footer" >
                <div class="container">
                    {{ csrf_field() }}
                    <input type="hidden" id="user_id" value={{ $user->user_id }}>
                    {{-- <a href={{ route('download.cv', $user->cv_path) }} 
                        type="button" class="btn btn-warning">
                        <i class="fa fa-download"></i> Download CV</a> --}}                    
                                       
                    <a href={{ asset($user->cv_path) }} 
                        type="button" class="btn btn-warning" download>
                        <i class="fa fa-download"></i> Download CV</a>

                    <a href="" id="btnAccept" type="button" class="btnAccept btn btn-success">
                    <i class="fa fa-check"></i> Acc Lamaran</a>

                    <a href="" id="btnReject" type="button" class="btnReject btn btn-danger">
                    <i class="fa fa-times"></i> Reject Lamaran</a>

                    <button id="btnAccept2" class="btn btn-success">ACC2</button>
                 
                </div>                
            </div>                 
        </div>
    </div>    
    {{-- end row 1 --}}

    {{-- row 2 --}}
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Pendidikan</div>

                <div class="panel-body">                
                    <div class="container">
                        
                        {{ asset($user->path_foto) }}
                            
                    </div>                
                </div>                    
            </div>
        </div> 
        <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Pengalaman Kerja</div>
    
                    <div class="panel-body">                
                        <div class="container">
                            
                                
                                
                        </div>                
                    </div>                    
                </div>
            </div> 
    </div>
    {{-- end row 2 --}}    

    {{-- row 3  --}}
    <div class='row'>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Keahlian</div>

                <div class="panel-body">                
                    <div class="container">
                        
                            
                            
                    </div>                
                </div>                    
            </div>
        </div> 
    </div>


{{-- end container     --}}
</div>



@endsection


@section('script')
<script>
$(document).ready(function(){

    $('.btnAccept').on('click', function(){
        id = $('#user_id').val() ;        
        $.ajax({
            type: 'POST',
            url: "{{ URL::route('changeStatusCV') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id, 
                'status' : 3,               
            },
            success: function(data) {
                //
            },
        });
    });  

    $('.btnReject').on('click', function(){
        id = $('#user_id').val() ;        
        $.ajax({
            type: 'POST',
            url: "{{ URL::route('changeStatusCV') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id, 
                'status' : 4,               
            },
            success: function(data) {
                //
            },
        });
    });    




});
</script>

@endsection
