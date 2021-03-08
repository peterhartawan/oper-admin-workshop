@if(isset($listdata))

    @php
        $flag_button = true;
    @endphp
    
    @foreach($listdata as $list)
     
        <tr>

            @isset($list->list_sequence)
                <td>
                    {{ $list->list_sequence }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($list->master_task->task_name)
                <td>
                    {{ $list->master_task->task_name }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($list->list_name)
                <td>
                    {{ $list->list_name }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($list->task_progress->list_done)
                <td>
                    {{ $list->task_progress->list_done }}
                </td>
            @else   
                <td>
                    <span class="badge badge-pill badge-secondary">not finished</span>
                </td>
            @endisset

            @isset($list->id)
                <td class="text-center">
                    <div class="btn-group mr-2 mb-2" data-toggle="buttons" role="group" aria-label="Icons Action group">
                        @isset($list->task_progress->list_done)
                            <span class="badge badge-pill badge-success">finished</span>
                        @else
                            @if ($flag_button)
                                <input type="hidden" name="progressID" value="{{ $list->task_progress->id }}">
                                <button type="submit" 
                                    class="btn btn-sm btn-primary"
                                    onclick="$('#update-status-4-form').submit()">
                                        <i class="fa fa-fw fa-check"></i> Done
                                </button>
                                @php
                                    $flag_button = false;
                                @endphp
                            @else
                                <button type="button" 
                                    class="btn btn-sm btn-secondary"
                                    disabled>
                                        <i class="fa fa-fw fa-check"></i> Done
                                </button>
                            @endif
                        @endisset
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
