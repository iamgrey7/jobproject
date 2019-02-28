@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="alert alert-info" role="alert">
                <strong>
                    Sebelum melanjutkan, silakan Isi Informasi Akun Anda terlebih dahulu..
                </strong>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                   Informasi user
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action={{ route('profile.store') }}>
                        {{ csrf_field() }}

                        <input class="form-control" type="hidden" id="user_id" name="user_id" value={{ $id }}>
                        
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">Nama Depan</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" 
                                name="first_name" value="{{ old('first_name') }}" required>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Nama Belakang</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" 
                                name="last_name" value="{{ old('last_name') }}">

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">JK</label>

                            <div class="col-md-6">
                                <select id="gender" class="form-control" name="gender">                                
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>                                    
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

   
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">No Telp</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" 
                                name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" 
                                name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>      

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section("script")
<script type="text/javascript">

</script>
@endsection