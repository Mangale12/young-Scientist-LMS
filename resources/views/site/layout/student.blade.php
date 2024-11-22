<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Young Scientist </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/site/student/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/student/owlcarousel/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/student/scss/style.css')}}">
    @yield('css')

</head>

<body>
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="{{asset('assets/site/student/owlcarousel/owl.carousel.min.js')}}"></script>
    <script>
    AOS.init();
    </script>
    @yield('scripts')


    <footer class="footer mt-lg-5 pt-lg-5 pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-2">
                    <h6>Courses</h6>
                    <ul>
                        <li>
                            <a href="#">Quarky - AI & Robotics Kit</a>
                        </li>
                        <li>
                            <a href="#">Quarky Addon Kits</a>
                        </li>
                        <li>
                            <a href="#">evive - STEM Kit</a>
                        </li>
                        <li>
                            <a href="#">PictoBlox Software</a>
                        </li>
                        <li>
                            <a href="#">Quarky - AI & Robotics Kit</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 pe-lg-5">
                    <h6>Product Documentation</h6>
                    <ul>
                        <li>
                            <a href="#">Quarky Kits</a>
                        </li>
                        <li>
                            <a href="#">evive Kits</a>
                        </li>
                        <li>
                            <a href="#">PictoBlox Software</a>
                        </li>
                        <li>
                            <a href="#">PictoBlox Extensions & Libraries</a>
                        </li>
                        <li>
                            <a href="#">PictoBlox Software</a>
                        </li>
                    
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6>School Programs</h6>
                    <ul>
                        <li>
                            <a href="#">AI & Robotics Lab </a>
                        </li>
                        <li>
                            <a href="#">Atal Tinkering Labs
                            </a>
                        </li>
                        <li>
                            <a href="#">PictoBlox Extensions & Libraries</a>
                        </li>
                        <li>
                            <a href="#">Atal Tinkering Labs
                            </a>
                        </li>
                        <li>
                            <a href="#">PictoBlox Extensions & Libraries</a>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6>Resources</h6>
                    <ul>
                        <li>
                            <a href="#">AI & Robotics Lab </a>
                        </li>
                        <li>
                            <a href="#">Atal Tinkering Labs
                            </a>
                        </li>
                        <li>
                            <a href="#">PictoBlox Extensions & Libraries</a>
                        </li>
                        <li>
                            <a href="#">Atal Tinkering Labs
                            </a>
                        </li>
                        <li>
                            <a href="#">PictoBlox Extensions & Libraries</a>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-12 pt-lg-5">
                    <div class="footer__nav py-lg-4">
                        <ul class="d-flex justify-content-center">
                            <li>
                                <a href="#">Terms and conditions
                                </a>
                            </li>
                            <li>
                                <a href="#">Privacy Policy
                                </a>
                            </li>
                            <li>
                                <a href="#">Cookies
                                </a>
                            </li>
                            <li>
                                <a href="#">Cookie Setting
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="w-75 mx-auto">
                        <div class="line"></div>
                    </div>
                    <div class="footer__copy-right text-center py-lg-4">
                        <p>
                            Copyright © 2023. All Rights Reserved | Designed by Prabidhi enterprises |
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </footer>
</body>

</html>