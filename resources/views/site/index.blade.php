
@extends('site.layout.app')
@section('content')
    <section class="header">
        <div class="header__top py-1">
            <div class="container ">
                <div class="d-flex justify-content-end login-register-btn">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginForm"><i class="fa-regular fa-user"></i>
                        Login</a>
                    <!-- Button trigger modal -->

                    <a href="#" data-bs-toggle="modal" data-bs-target="#registerForm"><i
                            class="fa-solid fa-circle-notch"></i> Register Account</a>

                </div>

            </div>
        </div>
        <div class="header__navbar py-2">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="index.html"><img src="images/logo.png" alt="logo" height="70" class="center-image"></a>
                    <nav class="header__navbar--left header__navbar--right">
                        <ul class="d-flex align-items-center">

                            <li class="dropdown">
                                <a href="Pre-K & Kindergarten.html">LEVELS <i
                                        class="fa-solid fa-chevron-down arrow"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="Pre-K & Kindergarten.html">Pre-K & Kindergarten </a></li>
                                    <li><a href="elementry.html">Elementary</a></li>
                                    <li><a href="middle.html">Middle</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="elementary.html">CAMPS <i class="fa-solid fa-chevron-down arrow"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="summber-camp.html">Summery CAMP</a></li>
                                    <li><a href="winter-camp.html">Winter CAMP</a></li>
                                    <li><a href="after-school.html">After School </a></li>



                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="middle.html">SCHOOL PROGRAM <i class="fa-solid fa-chevron-down arrow"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="yearly-plan.html">Yearly Plan</a></li>
                                    <li><a href="bootcamp.html">Bootcamp</a></li>
                                    <li><a href="online-class.html">Online Class</a></li>

                                </ul>
                            </li>
                            <li>
                                <a href="coding-cometition.html">COMPETITION </a>

                            </li>
                            <!-- Login dropdown -->
                            <!-- <li class="dropdown">
                                <a href="#">Login <i class="fa-solid fa-chevron-down arrow"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="login.html">Individual Login</a></li>
                                    <li><a href="#">School Login</a></li>
                                </ul>
                            </li> -->
                            <!-- <li>
                                <a class="try-a-free-class login" href="login.html">Login</a>
                            </li> -->

                            <li>
                                <a class="try-a-free-class" href="try-free-class.html">Try a free Trial Class</a>
                            </li>
                        </ul>
                    </nav>



                </div>
            </div>
        </div>
    </section>
    <section class="banner">
        <div class="container ">
            <div class="banner__details d-flex justify-content-center ">
                <div class="text-center mt-lg-100">
                    <div data-aos="zoom-in">
                        <span> Welcome To Young Scientist</span>
                    </div>



                    <h1 class="aos-init" data-aos="fade-up" data-aos-easing="ease" data-aos-delay="400">
                        Young Scientist helps you
                    </h1>
                    <div class="aos-init" data-aos="fade-up" data-aos-easing="ease" data-aos-delay="800">
                        <span>
                            Develop computational skills.Code like pro.understand concept of programming
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="courses aos-init" data-aos="fade-up" data-aos-easing="ease" data-aos-delay="1200">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-3">
                    <div class="courses__details">
                        <img src="images/1.jpeg" alt="img">
                        <div class="courses__details--title">
                            <a href="#"> <i class="fa-solid fa-angle-right"></i> Pre-K & Kindergarten </a>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="courses__details">
                        <img src="images/product-fe1.png" alt="img">
                        <div class="courses__details--title">
                            <a href="#"> <i class="fa-solid fa-angle-right"></i> Elementary </a>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="courses__details">
                        <img src="images/2.jpeg" alt="img">
                        <div class="courses__details--title">
                            <a href="#"> <i class="fa-solid fa-angle-right"></i> Middle </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <section class="unlock py-lg-5 py-3">
        <div class="container">
            <div class="section-title text-center py-lg-4">
                <h1 data-aos="zoom-in">Unlock Limitless Potential</h1>
                <p class="aos-init" data-aos="fade-up" data-aos-easing="ease" data-aos-delay="400">Meaningful learning,
                    extraordinary engagement, and the resources and support to ensure success.</p>
            </div>
            <div class="row justify-content-center align-items-center pt-lg-5 pt-4 ">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="unlock__details" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon">
                            <i class="fa-brands fa-skyatlas"></i>
                        </div>
                        <div class="text  pe-lg-3 ">
                            <h5> Meeting Standards – Having Fun</h5>
                            <p>
                                Engaging, standards-aligned lessons that are easy to get started, <br>
                                with the scalability to meet all learners where they are.
                            </p>
                        </div>

                    </div>
                    <div class="unlock__details" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon">
                            <i class="fa-brands fa-airbnb"></i>
                        </div>
                        <div class="text pe-lg-3 ">
                            <h5> Excite, Engage and Inspire</h5>
                            <p>
                                Hands-on playful learning solutions featuring the familiar LEGO®
                                bricks that inspire all types of students to become active <br>
                                learners.
                            </p>
                        </div>

                    </div>
                    <div class="unlock__details" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon">
                            <i class="fa-solid fa-headphones-simple"></i>
                        </div>
                        <div class="text  pe-lg-3 ">
                            <h5> Everything you need to succeed</h5>
                            <p>
                                Built in scaffolding, professional development and a community
                                of like-minded educators ready to support you.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-5 col-mg-6 col-12">
                    <div class="unlock__images position-relative">
                        <div class="image-container position-relative ">
                            <img src="images/product-fe2.png" alt="img" class="main-img" data-aos="zoom-in"
                                data-aos-delay="100">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="blog__details" data-aos="zoom-in" data-aos-delay="100">
                        <div class="img"><img src="images/2.jpeg" alt="img"></div>
                        <div class="text">
                            <h5 class="pb-lg-2">
                                State of Classroom ​
                                Engagement Report
                            </h5>
                            <p>
                                Access our report to learn how
                                global insights from 6,000-plus
                                administrators, teachers, parents
                                and students reveal strategies to
                                build more engaged classrooms.
                            </p>
                            <a href="#">READ THE RESOURCES <i class="fa-solid fa-arrow-right"></i> </a>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="blog__details" data-aos="zoom-in" data-aos-delay="100">
                        <div class="img"><img src="images/2.jpeg" alt="img"></div>
                        <div class="text">
                            <h5 class="pb-lg-2">
                                State of Classroom ​
                                Engagement Report
                            </h5>
                            <p>
                                Access our report to learn how
                                global insights from 6,000-plus
                                administrators, teachers, parents
                                and students reveal strategies to
                                build more engaged classrooms.
                            </p>
                            <a href="#">READ THE RESOURCES <i class="fa-solid fa-arrow-right"></i> </a>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="blog__details" data-aos="zoom-in" data-aos-delay="100">
                        <div class="img"><img src="images/2.jpeg" alt="img"></div>
                        <div class="text">
                            <h5 class="pb-lg-2">
                                State of Classroom ​
                                Engagement Report
                            </h5>
                            <p>
                                Access our report to learn how
                                global insights from 6,000-plus
                                administrators, teachers, parents
                                and students reveal strategies to
                                build more engaged classrooms.
                            </p>
                            <a href="#">READ THE RESOURCES <i class="fa-solid fa-arrow-right"></i> </a>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="blog__details" data-aos="zoom-in" data-aos-delay="100">
                        <div class="img"><img src="images/2.jpeg" alt="img"></div>
                        <div class="text">
                            <h5 class="pb-lg-2">
                                State of Classroom ​
                                Engagement Report
                            </h5>
                            <p>
                                Access our report to learn how
                                global insights from 6,000-plus
                                administrators, teachers, parents
                                and students reveal strategies to
                                build more engaged classrooms.
                            </p>
                            <a href="#">READ THE RESOURCES <i class="fa-solid fa-arrow-right"></i> </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <section class="fun my-lg-5 my-3 py-lg-4">
        <div class="container">
            <div class="fun__details p-lg-5 ">
                <div class="row g-5 align-items-center justify-content-center">
                    <div class="col-lg-5">
                        <h1 data-aos="zoom-in" data-aos-delay="100">
                            Fun, Innovative and <br> Engagement
                        </h1>
                        <p data-aos="fade-up" data-aos-easing="ease" data-aos-delay="200">
                            With Young Scientist, you will enjoy creating, learning, and challenging yourself.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <div class="row ">
                            <div class="col-sm-6 col-12">
                                <div class="counter d-flex mb-lg-4">
                                    <div class="icon">
                                        <i class="fa-regular fa-share-from-square"></i>
                                    </div>
                                    <div class="text ps-lg-3">
                                        <h1>1000</h1>
                                        <p>Products</p>
                                    </div>
                                </div>


                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="counter d-flex mb-lg-4">
                                    <div class="icon">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </div>
                                    <div class="text ps-lg-3">
                                        <h1>1000</h1>
                                        <p>Products</p>
                                    </div>
                                </div>


                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="counter d-flex">
                                    <div class="icon">
                                        <i class="fa-solid fa-up-right-from-square"></i>
                                    </div>
                                    <div class="text ps-lg-3">
                                        <h1>1000</h1>
                                        <p>Products</p>
                                    </div>
                                </div>


                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="counter d-flex">
                                    <div class="icon">
                                        <i class="fa-regular fa-share-from-square"></i>
                                    </div>
                                    <div class="text ps-lg-3">
                                        <h1>1000</h1>
                                        <p>Products</p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="learning">

        <div class="container">
            <div class="section-title text-center py-lg-4">
                <h1 data-aos="zoom-in" data-aos-delay="100">STEM Learning Platform</h1>
                <p data-aos="fade-up" data-aos-easing="ease" data-aos-delay="200">Meaningful learning, extraordinary
                    engagement.</p>
            </div>
            <div class="learning__details">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="img-cover position-relative">
                            <img src="images/PictoBlox-Cover-Image.png" alt="img" data-aos="zoom-in"
                                data-aos-delay="100">
                            <img class="img-bg " src="images/bg-1.jpg" alt="img" data-aos="fade-up"
                                data-aos-easing="ease" data-aos-delay="100">
                        </div>
                    </div>
                    <div class="col-lg-6 pe-lg-5">
                        <div class="learning__desc pt-lg-4" data-aos="fade-up" data-aos-easing="ease"
                            data-aos-delay="100">
                            <h4>
                                Learn coding, AI, machine learning,
                                program actions for robots with PictoBlox
                            </h4>
                            <div class="desc pe-lg-5 pt-3">
                                <p>
                                    Learn to code with Scratch, the most popular block based coding
                                    language for kids in the world.Create your own games, animations,
                                    make characters mimic your actions and enact stories by
                                    setting up the stage for them
                                </p>
                            </div>

                            <a class="read-more" href="#">Read More <i class="fa-solid fa-arrow-right"></i> </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="our-product">

        <div class="container">
            <div class="section-title text-center py-lg-4">
                <h1 data-aos="zoom-in" data-aos-delay="100">Our products include <br>
                    standards-aligned lessons</h1>
                <p data-aos="fade-up" data-aos-easing="ease" data-aos-delay="100">Meaningful learning, extraordinary
                    engagement.</p>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="our-product__desc my-lg-4 my-3 p-4" data-aos="zoom-in" data-aos-delay="100">
                        <h4>
                            Pre-K and Kindergarten:
                        </h4>
                        <div class="desc pe-lg-5 pt-3">
                            <p>
                                <strong>
                                    Pre-K:
                                </strong>
                                Pre-school products align to NAEYC and Head Start preschool guidance.
                            </p>
                            <p>
                                <strong>
                                    Pre-K:
                                </strong>
                                Pre-school products align to NAEYC and Head Start preschool guidance.
                            </p>
                        </div>

                        <a class="read-more" href="#">Explore Lessons for Pre-K & Kindergarten <i
                                class="fa-solid fa-arrow-right"></i> </a>
                    </div>
                    <div class="our-product__desc my-lg-4 my-3 p-4" data-aos="zoom-in" data-aos-delay="100">
                        <h4>
                            Pre-K and Kindergarten:
                        </h4>
                        <div class="desc pe-lg-5 pt-3">
                            <p>
                                <strong>
                                    Pre-K:
                                </strong>
                                Pre-school products align to NAEYC and Head Start preschool guidance.
                            </p>

                        </div>

                        <a class="read-more" href="#">Explore Lessons for Pre-K & Kindergarten <i
                                class="fa-solid fa-arrow-right"></i> </a>
                    </div>
                    <div class="our-product__desc my-lg-4 my-3 p-4" data-aos="zoom-in" data-aos-delay="100">
                        <h4>
                            Pre-K and Kindergarten:
                        </h4>
                        <div class="desc pe-lg-5 pt-3">
                            <p>
                                <strong>
                                    Pre-K:
                                </strong>
                                Pre-school products align to NAEYC and Head Start preschool guidance.
                            </p>

                        </div>

                        <a class="read-more" href="#">Explore Lessons for Pre-K & Kindergarten <i
                                class="fa-solid fa-arrow-right"></i> </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="images/U2L6_img_step_7.png" alt="img" data-aos="zoom-in" data-aos-delay="100">
                </div>
            </div>

        </div>

    </section>
    <section class="innovate my-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title  py-lg-4">

                        <h1 data-aos="zoom-in" data-aos-delay="100">Innovate today for a better
                            tomorrow by inculcating
                            the indispensable skills
                            of the 21st century.</h1>

                        <p data-aos="fade-up" data-aos-easing="ease" data-aos-delay="100">Become a Changemaker : Lorem
                            Ipsum is simply dummy text of the printing and typesetting
                            industry.</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="innovate__details text-center" data-aos="zoom-in" data-aos-delay="100">
                                <img src="images/innovation.png" width="90" alt="img">

                                <b class="py-3">Innovativeness</b>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="innovate__details text-center" data-aos="zoom-in" data-aos-delay="100">
                                <img src="images/creativity.png" width="90" alt="img">

                                <b class="py-3">Creativity</b>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="innovate__details text-center" data-aos="zoom-in" data-aos-delay="100">
                                <img src="images/critical-thinking.png" width="90" alt="img">

                                <b class="py-3">Critical Thinking</b>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="innovate__details text-center" data-aos="zoom-in" data-aos-delay="100">
                                <img src="images/problem-solving.png" width="120" alt="img">

                                <b class="py-3">Problem Solving</b>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="innovate__details text-center" data-aos="zoom-in" data-aos-delay="100">
                                <img src="images/logical.png" width="90" alt="img">

                                <b class="py-3">Logical Reasoning</b>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="innovate__details text-center" data-aos="zoom-in" data-aos-delay="100">
                                <img src="images/team-work.png" width="90" alt="img">

                                <b class="py-3">Team Work</b>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="association">
        <div class="container">
            <div class="association__details p-lg-5 p-3">
                <div class="section-title text-center  py-lg-4">

                    <h1>International Association</h1>

                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
                <div class="pb-lg-4 d-flex justify-content-center align-items-center">
                    <div class="owl-carousel owl-partner mx-2">
                        <div>
                            <img class="owl-lazy" data-src="images/j.png" data-src-retina="images/j.png" alt="">
                        </div>
                        <div>
                            <img class="owl-lazy" data-src="images/k.png" data-src-retina="images/k.png" alt="">
                        </div>
                        <div>
                            <img class="owl-lazy" data-src="images/l.png" data-src-retina="images/l.png" alt="">
                        </div>
                        <div>
                            <img class="owl-lazy" data-src="images/m.png" data-src-retina="images/m.png" alt="">
                        </div>
                        <div>
                            <img class="owl-lazy" data-src="images/m.png" data-src-retina="images/m.png" alt="">
                        </div>
                        <div>
                            <img class="owl-lazy" data-src="images/l.png" data-src-retina="images/l.png">
                        </div>
                        <div>
                            <img class="owl-lazy" data-src="images/l.png" data-src-retina="images/l.png">

                        </div>
                        <div>
                            <img class="owl-lazy" data-src="images/m.png" data-src-retina="images/m.png" alt="">
                        </div>


                    </div>




                </div>
            </div>

        </div>

    </section>
    <section class="what-clint-say my-lg-5 my-3">
        <div class="container pt-lg-5">
            <div class="what-clint-say__details ">
                <b>What clients say <br>
                    about our amazing work</b>

                <div class="owl-carousel owl-clints">
                    <div>


                        <div class="d-flex justify-content-between pt-4">
                            <h1>
                                “Lorem ipsum dolor amet consectetur adipisicing
                                elit sed eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.enim ad minim eniam quis nostrud
                                exercitation.”
                            </h1>
                            <div class="images__inner">
                                <img src="images/say.jpg" alt="img">

                            </div>

                        </div>
                        <div class="user-profile ">
                            <div class="user-profile__details d-flex align-items-center">
                                <img src="images/1.jpeg" alt="user">
                                <div class="user-content">
                                    <b class="d-block">Kailly Wilson</b>
                                    <p>Managing Directors</p>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div>


                        <div class="d-flex justify-content-between pt-4">
                            <h1>
                                “Lorem ipsum dolor amet consectetur adipisicing
                                elit sed eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.enim ad minim eniam quis nostrud
                                exercitation.”
                            </h1>
                            <div class="images__inner">
                                <img src="images/say.jpg" alt="img">

                            </div>

                        </div>
                        <div class="user-profile ">
                            <div class="user-profile__details d-flex align-items-center">
                                <img src="images/1.jpeg" alt="user">
                                <div class="user-content">
                                    <b class="d-block">Kailly Wilson</b>
                                    <p>Managing Directors</p>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div>


                        <div class="d-flex justify-content-between pt-4">
                            <h1>
                                “Lorem ipsum dolor amet consectetur adipisicing
                                elit sed eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.enim ad minim eniam quis nostrud
                                exercitation.”
                            </h1>
                            <div class="images__inner">
                                <img src="images/say.jpg" alt="img">

                            </div>

                        </div>
                        <div class="user-profile ">
                            <div class="user-profile__details d-flex align-items-center">
                                <img src="images/1.jpeg" alt="user">
                                <div class="user-content">
                                    <b class="d-block">Kailly Wilson</b>
                                    <p>Managing Directors</p>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>


            </div>
        </div>
    </section>
    <section class="free-class pb-lg-5">
        <div class="container">
            <div class="free-class__icon">
                <img src="images/destop.webp" alt="img">
            </div>
            <div class="free-class__details text-center ">
                <h1 data-aos="zoom-in" data-aos-delay="100">
                    Try a free Trial Class
                </h1>
                <p data-aos="fade-up" data-aos-delay="200">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
                <div data-aos="fade-up" data-aos-delay="400">
                    <a href="#">Got to free Class <i class="fa-solid fa-arrow-right"></i></a>

                </div>
            </div>
        </div>

    </section>
    <footer class="footer mt-lg-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-2">
                    <h6>Connect</h6>
                    <ul>
                        <li>
                            <a href="#">Facebook</a>
                        </li>
                        <li>
                            <a href="#">Instagram</a>
                        </li>
                        <li>
                            <a href="#">Linkdin</a>
                        </li>
                        <li>
                            <a href="#">X (Twitter)</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 pe-lg-5">
                    <h6>About</h6>
                    <p>Founded in 2020, DURSIKSHYA
                        is one of the Nepal's leading
                        technology training companies
                        offering education for kids,
                        professionals and corporates.</p>
                </div>
                <div class="col-lg-3">
                    <h6>Support</h6>
                    <ul>
                        <li>
                            <a href="#">View all Support </a>
                        </li>
                        <li>
                            <a href="#">Online Technical Support
                            </a>
                        </li>
                        <li>
                            <a href="#">Missing an Element?
                            </a>
                        </li>
                        <li>
                            <a href="#">Order Help
                            </a>
                        </li>
                        <li>
                            <a href="#">Contact Us
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6>Resources</h6>
                    <p>Founded in 2020, DURSIKSHYA
                        is one of the Nepal's leading
                        technology training companies
                        offering education for kids,
                        professionals and corporates.</p>
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


    <!-- Modal login-->
    <div class="modal fade login-modals" id="loginForm" tabindex="-1" aria-labelledby="loginFormLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content position-relative-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5  fw-bold w-100 " id="exampleModalLabel">Young Scientist Login</h1>

                    <button type="button" class="btn-close close-btn-right" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>


                <div class="modal-body">
                    <div class="row g-0">
                        <div class="col-lg-5">
                            <img src="images/popup-sidebar1-1.png" alt="login" style="width: 100%;">

                        </div>
                        <div class="col-lg-7  p-4">
                            <form>
                                <div class="mb-4">

                                    <input type="text" class="form-control" id="recipient-name"
                                        placeholder="Username / Email">
                                </div>
                                <div class="mb-2">

                                    <input type="password" class="form-control" id="recipient-name"
                                        placeholder="Password">
                                </div>
                                <div class="mb-2 d-flex justify-content-end">
                                    <a class="forget-password" href="#">Forgot Password?</a>
                                </div>

                                <div class="mb-4">
                                    <button type="submit" class="btn  w-100 submit-btn">Sign in</button>
                                </div>
                            </form>
                            <p>LET’S START LEARNING</p>
                            <div class="mb-4">
                                <a class="btn   w-100 submit-sign-up" href="#">Sign Up</a>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Register login-->
    @include('site.includes.index.registration')
   



    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#studentForm').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Clear previous error messages
            $('#error-messages').html('');

            // Gather form data
            const formData = $(this).serialize();

            // Send AJAX request
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route("site.student.store")}}', // Replace with your endpoint URL
                method: 'POST',
                data: formData,
                success: function(response) {
                    alert('Registration successful!');
                    $('#studentForm')[0].reset(); // Reset form fields
                    // $('#myModal').modal('hide'); // Hide the modal (assuming modal has ID "myModal")
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // Validation error
                        const errors = xhr.responseJSON.errors;
                        displayErrors(errors);
                    } else {
                        $('#error-messages').html('An unexpected error occurred. Please try again.');
                    }
                }
            });
        });

        // Function to display validation errors
        function displayErrors(errors) {
            const errorMessages = $('#error-messages');
            $.each(errors, function(field, messages) {
                // For each field, display its error messages
                const fieldErrors = `<div><strong>${field}:</strong> ${messages.join(', ')}</div>`;
                errorMessages.append(fieldErrors);
            });
        }
    });


