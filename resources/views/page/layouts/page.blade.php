<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Mạng bán TOUR DU LỊCH trực tuyến hàng đầu Việt Vam | Fun Travel')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('page.common.head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hotel-icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    
    <style>
        /* Fix heading section display */
        .heading-section {
            position: relative;
            margin-bottom: 30px;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        .heading-section .subheading {
            font-size: 18px;
            display: block;
            margin-bottom: 10px;
            color: #007bff;
            font-weight: 600;
            text-transform: uppercase;
            opacity: 1 !important;
        }
        
        .heading-section h2 {
            font-size: 40px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 20px;
            opacity: 1 !important;
            display: block !important;
        }

        /* Services section fixes */
        .services-section {
            background: #ffffff;
            padding: 5em 0;
            position: relative;
            z-index: 0;
        }

        .services-1 {
            margin-bottom: 30px;
            padding: 30px;
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 1;
        }

        .services-1:after {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: '';
            background: rgba(0,0,0,0.5);
            z-index: -1;
        }

        /* Fix ftco-animate */
        .ftco-animate {
            opacity: 1 !important;
            visibility: visible !important;
        }

        /* Fix destination carousel */
        .ftco-select-destination {
            position: relative;
            z-index: 0;
            padding: 5em 0;
        }

        .project-destination {
            position: relative;
            margin-bottom: 30px;
            height: 300px;
        }

        .project-destination .img {
            height: 100%;
            background-size: cover;
            background-position: center;
            position: relative;
        }
    </style>
    @yield('style')  <!-- Đảm bảo đây là nơi chèn style của view -->
</head>
<body>
    @include('page.common.navbar')
    @yield('content')
    @include('page.common.footer')
    @include('page.common.script')

    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "102030232294539");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
    $(document).ready(function() {
        // Remove any opacity animations
        $('.ftco-animate').css({
            'opacity': '1',
            'visibility': 'visible'
        });

        // Initialize carousels
        $('.carousel-destination').owlCarousel({
            items: 4,
            loop: true,
            margin: 30,
            nav: true,
            dots: true,
            autoplay: true,
            responsive:{
                0:{ items: 1 },
                600:{ items: 2 },
                1000:{ items: 4 }
            }
        });
    });
    </script>
</body>
</html>