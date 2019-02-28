@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-lg-12">
        <h2 class="text-center">Kelola Resume</h2>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Daftar Resume yang sudah diupload user :</h5>
                {{-- <button class="btn btn-primary">Diterima</button>
                <button class="btn btn-danger">Reject</button> --}}
                
                {{-- <ul>                    
                    <li>
                        <button type='button' class='btn btn-primary' 
                        id='btnAdd' data-toggle="modal" data-target="#addModal">
                        Tambah Baru</button>
                    </li>
                    <li>
                        <button type='button' class='btn btn-danger' 
                        id='btnTest' data-toggle="modal" data-target="#testModal">
                        Test</button>
                    </li>
                    <li>
                        <div class='col-md-4' style="padding-top:15px">
                            Pencarian
                        </div>  
                        <div class='col-md-8'>
                            <input type="text" id="keywords" autocomplete="off" width=500px>
                        </div>                    
                    </li>
                </ul> --}}
            </div>

            <div class="panel-body">                
                <table class="table table-striped table-bordered table-hover" 
                id="userTable">
                    <thead>
                        <tr>
                            <th valign="middle">ID</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Upload CV</th>
                            <th>Operasi</th>
                        </tr>
                        {{-- {{ csrf_field() }} --}}
                    </thead>
                    <tbody id="table-content">
                       
                    @include("admin.cv-list") 

                
            </div><!-- /.panel-body -->
        </div><!-- /.panel panel-default -->
    </div><!-- /.col-md-8 -->

</div>



@endsection
