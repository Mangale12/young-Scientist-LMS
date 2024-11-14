<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Young Scientist </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/site/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/owlcarousel/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/scss/style.css')}}">
    <style>
        .btn.active {
            background-color: #673AB7; /* Change to your desired active color */
            color: #fff;
        }
    </style>
    @yield('css')

</head>

<body>
@yield('content')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="{{asset('assets/site/owlcarousel/owl.carousel.min.js')}}"></script>
    <!-- JavaScript to handle form switching -->
    <script>
        document.getElementById('studentButton').addEventListener('click', function () {
            document.getElementById('student-registration').style.display = 'block';
            document.getElementById('teacher-registration').style.display = 'none';
        });

        document.getElementById('teacherButton').addEventListener('click', function () {
            document.getElementById('teacher-registration').style.display = 'block';
            document.getElementById('student-registration').style.display = 'none';
        });

        // By default, display the student registration form
        document.getElementById('student-registration').style.display = 'block';
        document.getElementById('teacher-registration').style.display = 'none';
    </script>
    <script>
        document.getElementById('studentButton').addEventListener('click', function () {
            document.getElementById('student-registration').style.display = 'block';
            document.getElementById('teacher-registration').style.display = 'none';
            
            // Add active class to the student button and remove from the teacher button
            this.classList.add('active');
            document.getElementById('teacherButton').classList.remove('active');
        });
    
        document.getElementById('teacherButton').addEventListener('click', function () {
            document.getElementById('teacher-registration').style.display = 'block';
            document.getElementById('student-registration').style.display = 'none';
            
            // Add active class to the teacher button and remove from the student button
            this.classList.add('active');
            document.getElementById('studentButton').classList.remove('active');
        });
    </script>
    <script>
        $('.owl-partner').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            lazyLoad: true,
            autoplayHoverPause: true,
            margin: 15,
            responsiveClass: true,
            navText: [
                '<i class="fa-solid fa-chevron-left"></i>',
                '<i class="fa-solid fa-chevron-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: false,
                    loop: true
                }
            }
        })
        $('.owl-clints').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            lazyLoad: true,
            autoplayHoverPause: true,
            dots: true,
            nav: true,
            items: 1,
            navText: [
                '<i class="fa-solid fa-chevron-left"></i>',
                '<i class="fa-solid fa-chevron-right"></i>'
            ],

        })
    </script>
    @yield('scripts')
</body>

</html>