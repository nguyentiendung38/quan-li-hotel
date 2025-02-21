<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
    </svg>
</div>
<script src="{{ asset('page/js/jquery.min.js') }}"></script>
<script src="{{ asset('page/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('page/js/popper.min.js') }}"></script>
<script src="{{ asset('page/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('page/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('page/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('page/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('page/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('page/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('page/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('page/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('page/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>

<script src="{{ asset('page/js/google-map.js') }}"></script>
<!-- toastr -->
<script src="{!! asset('admin/plugins/toastr/toastr.min.js') !!}"></script>
  <!---Start TaggoAI--->
  <script async data-taggo-botid="67b40efd2a4dbd193757845e" src="https://widget.taggo.chat/v2.js"></script>
  <!---End TaggoAI--->
  <script>
    var urlComment = '{{ route('comment') }}';

    $(function () {
        toastr.options.closeButton = true;
        @if(session('success'))
        var message = "{{ session('success') }}";
        toastr.success(message, {timeOut: 3000});
        @endif
        @if(session('error'))
        var message = "{{ session('error') }}";
        toastr.error(message, {timeOut: 3000});
        @endif
        setTimeout(function(){ toastr.clear() }, 3000);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
</script>
<script src="{{ asset('page/js/main.js') }}"></script>
<script src="{{ asset('page/js/tour.js') }}"></script>
<script src="{{ asset('page/js/comment.js') }}"></script>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
  </script>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        xfbml: true,
        version: 'v16.0'
      });
    };

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
   <style>
    /* CSS cho icon Zalo */
    .zalo-chat-icon {
      position: fixed;
      top: 350px;
      right: 10px;
      z-index: 1000;
      padding: 10px;
      border-radius: 50%;
      cursor: pointer;
      animation: shake 1s ease-in-out 3;
    }
    
    .zalo-chat-icon img {
      width: 50px;
      height: 50px;
    }

    /* CSS cho icon Facebook */
    .fb-chat-icon {
      position: fixed;
      top: 410px;
      right: 10px;
      z-index: 1001;
      padding: 10px;
      border-radius: 50%;
      cursor: pointer;
      animation: shake 1s ease-in-out 3;
    }

    .fb-chat-icon img {
      width: 50px;
      height: 50px;
    }
    
  </style>
</head>
<body>

  <!-- Icon Zalo -->
  <div class="zalo-chat-icon" onclick="openZaloChat()">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Icon_of_Zalo.svg/1024px-Icon_of-Zalo.svg.png" alt="Chat Zalo">
  </div>

  <!-- Icon Facebook (đặt nằm trên icon Zalo) -->
  <div class="fb-chat-icon" onclick="openFbChat()">
    <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Chat Facebook">
  </div>

  <!-- Nhúng SDK của Zalo (nếu cần) -->
  <script src="https://sp.zalo.me/plugins/sdk.js"></script>

  <script>
    function openZaloChat() {
      window.open("https://zalo.me/0773398244", "_blank");
    }
  
    function openFbChat() {
      window.open("https://www.facebook.com/congtydulichtourshue/", "_blank");
    }
  </script>
  