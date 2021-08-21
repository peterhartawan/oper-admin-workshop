@if(!isset($listdata) || empty($listdata))
    <script type="text/javascript">
        endOfRequest = true;

        if(!$('#end-of-content').length){
            $('#content').append('<tr id="end-of-content"><td colspan="4"><div class="row"><div class="col-12 d-flex justify-content-center"><h4>This is the end of the content.</h4></div></div></td></tr>');
        }
    </script>
@else

    @foreach($listdata->data as $setting)

        <tr>

            @isset($setting->bengkel_name)
                <td>
                    {{ $setting->bengkel_name }}
                </td>
            @else
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

           @isset($setting->bengkel_open)
                <td>
                    {{ $setting->bengkel_open }}
                </td>
            @else
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($setting->bengkel_close)
                 <td>
                     {{ $setting->bengkel_close }}
                 </td>
             @else
                 <td class="bg-danger-light">
                     <i class="fa fa-exclamation-circle"></i> Data not available
                 </td>
             @endisset

            @isset($setting->min_daily)
                <td>
                    {{ $setting->min_daily }}
                </td>
            @else
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($setting->id)
                <td class="text-center">
                    <div class="btn-group mr-2 mb-2" data-toggle="buttons" role="group" aria-label="Icons Action group">
                        <button type="button"
                            class="btn btn-sm btn-primary"
                            onclick="detailView({{ $setting->id }})">
                            <i class="far fa-fw fa-eye"></i>
                        </button>
                        <button type="button"
                            class="btn btn-sm btn-primary"
                            onclick="updateView({{ $setting->id }})">
                                <i class="fa fa-fw fa-pencil-alt"></i>
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