</script>

{{-- teacher  --}}
<script>
    $(document).ready(function() {
        // Handle form submission
        $('#teacherForm').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
    
            // Clear previous error messages
            $('.error-message').html('');
    
            // Validate form inputs
            let isValid = true;
    
            if ($('#teacherName').val().trim() === '') {
                $('#teacherNameError').text('Teacher name is required.');
                isValid = false;
            }
            if ($('#teacherID').val().trim() === '') {
                $('#teacherIDError').text('Teacher ID is required.');
                isValid = false;
            }
            if ($('#teacherEmail').val().trim() === '') {
                $('#teacherEmailError').text('Teacher email is required.');
                isValid = false;
            }
            if ($('#subjectExpert').val().trim() === '') {
                $('#subjectExpertError').text('Subject expert is required.');
                isValid = false;
            }
            if ($('#phoneNumber').val().trim() === '') {
                $('#phoneNumberError').text('Phone number is required.');
                isValid = false;
            }
            if ($('#password').val().trim() === '') {
                $('#passwordError').text('Password is required.');
                isValid = false;
            }
            if ($('#confirmPassword').val().trim() !== $('#password').val().trim()) {
                $('#confirmPasswordError').text('Passwords do not match.');
                isValid = false;
            }
    
            // Proceed with AJAX submission if the form is valid
            if (isValid) {
                const formData = $(this).serialize();
    
                // Send AJAX request
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("site.teacher.store") }}', // Replace with your endpoint URL
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Registration successful!');
                        $('#teacherForm')[0].reset(); // Reset form fields
                        // $('#teacher-registration').hide(); // Hide the modal
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Validation error
                            const errors = xhr.responseJSON.errors;
                            // Display server-side validation errors
                            for (let key in errors) {
                                $(`#${key}Error`).text(errors[key][0]);
                            }
                        } else {
                            alert('An unexpected error occurred. Please try again.');
                        }
                    }
                });
            }
        });
    });
    </script>
@endsection


   