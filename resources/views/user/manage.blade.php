@extends('layouts.app')

@section('title')
    <title>Manajemen User</title>
@endsection

@section('content')
<div class="container">
    <div class="col-md-12">
        <h2 class="text-center">Manajemen Akun User</h2>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">                
                <div class='row'>
                    <div class='col-md-8'>
                        <h5>Daftar User :</h5> 
                    </div>                   
                    <div class='col-md-4'>                        
                        <input class='form-control' type="text" id="keywords" autocomplete="off">  
                    </div>
                     
                </div>      
               
            </div>

            <div class="panel-body">                
                <table class="table table-striped table-bordered table-hover" 
                id="userTable">
                    <thead>
                        <tr>
                            <th valign="middle">ID</th>
                            <th>Username</th>
                            <th>E-Mail</th>
                            <th>Hak Akses</th>
                            <th>Status</th>
                            <th>Upload CV</th>
                            <th>Waktu Upload</th>
                            <th>Operasi</th>
                        </tr>
                        {{ csrf_field() }}
                    </thead>
                    <tbody id="table-content">
                       
                    @include("user.list") 

                
            </div><!-- /.panel-body -->
        </div><!-- /.panel panel-default -->
    </div><!-- /.col-md-8 -->

</div>

{{-- test modal --}}
<div id="testModal" class="modal fade" tabindex="-1" role="dialog">
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


<!--Modal untuk menampilkan data User -->
<div id="showModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_show" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="username">Nama:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username_show" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Alamat:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="email_show" 
                            cols="40" rows="5" disabled></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='fa fa-delete'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk edit data User -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_edit" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="username">Username:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username_edit" autofocus>
                            <p class="errorUsername text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="email_edit" cols="40" rows="5"></textarea>
                            <p class="errorEmail text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                        <span class='fa fa-check'></span> Edit
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='fa fa-delete'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection



@section('script')
<script>

//function Pencarian dengan keyup delay
function debounce(fn, duration) {
    var timer;
    return function(){
        clearTimeout(timer);
        timer = setTimeout(fn, duration);
    }
}

$('#keywords').on('keyup', debounce(function(){ 
    $.ajax({ 
        route : 'user.management.manage', 
        type : 'GET', 
        dataType : 'json', 
        data : { 
            'keywords' : $('#keywords').val()                 
        }, success : function(data) { 
            $('#table-content').html(data['view']); 
            $('#keywords').val(data['keywords']);                 
        }, error : function(xhr, status) { 
            console.log(xhr.error + " ERROR STATUS : " + status); 
        }, complete : function() { 
            alreadyloading = false; 
        } 
    }); 
}, 500)); 



//tampilkan data User
$(document).on('click', '.show-modal', function() {
    $('.modal-title').text('Data Akun User');
    $('#id_show').val($(this).data('id'));
    $('#username_show').val($(this).data('username'));
    $('#email_show').val($(this).data('email'));
    $('#showModal').modal('show');
});

// Edit data User
$(document).on('click', '.edit-modal', function() {
    $('.modal-title').text('Edit Data User');
    $('#id_edit').val($(this).data('id'));
    $('#username_edit').val($(this).data('username'));
    $('#email_edit').val($(this).data('email'));
    id = $('#id_edit').val();
    $('#editModal').modal('show');
});

</script>

@endsection