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
                        Welcome back, {{auth()->user()->name}}
                    </h4>
                    <p class="fs-5 fw-500">@if(auth()->user()->role === 'student') Class 7 Student @endif <small class="fs-6">
                        <i class="fa-solid fa-circle text-primary"></i> Active</small>
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

                    <div class="row justify-content-center g-4 courses-container">
                        
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




    @endsection

    @section('scripts')
    <script>1
        $(document).ready(function(){
            const courseDetailsRoute = "{{ route('site.student.course-details', ':unique_id') }}";
            function courseChapterCount(courseId) {
                var count = 0;
                // Dynamically construct the URL using the course ID
                let url = `{{ route('site.student.course-chapter-count', ':id') }}`.replace(':id', courseId);

                $.ajax({
                    url: url,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $(`.chapter-count-placeholder[data-course-id="${courseId}"]`).text(`${response} Lessons`);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching chapter count:", error);
                        $(`.chapter-count-placeholder[data-course-id="${courseId}"]`).text("No lessons available");
                    }
                });
                console.log("count out "+count);
                
                return count;
            }

                
            var url = '{{route("site.student.courses")}}'
            $.ajax({ 
             url: url, // Dynamic course ID in route
             type: "GET",
             headers: {
                 'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
             },
             success: function (response) {
                // Check if courses are available
                if (response.length === 0) {
                    $(".courses-container").html(`
                        <div class="col-12 text-center">
                            <p>No courses available at the moment.</p>
                        </div>
                    `);
                    return;
                }

                // Clear the container before appending new content
                $(".courses-container").empty();

                // Iterate through the response data
                response.school_grade_section.school_section_grade_courses.forEach(item => {
                   
                        if (!item.course) {
                            return `
                                <div class="col-12 text-center">
                                    <p>No course data available for this student.</p>
                                </div>`;
                        }
                        const courseUrl = courseDetailsRoute.replace(':unique_id', item.course.unique_id);
                        // Render course card
                        var courseDetails = `<div class="col-lg-3">
                                <div class="courses__details border">
                                    <a href="${courseUrl}">
                                        <img class="w-100" src="${item.course.thumbnail || '{{asset('images/default-thumbnail.png')}}'}" alt="${item.course.title || 'Course Thumbnail'}">
                                    </a>
                                    <div class="courses__details--content p-3">
                                        <span class="chapter-count-placeholder" data-course-id="${item.course.id}">Loading lessons...</span>
                                        <a class="d-block my-2" href="#">
                                            ${item.course.title || "Untitled Course"}
                                        </a>
                                        <p>
                                            Learn the basics of programming, coding structures, and more.
                                        </p>
                                        <progress class="w-100" id="file" value="32" max="100">32%</progress>
                                        <label for="file"><small>32% Complete</small></label>
                                    </div>
                                </div>
                            </div>`;
                    // Append the generated course cards to the container
                    $(".courses-container").append(courseDetails);
                    courseChapterCount(item.course.id)
                });
            },

            error: function (xhr, status, error) {
                console.error("Failed to load Course:", error);
                alert("Error loading courses. Please try again.");
            }

          });
        });
    </script>
    @endsection



   




    