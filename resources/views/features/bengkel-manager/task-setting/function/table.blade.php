@if(!isset($listdata) || empty($listdata))
    <script type="text/javascript">
        endOfRequest = true;

        if(!$('#end-of-content').length){
            $('#content').append('<tr id="end-of-content"><td colspan="6"><div class="row"><div class="col-12 d-flex justify-content-center"><h4>This is the end of the content.</h4></div></div></td></tr>');
        }
    </script>
@else
    
    @foreach($listdata->data as $user)
     
        <tr>

            @isset($user->username)
                <td>
                    {{ $user->username }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

           @isset($user->email)
                <td>
                    {{ $user->email }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($user->phone)
                 <td>
                     {{ $user->phone }}
                 </td>
             @else   
                 <td class="bg-danger-light">
                     <i class="fa fa-exclamation-circle"></i> Data not available
                 </td>
             @endisset

            @isset($user->role->role_name)
                <td>
                    {{ $user->role->role_name }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($user->status)
                <td>
                    @if ($user->status)
                        <span class="badge badge-pill badge-success">active</span>
                    @else
                        <span class="badge badge-pill badge-danger">suspend</span>
                    @endif
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($user->id)
                <td class="text-center">
                    <div class="btn-group mr-2 mb-2" data-toggle="buttons" role="group" aria-label="Icons Action group">
                        <button type="button" 
                            class="btn btn-sm btn-primary"
                            onclick="detailView({{ $user->id }})">
                            <i class="far fa-fw fa-eye"></i>
                        </button>
                        <button type="button" 
                            class="btn btn-sm btn-primary"
                            onclick="updateView({{ $user->id }})">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <button type="button" 
                            class="btn btn-sm btn-primary"
                            onclick="deleteView({{ $user->id }}, '{{ $user->username }}')">
                                <i class="fa fa-fw fa-trash"></i>
                        </button>
                    </div>
                </td>
            @else
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

        </tr> 
        
    @endforeach
@endif
