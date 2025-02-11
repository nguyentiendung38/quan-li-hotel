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
<!--Start of Fchat.vn--><script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=66de69238aaf195fa5158224" async="async"></script><!--End of Fchat.vn-->
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