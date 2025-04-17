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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        /* Fix hero section */
        .hero-wrap {
            width: 100%;
            height: 100vh;
            min-height: 700px;
            position: relative;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        .hero-wrap .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: '';
            opacity: .3;
            background: #000000;
        }

        .hero-wrap.js-fullheight {
            height: 100vh !important;
        }

        .slider-text {
            color: #fff;
            height: 700px;
            display: flex !important;
            align-items: center !important;
        }

        .slider-text h1 {
            font-size: 60px;
            color: #fff;
            line-height: 1.2;
            font-weight: 800;
        }

        .slider-text p {
            font-size: 20px;
            line-height: 1.5;
            font-weight: 400;
            color: rgba(255, 255, 255, .9);
        }

        @media (max-width: 767.98px) {
            .hero-wrap {
                height: 600px;
                min-height: 600px;
            }

            .slider-text {
                height: 600px;
            }

            .slider-text h1 {
                font-size: 40px;
            }
        }

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
            background: rgba(0, 0, 0, 0.5);
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
    @yield('style') <!-- Đảm bảo đây là nơi chèn style của view -->
</head>

<body>
    @include('page.common.navbar')

    @if(session('success'))
    <div class="alert custom-alert alert-success alert-dismissible fade show animate__animated animate__fadeInRight"
        style="position: fixed; 
                top: 20px; 
                right: 20px; 
                z-index: 9999;
                min-width: 300px;
                max-width: 400px;
                background-color: #4caf50;
                color: white;
                border: none;
                border-radius: 10px;
                padding: 15px 20px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 15px;">
            <span style="display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-check-circle" style="font-size: 20px;"></i>
                <span style="font-size: 15px;">{{ session('success') }}</span>
            </span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert custom-alert alert-danger alert-dismissible fade show animate__animated animate__fadeInRight"
        style="position: fixed; 
                top: 20px; 
                right: 20px; 
                z-index: 9999;
                min-width: 300px;
                max-width: 400px;
                background-color: #f44336;
                color: white;
                border: none;
                border-radius: 10px;
                padding: 15px 20px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
        <div style="display: flex; align-items: center;">
            <i class="fas fa-exclamation-circle" style="font-size: 24px; margin-right: 15px;"></i>
            <span style="font-size: 14px; display: flex; align-items: center;">{{ session('error') }}</span>
        </div>
    </div>
    @endif

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
                xfbml: true,
                version: 'v12.0'
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
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });

            // Auto hide alerts after 5 seconds with fade out animation
            setTimeout(function() {
                $('.custom-alert').addClass('animate__fadeOutRight');
                setTimeout(function() {
                    $('.custom-alert').alert('close');
                }, 1000);
            }, 5000);

            // Hover effect
            $('.custom-alert').hover(
                function() {
                    $(this).css('transform', 'translateY(-3px)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                }
            );
        });
    </script>
</body>

</html>