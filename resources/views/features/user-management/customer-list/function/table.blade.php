@if(!isset($listdata) || empty($listdata))
    <script type="text/javascript">
        endOfRequest = true;

        if(!$('#end-of-content').length){
            $('#content').append('<tr id="end-of-content"><td colspan="4"><div class="row"><div class="col-12 d-flex justify-content-center"><h4>This is the end of the content.</h4></div></div></td></tr>');
        }
    </script>
@else
    
    @foreach($listdata->data as $customer)
     
        <tr>

            @isset($customer->customer_name)
                <td>
                    {{ $customer->customer_name }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($customer->customer_email)
                <td>
                    {{ $customer->customer_email }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($customer->customer_hp)
                <td>
                    {{ $customer->customer_hp }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($customer->id)
                <td class="text-center">
                    <div class="btn-group mr-2 mb-2" data-toggle="buttons" role="group" aria-label="Icons Action group">
                        <button type="button" 
                            class="btn btn-sm btn-primary"
                            onclick="detailView({{ $customer->id }})">
                            <i class="far fa-fw fa-eye"></i>
                        </button>
                        <button type="button" 
                            class="btn btn-sm btn-primary"
                            onclick="updateView({{ $customer->id }})">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <button type="button" 
                            class="btn btn-sm btn-primary"
                            onclick="deleteView({{ $customer->id }}, '{{ $customer->customer_name }}')">
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
