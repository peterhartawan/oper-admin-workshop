window.addEventListener('DOMContentLoaded', function (event) {
    console.log('DOM fully loaded and parsed');
    webmeetsdkready();
});

function webmeetsdkready() {
    const ERR_HOST_IN_OTHER_MEETING = 3000;

    var API_KEY = atob(document.getElementById("zoom_key").value);
    var API_SECRET = atob(document.getElementById("zoom_secret").value);

    var mn = document.getElementById("mn").value;
    var pwd = document.getElementById("pwd").value;
    var bookingNo = document.getElementById("booking_no").value;

    var meetingConfig = {
        meetingNumber: mn,
        passWord: pwd,
        userName: document.getElementById("name").value,
        userEmail: document.getElementById("email").value,
        leaveUrl: "/service-advisor/order-inprogress",
        role: 0,
        lang: "en-US",
        signature: "",
        china: false,
    };

    // generate zoom signature
    var signature = ZoomMtg.generateSignature({
        meetingNumber: meetingConfig.meetingNumber,
        apiKey: API_KEY,
        apiSecret: API_SECRET,
        role: meetingConfig.role,
        success: function (res) {
            meetingConfig.signature = res.result;
            meetingConfig.apiKey = API_KEY;
        },
    });

    // a tool use debug mobile device
    // if (testTool.isMobileDevice()) {
    //     vConsole = new VConsole();
    // }
    // console.log(JSON.stringify(ZoomMtg.checkSystemRequirements()));

    if (meetingConfig.china)
        ZoomMtg.setZoomJSLib("https://jssdk.zoomus.cn/1.9.7/lib", "/av"); // china cdn option

    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareJssdk();

    function beginJoin(signature) {
        ZoomMtg.init({
            leaveUrl: meetingConfig.leaveUrl,
            webEndpoint: meetingConfig.webEndpoint,
            disableCORP: !window.crossOriginIsolated, // default true
            screenShare: true,
            // disablePreview: false, // default false
            success: function () {
                ZoomMtg.i18n.load(meetingConfig.lang);
                ZoomMtg.i18n.reload(meetingConfig.lang);
                ZoomMtg.join({
                    meetingNumber: meetingConfig.meetingNumber,
                    userName: meetingConfig.userName,
                    signature: signature,
                    apiKey: meetingConfig.apiKey,
                    userEmail: meetingConfig.userEmail,
                    passWord: meetingConfig.passWord,
                    success: function (res) {
                        console.log("join meeting success");

                        // console.log("get attendeelist");
                        // ZoomMtg.getAttendeeslist({});
                        // ZoomMtg.getCurrentUser({
                        //     success: function (res) {
                        //         console.log("success getCurrentUser", res.result.currentUser);
                        //     },
                        // });
                    },
                    error: function (res) {
                        if (res.errorCode == ERR_HOST_IN_OTHER_MEETING) {
                            if (confirm('Anda Sedang Berada Di Room Lain.\nApakah anda mau menyudahi Room lainnya?')) {
                                window.location.href = "/service-advisor/zoom/"+bookingNo+"?end_other_meeting=1";
                            } else {
                                window.location.href = "/service-advisor/order-inprogress";
                            }
                        }
                        console.log(res);
                    }
                });
            },
            error: function (res) {
                console.log(res);
            },
        });

        // ZoomMtg.inMeetingServiceListener('onUserJoin', function (data) {
        //     console.log('inMeetingServiceListener onUserJoin', data);
        // });
        //
        // ZoomMtg.inMeetingServiceListener('onUserLeave', function (data) {
        //     console.log('inMeetingServiceListener onUserLeave', data);
        // });
        //
        // ZoomMtg.inMeetingServiceListener('onUserIsInWaitingRoom', function (data) {
        //     console.log('inMeetingServiceListener onUserIsInWaitingRoom', data);
        // });
        //
        // ZoomMtg.inMeetingServiceListener('onMeetingStatus', function (data) {
        //     console.log('inMeetingServiceListener onMeetingStatus', data);
        // });
    }

    beginJoin(meetingConfig.signature);
};
