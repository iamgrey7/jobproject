
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
                        <img src="img/2.jpg">
                    </div>
                    <div class="col-md-10">
                        <h4>{{ $user->first_name}} {{$user->last_name}}</h4>
                        <h5>{{ $user->email }}</h5>
                        <h5>{{ $user->address }}</h5>
                    </div>

                </div>                
            </div>   

            <div class="panel-footer" >
                <div class="container">
                    <a href={{ route('download.cv', $user->cv_path) }} 
                        type="button" class="btn btn-warning">
                        <i class="fa fa-download"></i> Download CV</a>
                    <a href="" type="button" class="btn btn-success">
                        <i class="fa fa-check"></i> Acc Lamaran</a>
                    <a href="" type="button" class="btn btn-danger">
                        <i class="fa fa-times"></i> Reject Lamaran</a>

                    {{-- <a href={{ route('download.cv', substr($user->cv_path, 8)) }} 
                    type="button" class="btn btn-warning">
                    <i class="fa fa-download"></i> Download CV</a> --}}
                    {{-- <a href="{{ URL::to($user->cv_path) }}" 
                    target="_blank">{{ $user->cv_path }}</a> --}}
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
    
</script>

@endsection
