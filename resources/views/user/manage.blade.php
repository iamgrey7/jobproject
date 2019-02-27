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
                    <div class='col-md-2'>
                        <h5>Daftar User :</h5> 
                    </div>  
                    <div class='col-md-6'>
                        <button type='button' class='btnAdd btn btn-success' 
                        id='btnAdd' data-toggle="modal" data-target="#addModal">
                        <i class="fa fa-plus"></i>
                        Tambah Baru</button>
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

<!-- Modal form untuk menambah data user -->
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">                
                <form class="form-horizontal" role="form" method="POST">
                   {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="username_add">Username:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username_add" autofocus>                                
                            <p class="errorUserName text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email_add">Email:</label>
                        <div class="col-sm-9">
                            <input class="form-control" id="email_add">                                
                            <p class="errorEmail text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="password_add">Password:</label>
                        <div class="col-sm-9">
                            <input class="form-control" id="password_add" type="password">                                
                            <p class="errorPassword text-center alert alert-danger hidden"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dob_add" class="col-sm-3 control-label">Tgl Lahir</label>
                        <div class="col-sm-9">
                            <input id="dob_add" type="date" class="form-control" name="dob_add" required
                            min="1950-01-01">                            
                            <p class="errorDob text-center alert alert-danger hidden"></p>                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="role_add">Hak Akses:</label>
                        <div class="col-sm-9">                            
                            <select class="form-control" id="role_add" name="role_add">
                                <option value="1">Admin</option> 
                                <option value="2">User</option> 
                            </select>
                            <p class="errorRole text-center alert alert-danger hidden"></p>
                        </div>
                    </div>         
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success add" data-dismiss="modal">
                        <span id="" class='fa fa-check'></span> Tambah
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='fa fa-times'></span> Batal
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
                 
                    <input type="hidden" class="form-control" id="id_edit">
                 
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="username_edit">Username:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username_edit">
                            <p class="errorUsername text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email_edit">Email:</label>
                        <div class="col-sm-9">
                            <input class="form-control" id="email_edit" >
                            <p class="errorEmail text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="role_edit">Hak Akses:</label>
                        <div class="col-sm-9">
                            {{-- <input class="form-control" id="role_edit" > --}}
                            <select class="form-control" id="role_edit" name="role_edit">
                                <option value="1">Admin</option> 
                                <option value="2">User</option> 
                            </select>
                            <p class="errorRole text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="status_edit">Status</label>
                        <div class="col-sm-9">
                            {{-- <input class="form-control" id="status_edit" > --}}
                            <select class="form-control" id="status_edit">
                                <option value="1">Aktif</option> 
                                <option value="2">Suspend</option>
                                <option value="3">Tidak Aktif</option>
                            </select>
                            <p class="errorStatus text-center alert alert-danger hidden"></p>
                        </div>
                    </div>

                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                        <span class='fa fa-check'></span> Simpan
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='fa fa-delete'></span> Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete modal -->
<div id="deleteModal" class="modal fade" role="dialog">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">                
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="hidden" class="form-control" id="id_delete">
                        <h5>Anda yakin akan menghapus data User :
                        <strong><span id="nama_user"></span></strong> 
                        ini ?</h5>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                            <span class='fa fa-check'></span> Konfirmasi
                        </button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">
                            <span class='fa fa-delete'></span> Batal
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

//tambah data User
$(document).on('click', '.btnAdd', function() {
    $('.modal-title').text('Tambah Akun User');       
});
$('.modal-footer').on('click', '.add', function() {     
    $.ajax({
        type: 'POST',
        url : 'users/create',        
        data: {
            '_token': $('input[name=_token]').val(),
            'username': $('#username_add').val(),
            'email': $('#email_add').val(),
            'password': $('#password_add').val(),
            'dob' : $('#dob_add').val(),
            'role_id': $('#role_add option:selected').val(),
        },
        success: function(data) { 
            $('#table-content').html(data['view']);
        },
    });
});


// Edit data User
$(document).on('click', '.edit-modal', function() {
    role = $(this).data('role');
    status = $(this).data('status');

    $('.modal-title').text('Edit Data User');
    $('#id_edit').val($(this).data('id'));
    $('#username_edit').val($(this).data('username'));
    $('#email_edit').val($(this).data('email'));
    $("#role_edit").val(role);
    $("#status_edit").val(status);
  
    id = $('#id_edit').val();    
});
$('.modal-footer').on('click', '.edit', function() {
    $.ajax({
        type: 'PUT',
        url: 'users/edit/'+id,
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id,
            'username': $('#username_edit').val(),
            'email': $('#email_edit').val(),
            'role_id': $('#role_edit option:selected').val(),
            'status_id': $('#status_edit option:selected').val(),
        },
        success: function(data) {
            // toastr.success('Berhasil update artikel ..', 'Success Alert', {timeOut: 5000});
            // $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td>" + data.address + "</td><td class='text-center'><input type='checkbox' class='edit_permanent' data-id='" + data.id + "'></td><td>Right now</td><td><button id='btnShow' class='show-modal btn btn-success' data-id='" + data.id + "' data-name='" + data.name + "' data-address='" + data.address + "'><span class='fa fa-eye'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "' data-address='" + data.address + "'><span class='fa fa-pencil'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "' data-address='" + data.address + "'><span class='fa fa-trash'></span> Delete</button></td></tr>");
            $('#table-content').html(data['view']);
        }
    });
});
// 

// Delete data user
$(document).on('click', '.delete-modal', function() {    
    $('.modal-title').text('Hapus Data');
    $('#id_delete').val($(this).data('id'));    
    $('#nama_user').text($(this).data('username')); //ganti nama di span    
    id = $('#id_delete').val();    
});
$('.modal-footer').on('click', '.delete', function() {            
    $.ajax({
        type: "DELETE",                
        url: "users/delete/" + id, 
        data: {
            '_method' : 'delete',
            '_token': $('input[name=_token]').val(),
            'id': id,                                                                                                    
        },
        success: function() {
            $('#table-content').html(data['view']);
        }
    });
});






</script>

@endsection