{{-- 
    How to use this loader:
    
    1. import css by doing <link rel="stylesheet" href="{{ asset('/cms/css/loader.css') }}" />
    2. 
--}}

<div id="loader" class="d-none">
    <div id="spinner" class="spinner-border text-light">
    </div>
</div>

<script type="text/javascript">
    let loader = $('#loader');

    function loaderOn(){
        loader.removeClass('d-none');
    }

    function loaderOff(){
        loader.addClass('d-none');
    }
</script>