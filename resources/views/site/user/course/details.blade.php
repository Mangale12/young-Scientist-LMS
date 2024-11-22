@extends('site.layout.student')
@section('content')
@include('site.includes.header')

<div class="banner-inner position-relative">
    <img class="banner-img" src="{{asset('images/cover-image.png')}}" alt="img">
    <section class="group-member">
        <div class="container">
            <div class="group-profile d-flex align-items-center">
                <img src="{{asset('images/profile.png')}}" alt="">
                <div class="ms-4">
                    <h2 class="text-white">Introduction to Python Course Group</h2>
                    <small class="text-white">
                        Active 7 weeks ago
                    </small>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="my-learning bg-white pb-1">
    <div class="container text-center d-flex flex-column align-items-start">
        <nav>
            <ul class="d-flex align-items-center justify-content-center list-unstyled">
                <li><a class=" text-dark" href="#">Members</a></li>
                <li><a class="active text-dark" href="#">Course</a></li>
            </ul>
        </nav>
    </div>
</section>

<section class="courses  py-4">
    <div class="container">
    
        <div class="row">
            <div class="col-lg-8 course-data">
                
            </div>
            <div class="col-lg-4">
                <div class="courses-sidebar border  sticky-top z-0 rounded-2 overflow-hidden  " style="top: 110px;">
                    <div class="profile">
                        <img class="w-100 " src="images/PictoBlox_Python-1.png" alt="">
                    </div>
                    <div class="p-4">
                        <a class="btn btn-start py-2 px-4 w-100 rounded-5 bg-primary text-white fw-bold" href="#">Start Course</a>
                        <h5 class="py-3">
                            Course Includes
                        </h5>
                        <p>
                            <i class="fa-solid fa-book"></i> 12 Lessons
                        </p>
                        <p>
                        <i class="fa-regular fa-address-book"></i> 49 Topics
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        var courseId = "{{$unique_id}}";
        $.ajax({
            url: `{{route('site.student.course-details', ':unique_id')}}`.replace(':unique_id', courseId),
            type: 'GET',
            success: function(response) {
                var course_data = `<div class="courses__details ">
                    <h2 class="pb-3">${response.title}</h2>
                    
                 
                    <div class="itinery ">
                        <p>${response.description}</p>
                        
                        <h5 class="pb-3">Basics of Coding</h5>
                        <h4 class="pb-3">Course Content</h4>

                        <div class="accordion" id="accordionExample">`
                            // Loop through each chapter and add them to the accordion
                        response.chapter.forEach((chapter, index) => {
                            course_data += `
                                <div class="itinery__item">
                                    <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}" aria-expanded="false" aria-controls="collapse${index}">
                                        <h5>
                                            <span>Lesson ${index + 1}:</span> ${chapter.title}
                                        </h5>
                                    </a>
                                    <div id="collapse${index}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>${chapter.description}</p>
                                        </div>
                                    </div>
                                </div>`;
                        });

                       course_data+= `</div>
                        <h5 class="py-3">Programming Concepts with Python</h5>
                        <div class="accordion" id="accordionExample">
                            <div class="itinery__item">
                                <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dayone" aria-expanded="false" aria-controls="dayone">
                                    <h5>
                                        <span>Lesson 1:</span>  Python Introduction
                                    </h5>
                                </a>
                                <div id="dayone" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <p>
                                            Upon arrival, you’ll be greeted by your guide and
                                            transferred to your hotel. After settling in, you’ll attend
                                            an orientation meeting to go over the itinerary and meet
                                            your fellow travelers.

                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
                $('.course-data').append(course_data)
            },
            error: function(xhr) {
                console.error('Failed to fetch course details', xhr);
            }
        });
    });
</script>
@endsection