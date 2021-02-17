@if(!isset($listdata) || empty($listdata))
    <script type="text/javascript">
        endOfRequest = true;

        if(!$('#log_eor').length){
            $('#content').append('<tr id="log_eor"><td colspan="2"><div class="row"><div class="col-12 d-flex justify-content-center"><h4>This is the end of the content.</h4></div></div></td></tr>');
        }
    </script>
@else
    
    @foreach($listdata->data as $log)
     
        <tr>

            @isset($log->sent_to)
                <td>
                    {{ $log->sent_to }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($log->sent_time)
                <td>
                    {{ $log->sent_time }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

        </tr> 
        
    @endforeach
@endif
