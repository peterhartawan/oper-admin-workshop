<head>
    <title>Zoom Dengan Customer</title>
    <meta charset="utf-8"/>
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.7/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.7/css/react-select.css"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="origin-trial" content="">
</head>

<body>
    <input type="hidden" id="mn" value="{{ $mn }}">
    <input type="hidden" id="pwd" value="{{ $pwd }}">
    <input type="hidden" id="name" value="{{ $name }}">
    <input type="hidden" id="email" value="{{ $email }}">
    <input type="hidden" id="booking_no" value="{{ $bookingNo }}">
    <input type="hidden" id="zoom_key" value="{{ $zoomKey }}">
    <input type="hidden" id="zoom_secret" value="{{ $zoomSecret }}">
</body>

<script src="https://source.zoom.us/1.9.7/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/1.9.7/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/1.9.7/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/1.9.7/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/1.9.7/lib/vendor/lodash.min.js"></script>
<script src="https://source.zoom.us/zoom-meeting-1.9.7.min.js"></script>
<script src="{{ asset('/template/js/zoom/meeting.js') }}"></script>

</html>
