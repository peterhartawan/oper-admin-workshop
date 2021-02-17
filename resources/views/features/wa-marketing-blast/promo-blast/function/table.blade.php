@if(!isset($listdata) || empty($listdata))
    <script type="text/javascript">
        endOfRequest = true;

        if(!$('#end-of-content').length){
            $('#content').append('<tr id="end-of-content"><td colspan="4"><div class="row"><div class="col-12 d-flex justify-content-center"><h4>This is the end of the content.</h4></div></div></td></tr>');
        }
    </script>
@else
    
    @foreach($listdata->data as $promo)
     
        <tr>

            @isset($promo->id)
                <td>
                    {{ $promo->id }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

           @isset($promo->promo_title)
                <td>
                    {{ $promo->promo_title }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($promo->logs)
                <td>
                    {{ $promo->logs }}
                </td>
            @else   
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($promo->id)
                <td class="text-center">
                    <div class="btn-group mr-2 mb-2" data-toggle="buttons" role="group" aria-label="Icons Action group">
                        <button type="button" 
                            class="btn btn-sm btn-primary"
                            onclick="detailView({{ $promo->id }})">
                            <i class="far fa-fw fa-eye"></i>
                        </button>
                        <button type="button" 
                            class="btn btn-sm btn-primary"
                            onclick="updateView({{ $promo->id }})">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <button type="button" 
                            class="btn btn-sm btn-primary"
                            onclick="deleteView({{ $promo->id }}, '{{ $promo->promo_title }}')">
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
