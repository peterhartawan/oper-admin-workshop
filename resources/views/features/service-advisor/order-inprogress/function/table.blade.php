@if(!isset($listdata) || empty($listdata))
    <script type="text/javascript">
        endOfRequest = true;

        if(!$('#end-of-content').length){
            $('#content').append('<tr id="end-of-content"><td colspan="6"><div class="row"><div class="col-12 d-flex justify-content-center"><h4>This is the end of the content.</h4></div></div></td></tr>');
        }
    </script>
@else

    @foreach($listdata->data as $order)

        <tr>

            @isset($order->booking_no)
                <td>
                    {{ $order->booking_no }}
                </td>
            @else
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($order->customer_name)
                <td>
                    {{ $order->customer_name }}
                </td>
            @else
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            <td>
                {{ $order->vehicle_name ?? "Data not available" }}
            </td>

            <td>
                {{ $order->vehicle_plat ?? "Data not available" }}
            </td>

            @isset($order->workshop_bengkel->bengkel_name)
                <td>
                    {{ $order->workshop_bengkel->bengkel_name }}
                </td>
            @else
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($order->order_type)
                <td>
                    @switch($order->order_type)
                        @case(1)
                            Mobil
                            @break
                        @case(2)
                            Motor
                            @break
                    @endswitch
                </td>
            @else
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($order->order_status)
                <td>
                    @switch($order->order_status)
                        @case(2)
                            Open Order
                            @break

                        @case(3)
                            PKB Submitted
                            @break

                        @case(10)
                            Done Foreman
                            @break

                        @case(5)
                            Invoice Attached
                            @break
                    @endswitch
                </td>
            @else
                <td class="bg-danger-light">
                    <i class="fa fa-exclamation-circle"></i> Data not available
                </td>
            @endisset

            @isset($order->id)
                <td class="text-center">
                    <div class="btn-group mr-2 mb-2" data-toggle="buttons" role="group" aria-label="Icons Action group">
                        <button type="button"
                            class="btn btn-sm btn-primary"
                            onclick="detailView({{ $order->id }})">
                            <i class="far fa-fw fa-eye"></i>
                        </button>
                        @switch($order->order_status)
                            @case(2)
                                <button type="button"
                                    class="btn btn-sm btn-primary"
                                    onclick="updateViewStatus2({{ $order->id }})">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                @break

                            @case(3)
                                <button type="button"
                                    class="btn btn-sm btn-primary"
                                    onclick="updateViewStatus3({{ $order->id }})">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                @break

                            @case(10)
                                <button type="button"
                                    class="btn btn-sm btn-primary"
                                    onclick="updateViewStatus10({{ $order->id }}, '{{ $order->customer_name }}')">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                @break

                            @case(5)
                                <button type="button"
                                    class="btn btn-sm btn-primary"
                                    onclick="updateViewStatus5({{ $order->id }}, '{{ $order->customer_name }}')">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                @break
                        @endswitch
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
