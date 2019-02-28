
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
                        {{-- <img src={{ asset($user->path_foto) }}
                        height="150px" width="auto"> --}}
                    </div>
                    <div class="col-md-10">
                        <h3>{{ $user->first_name}} {{$user->last_name}}</h3>
                        <h5><i class="fa fa-envelope"></i> {{ $user->user->email }}</h5>
                        <h5><i class="fa fa-map-marker"></i> {{ $user->address }}</h5>
                    </div>

                </div>                
            </div>   

            <div class="panel-footer" >
                <div class="container">
               
                        {{-- {{ csrf_field() }} --}}
                        <input type="hidden" id="user_id" value={{ $user->user_id }}>
                                
                        <a href={{ asset($user->cv_path) }} 
                            type="button" class="btn btn-warning">
                            <i class="fa fa-download"></i> Download CV</a>
                        
                        @if ($user->cv_status == "1" || $user->cv_status == "4"  )
                        <a href="" id="btnAccept" type="button" class="btnAccept btn btn-success">
                            <i class="fa fa-check"></i> Acc Lamaran</a>

                        <a href="" id="btnReject" type="button" class="btnReject btn btn-danger">
                            <i class="fa fa-times"></i> Reject Lamaran</a>
                        @endif
                   
                        <a href="" id="btnKembali" type="button" class="btnKembali btn btn-info"
                        >
                            <i class="fa fa-refresh"></i> Kembali</a>

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
                   
                        <div class="col-md-6">
                            Perguruan Tinggi
                        </div>
                         <div class="col-md-6">
                                Universitas ABC
                        </div>
   
                            
                                  
                </div>                    
            </div>
        </div> 
        <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Pengalaman Kerja</div>
    
                    <div class="panel-body">    
                        <div class="col-md-4">
                            PT. XYZ
                        </div>
                            <div class="col-md-8">
                            Lorem Ipsum is simply dummy text of
                                the printing and typesetting industry. 
                                Lorem Ipsum has been the industry's 
                                standard dummy text ever since the 1500s, 
                                when an unknown printer took a galley of 
                                type and scrambled it to make a type 
                                specimen book.
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
                    <ul>
                        <li>Laravel : Medium</li>
                        <li>CodeIgniter : Medium</li>
                        <li>Bootstrap : Medium</li>
                        <li>AngularJS: Medium</li>
                    </ul>            
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

    




id = $('#user_id').val() ; 

$('.btnAccept').on('click', function(e){ 
    e.preventDefault();     
           
    $.ajax({
        type: 'POST',
        url: "{{ URL::route('changeStatusCV') }}",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id, 
            'status' : 3,               
        },
        success: function(data) {
            toastr.success('Lamaran telah di Diterima', 'Accepted', {timeOut: 5000});           
            // $("#btnKembali").css("display", "");
            $("#btnAccept").css("display", "none");
            $("#btnReject").css("display", "none");
        },  
    });
});  

$('.btnReject').on('click', function(e){  
    e.preventDefault();              
    $.ajax({
        type: 'POST',
        url: "{{ URL::route('changeStatusCV') }}",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id, 
            'status' : 4,               
        },
        success: function(data) {
            toastr.error('Lamaran telah di Reject !', 'Rejected', {timeOut: 5000});           
            // $("#btnKembali").css("display", "");
            $("#btnAccept").css("display", "none");
            $("#btnReject").css("display", "none");
        },
    });
}); 

$('.btnKembali').on('click', function(e){ 
    e.preventDefault(); 
        window.location.href = '{{route("admin.index")}}';
});





});
</script>

@endsection
