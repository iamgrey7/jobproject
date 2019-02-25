
<div class="">
        @foreach($users as $user)
            <tr id="item{{$user->id}}" class="item{{$user->id}}" >                    
                <td>{{$user->id}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role_name}}</td>
                <td>{{$user->status}}</td>                

                {{-- <td class="text-center"><input type="checkbox" class="permanent" data-id="{{$employee->id}}" @if ($employee->is_permanent) checked @endif></td> --}}
                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', 
                $user->updated_at)->diffForHumans() }}</td>
                <td>
                <button class="show-modal btn btn-success"                                       
                        data-toggle="modal" data-target="#showModal"
                        data-id="{{$user->id}}" 
                        data-username="{{$user->username}}" 
                        data-email="{{$user->email}}">
                        <i class="fa fa-eye" aria-hidden="true"></i> Tampil
                    </button>
                    <button class="edit-modal btn btn-info"
                        data-toggle="modal" data-target="#editModal" 
                        data-id="{{$user->id}}" 
                        data-username="{{$user->username}}" 
                        data-email="{{$user->email}}">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                    </button>
                    <button class="delete-modal btn btn-danger" 
                        data-id="{{$user->id}}" 
                        data-username="{{$user->username}}" 
                        data-email="{{$user->email}}">
                        <i class="fa fa-trash" aria-hidden="true"></i></span> Hapus
                    </button>
                </td>
            </tr>
        @endforeach
        </div>
    </tbody>
</table> 
<div class="">
    {{ $users->render() }}
</div>
