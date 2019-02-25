
    <div class="">
        @foreach($users as $user)
            <tr id="item{{$user->user_id}}" class="item{{$user->user_id}}">
                <td>{{$user->user_id}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->status_desc}}</td>
         
                {{-- <td class='text-center'><input type="checkbox" class="permanent" 
                    data-id="{{$user->user_id}}" 
                     @if ($user->has_filled_profile) checked @endif                    
                ></td> --}}

                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', 
                    $user->updated_at)->diffForHumans() }}
                </td>
                <td>                    
                    {{-- <button id="btn-proses" class="btn btn-primary" 
                       href={{ route('applicant.profile', $user->id) }}>
                        <i class="fa fa-file-text" aria-hidden="true"></i> Proses
                    </button>     
                                   --}}
                <a class="btn btn-primary" type="button" href={{ route('applicant.profile', $user->user_id) }}>
                    <i class="fa fa-file-text"></i> Proses</a>
            </td>
            </tr>
        @endforeach
        </div>
    </tbody>
</table> 
<div class="">
    {{-- {{ $users->render() }} --}}
</div>
