@extends('site.layout.student')
@section('content')
@include('site.includes.user.sidebar')
@include('site.includes.user.nav')


<div class="banner-inner position-relative">
    <img class="banner-img" src="{{asset('images/cover-image.png')}}" alt="img">
    <section class="group-member">
        <div class="container">
            <div class="group-profile d-flex align-items-center">
                <img src="{{asset('images/profile.png')}}" alt="">
                <div class="ms-4">
                    <h2 class="text-white course-title"></h2>
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
                <li><a class="active text-dark" href="course.html">Course</a></li>
            </ul>
        </nav>
    </div>
</section>

<section class="courses  py-4">
    <div class="container">

        <div class="row">

            <div class="col-lg-8">
                <div class="courses__details ">
                    <h2 class="pb-3 course-title" ></h2>
                    
                    <div class="itinery">
                        <p class="course-description">description</p>

                        <div class="course-container" >
                            <h4 class="pb-3" >
                                Course Content
                                <button id="expand-collapse-btn" class="expand-btn" style="margin-left: 480px;
                                margin-top: -27px; font-size: 18px; color: black;">
                                    <span style="color: black;">Expand All</span> <i class="fas fa-angle-down"></i>
                                </button>
                            </h4>
                            <div id="course-title"></div>
                            
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="courses-sidebar border  sticky-top z-0 rounded-2 overflow-hidden  " style="top: 110px;">
                    <div class="profile">
                        <img class="w-100 " src="{{asset('images/PictoBlox_Python-1.png')}}" alt="">
                    </div>
                    <div class="p-4">
                        <a class="btn btn-start py-2 px-4 w-100 rounded-5 bg-primary text-white fw-bold"
                            href="#">Start Course</a>
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
@include('site.includes.user.footer')

@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        var course_id = "{{$unique_id}}";
        var topic_id = null;
        // Fetch course details via AJAX
        $.ajax({
            url: `{{route($route.'.course-details', ':unique_id')}}`.replace(':unique_id', course_id),
            type: 'GET',
            success: function (response) {
                if (!response.course) {
                    $('#course-sections').html('<p>No course data available.</p>');
                    return;
                }

                // Set course title
                $('.course-title').html(response.course.title);
                $('.course-description').html(response.course.description);
                // Build course sections
                let courseSections = '';
                const chapters = response.course.chapter;

                // Group chapters by category
                const groupedChapters = chapters.reduce((acc, chapter) => {
                    const category = chapter.chapter_category_id ? chapter.chapter_category.name : 'Uncategorized';
                    if (!acc[category]) acc[category] = [];
                    acc[category].push(chapter);
                    return acc;
                }, {});

                // Generate HTML for each category
                for (const [categoryName, categoryChapters] of Object.entries(groupedChapters)) {
                    courseSections += `<h5 class="pb-3" style="font-weight: bold;">${categoryName}</h5>`;
                    courseSections += `<div class="course-section">`;

                    // Generate HTML for each chapter
                    categoryChapters.forEach(chapter => {
                        const chapter_id = chapter.unique_id;
                        courseSections += `
                            <div class="lesson">
                                <div class="lesson-header">
                                    <span class="arrow">►</span>
                                    <a href="#" style="text-decoration: none; color: black; cursor: pointer; margin-right: 70px;">
                                        ${chapter.title}
                                    </a>
                                    <div class="lesson-info">${chapter.topics.length} Topics</div>
                                </div>
                                <div class="lesson-content" style="display: none;">`;

                        // Generate HTML for each topic
                        chapter.topics.forEach(topic => {
                            topic_id = topic.unique_id;
                            const topicUrl = `{{ route($route.'.topic-details', ['course_id' => ':course_id', 'chapter_id' => ':chapter_id', 'topic_id' => ':topic_id']) }}`
                                                .replace(':course_id', course_id)
                                                .replace(':chapter_id', chapter_id)
                                                .replace(':topic_id', topic_id);
                            courseSections += `
                                <div class="lesson">
                                    <div class="lesson-header">
                                        <i class="fa-solid fa-book"></i>
                                        <a href="${topicUrl}" style="text-decoration: none; color: black;">
                                            <span style="margin-left: -443px;">${topic.title}</span>
                                        </a>
                                    </div>
                                </div>`;
                        });

                        courseSections += `</div></div>`;
                    });

                    courseSections += `</div>`;
                }

                // Append generated HTML to the course sections container
                $('#course-title').html(courseSections);

                // Attach expand/collapse functionality
                initializeExpandCollapse();
            },
            error: function (xhr) {
                console.error('Failed to fetch course details', xhr);
            }
        });

        function initializeExpandCollapse() {
            // Toggle individual lesson expand/collapse
            $('.lesson-header').on('click', function () {
                const content = $(this).next('.lesson-content');
                const arrow = $(this).find('.arrow');

                // Toggle visibility
                const isVisible = content.is(':visible');
                content.slideToggle(300);
                arrow.text(isVisible ? '►' : '▼');
            });

            // Expand/Collapse All
            $('#expand-collapse-btn').on('click', function () {
                const isExpanded = $(this).data('expanded');
                $(this).data('expanded', !isExpanded);

                const newLabel = isExpanded
                    ? 'Expand All <i class="fas fa-angle-down"></i>'
                    : 'Collapse All <i class="fas fa-angle-up"></i>';
                $(this).html(newLabel);

                $('.lesson-content').each(function () {
                    const arrow = $(this).prev('.lesson-header').find('.arrow');
                    if (isExpanded) {
                        $(this).slideUp(300);
                        arrow.text('►');
                    } else {
                        $(this).slideDown(300);
                        arrow.text('▼');
                    }
                });
            });
        }
    });
</script>



@endsection