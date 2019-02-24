
    <div class="">
        @foreach($users as $user)
            <tr id="item{{$user->user_id}}" class="item{{$user->user_id}}">
                <td>{{$user->user_id}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->cv_status}}</td>
         
                {{-- <td class='text-center'><input type="checkbox" class="permanent" 
                    data-id="{{$user->user_id}}" 
                     @if ($user->has_filled_profile) checked @endif                    
                ></td> --}}

                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', 
                    $user->updated_at)->diffForHumans() }}
                </td>
                <td>
                    <button id="btn-proses" class="show-modal btn btn-success" 
                        data-id="{{$user->user_id}}" 
                        data-first_name="{{$user->first_name}}" 
                        data-address="{{$user->address}}">
                        <i class="fa fa-eye" aria-hidden="true"></i> Proses
                    </button>
                    {{-- <button class="edit-modal btn btn-info" 
                        data-id="{{$user->user_id}}" 
                        data-first_name="{{$user->first_name}}" 
                        data-address="{{$user->address}}">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                    </button>
                    <button class="delete-modal btn btn-danger" 
                        data-id="{{$user->user_id}}" 
                        data-first_name="{{$user->first_name}}" 
                        data-address="{{$user->address}}">
                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                    </button> --}}
                </td>
            </tr>
        @endforeach
        </div>
    </tbody>
</table> 
<div class="">
    {{-- {{ $users->render() }} --}}
</div>
