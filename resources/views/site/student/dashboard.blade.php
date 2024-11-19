    @extends('site.layout.student')
    @section('content')
    @include('site.includes.header')
    <section class="banner-profile my-lg-4 my-3 bg-light ">
        <div class="container">
            <div class="banner-profile--details d-flex align-items-center p-3">
                <div class="banner-profile--details--img me-3">
                    <img src="{{asset('images/profile-avatar-legacy.png')}}" alt="img">
                </div>
                <div class="banner-profile--details--content">
                    <h4 class="fw-bold">
                        Welcome back, Dinesh Bahadur
                    </h4>
                    <p class="fs-5 fw-500">Class 7 Student <small class="fs-6"><i
                                class="fa-solid fa-circle text-primary"></i> Active</small>
                    </p>
                </div>


            </div>

        </div>

    </section>
    <section class="my-learning pt-4 pb-1">
        <div class="container text-center d-flex flex-column align-items-center">
            <h1 class="text-white fw-bold">My learning</h1>
            <nav>
                <ul class="d-flex align-items-center justify-content-center list-unstyled">
                    <li><a class="active" href="#">All Courses</a></li>
                    <li><a href="#">My Certificates</a></li>
                    <li><a href="#">My Badges</a></li>
                    <li><a href="groups.html">Groups <span class="badge text-bg-light">10</span></a></li>
                    <li><a href="#">Profile</a></li>
                </ul>
            </nav>
        </div>
    </section>
    
    <section class="my-learning-tag py-4">
        <div class="container">
            <ul class="nav nav-pills d-flex justify-content-center d mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="All-tab" data-bs-toggle="pill" data-bs-target="#All"
                        type="button" role="tab" aria-controls="All" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Curriculum-tab" data-bs-toggle="pill" data-bs-target="#Curriculum"
                        type="button" role="tab" aria-controls="Curriculum" aria-selected="false">School Curriculum
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                        aria-selected="false">
                        Teacher Resources
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="skill-courses-tab" data-bs-toggle="pill"
                        data-bs-target="#skill-courses" type="button" role="tab" aria-controls="skill-courses"
                        aria-selected="false">
                        Skill Courses
                    </button>
                </li>

            </ul>
            <div class="tab-content courses" id="pills-tabContent">
                <div class="tab-pane fade show active" id="All" role="tabpanel" aria-labelledby="All-tab" tabindex="0">

                    <div class="row justify-content-center g-4">
                        <div class="col-lg-3">
                            <div class="courses__details border">
                                <a href="#">
                                    <img class="w-100" src="{{asset('images/Programming-for-Kids-768x288.jpg')}}" alt="">
                                </a>
                                <div class="courses__details--content p-3">
                                    <span> 12 Lessons</span>
                                    <a class="d-block my-2" href="#">
                                        Introduction to Programming
                                    </a>

                                    <p>
                                        Covers the basic concepts of coding like sequence, loops, variables, arithmetic
                                        operators.
                                    </p>
                                   <progress class="w-100" id="file" value="32" max="100"> 32% </progress>
                                    <label for="file"><small>32% Complete</small> </label>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="courses__details border">
                                <a href="#">
                                    <img class="w-100" src="{{asset('images/Programming-for-Kids-768x288.jpg')}}" alt="">
                                </a>
                                <div class="courses__details--content p-3">
                                    <span> 12 Lessons</span>
                                    <a class="d-block my-2" href="#">
                                        Introduction to Programming
                                    </a>

                                    <p>
                                        Covers the basic concepts of coding like sequence, loops, variables, arithmetic
                                        operators.
                                    </p>
                                   <progress class="w-100" id="file" value="32" max="100"> 32% </progress>
                                    <label for="file"><small>32% Complete</small> </label>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="courses__details border">
                                <a href="#">
                                    <img class="w-100" src="{{asset('images/Programming-for-Kids-768x288.jpg')}}" alt="">
                                </a>
                                <div class="courses__details--content p-3">
                                    <span> 12 Lessons</span>
                                    <a class="d-block my-2" href="#">
                                        Introduction to Programming
                                    </a>

                                    <p>
                                        Covers the basic concepts of coding like sequence, loops, variables, arithmetic
                                        operators.
                                    </p>
                                   <progress class="w-100" id="file" value="32" max="100"> 32% </progress>
                                    <label for="file"><small>32% Complete</small> </label>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="courses__details border">
                                <a href="#">
                                    <img class="w-100" src="{{asset('images/Programming-for-Kids-768x288.jpg')}}" alt="">
                                </a>
                                <div class="courses__details--content p-3">
                                    <span> 12 Lessons</span>
                                    <a class="d-block my-2" href="#">
                                        Introduction to Programming
                                    </a>

                                    <p>
                                        Covers the basic concepts of coding like sequence, loops, variables, arithmetic
                                        operators.
                                    </p>
                                   <progress class="w-100" id="file" value="32" max="100"> 32% </progress>
                                    <label for="file"><small>32% Complete</small> </label>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="courses__details border">
                                <a href="#">
                                    <img class="w-100" src="{{asset('images/Programming-for-Kids-768x288.jpg')}}" alt="">
                                </a>
                                <div class="courses__details--content p-3">
                                    <span> 12 Lessons</span>
                                    <a class="d-block my-2" href="#">
                                        Introduction to Programming
                                    </a>

                                    <p>
                                        Covers the basic concepts of coding like sequence, loops, variables, arithmetic
                                        operators.
                                    </p>
                                   <progress class="w-100" id="file" value="32" max="100"> 32% </progress>
                                    <label for="file"><small>32% Complete</small> </label>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="courses__details border">
                                <a href="#">
                                    <img class="w-100" src="{{asset('images/Programming-for-Kids-768x288.jpg')}}" alt="">
                                </a>
                                <div class="courses__details--content p-3">
                                    <span> 12 Lessons</span>
                                    <a class="d-block my-2" href="#">
                                        Introduction to Programming
                                    </a>

                                    <p>
                                        Covers the basic concepts of coding like sequence, loops, variables, arithmetic
                                        operators.
                                    </p>
                                   <progress class="w-100" id="file" value="32" max="100"> 32% </progress>
                                    <label for="file"><small>32% Complete</small> </label>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="courses__details border">
                                <a href="#">
                                    <img class="w-100" src="{{asset('images/Programming-for-Kids-768x288.jpg')}}" alt="">
                                </a>
                                <div class="courses__details--content p-3">
                                    <span> 12 Lessons</span>
                                    <a class="d-block my-2" href="#">
                                        Introduction to Programming
                                    </a>

                                    <p>
                                        Covers the basic concepts of coding like sequence, loops, variables, arithmetic
                                        operators.
                                    </p>
                                    <progress class="w-100" id="file" value="32" max="100"> 32% </progress>
                                    <label for="file"><small>32% Complete</small> </label>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="courses__details border">
                                <a href="#">
                                    <img class="w-100" src="{{asset('images/Programming-for-Kids-768x288.jpg')}}" alt="">
                                </a>
                                <div class="courses__details--content p-3">
                                    <span> 12 Lessons</span>
                                    <a class="d-block my-2" href="#">
                                        Introduction to Programming
                                    </a>

                                    <p>
                                        Covers the basic concepts of coding like sequence, loops, variables, arithmetic
                                        operators.
                                    </p>

                                    <progress class="w-100" id="file" value="32" max="100"> 32% </progress>
                                    <label for="file"><small>32% Complete</small> </label>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="Curriculum" role="tabpanel" aria-labelledby="Curriculum-tab"
                    tabindex="0">School Curriculum</div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                    tabindex="0">...</div>
                <div class="tab-pane fade" id="skill-courses" role="tabpanel" aria-labelledby="skill-courses-tab"
                    tabindex="0">Skill Courses</div>
            </div>
        </div>
    </section>



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
    @endsection



   




    