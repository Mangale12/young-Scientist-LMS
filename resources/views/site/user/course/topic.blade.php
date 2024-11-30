@extends('site.layout.student')
@section('content')
@include('site.includes.user.sidebar')
@include('site.includes.user.nav')
<style>
  .lesson-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
  padding: 10px;
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  margin-bottom: 5px;
}

.lesson-content {
  padding: 10px 20px;
  background-color: #fff;
  border-left: 2px solid #ddd;
}

.arrow {
  font-weight: bold;
  margin-right: 10px;
}

.lesson-info {
  font-size: 12px;
  color: #777;
}
.topic-link.active {
    font-weight: bold;
    color: #007bff; /* Highlighted color */
}

.lesson.active-chapter {
    background-color: #f8f9fa; /* Highlighted background */
}

.scrollable-content {
  overflow-y: auto;
  padding: 15px;
}

.info-card {
  padding: 20px;
  border-left: 1px solid #ddd;
  background: #fff;
}

.assignment-section {
  margin-top: 20px;
}

.assignment-description {
  margin-bottom: 20px;
  background: #f9f9f9;
  border: 1px solid #ddd;
  padding: 15px;
  border-radius: 5px;
}

.form-label {
  font-weight: bold;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0056b3;
  border-color: #004085;
}


</style>
<div class="d-flex">
    <!-- Course Sections -->
    <div id="course-sections" class="scrollable-content" style="height: 100%; width: 37%; padding: 15px; border-right: 1px solid #ddd;">
      <p>Loading...</p>
    </div>
  
    <!-- Info Card Section -->
    <div class="info-card" style="margin: 0; width: 63%; padding: 20px;">
      <!-- Topic Details -->
      <div id="topic-details">
        <h3 style="margin-bottom: 20px;">Select a topic to view its details</h3>
      </div>
  
      <!-- Assignment Section -->
      <div class="assignment-section" style="margin-top: 30px;">
        
      </div>
    </div>
  </div>
  

@endsection
@section('scripts')
<script>
  
  $(document).ready(function () {
    function initializeExpandCollapse() {
        $('.lesson-header').off('click').on('click', function () {
            $(this).siblings('.lesson-content').slideToggle();
            $(this).find('.arrow').text(function (i, oldText) {
                return oldText === '►' ? '▼' : '►';
            });
        });
    }

    // Function to fetch topic details and update UI
    function initializeTopicLinks(url, course_id = null, chapter_id = null, topic_id = null) {
        // Prevent default link behavior
        let assignmentSection = '';
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                if (!response.topic) {
                    console.error('Topic not found');
                    return;
                }

                // Update topic details
                $('#topic-details').html(`
                    <h3>${response.topic.title}</h3>
                    <button class="prev-button">⬅ Previous</button>
                    <p>${response.topic.description}</p>
                `);

                if (response.topic.assignment) {
                    assignmentSection += `
                        <h4>Assignment for Topic: ${response.topic.title}</h4>
                        <div class="assignment-description" style="margin-bottom: 20px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #f9f9f9;">
                            <p><strong>Description:</strong> ${response.topic.assignment.description || 'No description provided.'}</p>
                        </div>
                        <!-- Assignment Upload Section -->
                        <form id="assignment-upload-form-${response.topic.unique_id}" enctype="multipart/form-data" style="margin-top: 20px;" class="assignment-upload-form">
                            @csrf
                            <div class="mb-3">
                                <label for="assignment-file-${response.topic.unique_id}" class="form-label"><strong>Upload Assignment</strong></label>
                                <input type="file" id="assignment-file-${response.topic.unique_id}" name="assignment_file" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="assignment-notes-${response.topic.unique_id}" class="form-label"><strong>Additional Notes</strong> (Optional)</label>
                                <textarea id="assignment-notes-${response.topic.unique_id}" name="assignment_notes" class="form-control" rows="3" placeholder="Add any additional notes or comments"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Assignment</button>
                        </form>`;
                } else {
                    assignmentSection += '<p>No assignments available for this course.</p>';
                }

                // Append assignment section (or a default message if no assignments exist)
                $('.assignment-section').html(assignmentSection);

                // Highlight active topic
                $('.topic-link').removeClass('active'); // Remove active class from all topics
                $(`[data-topic-id="${topic_id}"]`).addClass('active'); // Add active class to the current topic

                // Highlight active chapter
                $('.lesson').removeClass('active-chapter'); // Remove active class from all chapters
                $(`[data-chapter-id="${chapter_id}"]`).closest('.lesson').addClass('active-chapter');

                // Attach submit event listener to the dynamically added form
                $('.assignment-upload-form').on('submit', function (event) {
                    event.preventDefault();

                    let form = $(this);
                    let formData = new FormData(this); // Get the form data

                    // Append the topic's unique ID to the form data
                    formData.append('topic_id', topic_id);
                    formData.append('chapter_id', chapter_id);
                    formData.append('course_id', course_id);

                    // Send the POST request
                    $.ajax({
                        url: "{{route($route.'.assignment-submision')}}",
                        type: 'POST',
                        data: formData,
                        contentType: false, // Required for file uploads
                        processData: false, // Prevent jQuery from processing the data
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token for Laravel
                        },
                        success: function (response) {
                            if (response.success) {
                                alert('Assignment submitted successfully!');
                                form[0].reset(); // Reset the form on success
                            } else {
                                alert(`Error: ${response.message}`);
                            }
                        },
                        error: function (xhr) {
                            let errors = xhr.responseJSON?.errors;
                            if (errors) {
                                let errorMessage = Object.values(errors).flat().join('\n');
                                alert(`Validation Error:\n${errorMessage}`);
                            } else {
                                alert('An error occurred while submitting your assignment. Please try again.');
                            }
                        },
                    });
                });
            },
            error: function (xhr) {
                console.error('Failed to fetch topic details', xhr);
            }
        });
    }


    var course_id = "{{$course_id}}";
    var chapter = "{{$chapter_id}}";
    var topic = "{{$topic_id}}";
    var topicUrl = `{{ route('site.student.topic-details', ['course_id' => ':course_id', 'chapter_id'=>':chapter_id', 'topic_id' => ':topic_id']) }}`
                                        .replace(':course_id', course_id)
                                        .replace(':chapter_id', chapter)
                                        .replace(':topic_id', topic);
    initializeTopicLinks(topicUrl, course_id, chapter, topic);
    var activeTopicId = null; // Update based on the current topic

    $.ajax({
        url: `{{ route('site.student.course-details', ':unique_id') }}`.replace(':unique_id', course_id),
        type: 'GET',
        success: function (response) {
            if (!response.course) {
                $('#course-sections').html('<p>No course data available.</p>');
                return;
            }

            // Set course title and description
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
                    topicUrl = `{{ route('site.student.topic-details', ['course_id' => ':course_id', 'chapter_id'=>':chapter_id', 'topic_id' => ':topic_id']) }}`
                                            .replace(':course_id', course_id)
                                            .replace(':chapter_id', chapter_id)
                                            .replace(':topic_id', topic.unique_id);
                        courseSections += `
                            <div class="lesson">
                                <div class="lesson-header">
                                    <i class="fa-solid fa-book"></i>
                                    <a class="topic-link" data-url="${topicUrl}" data-topic-id="${topic.unique_id}" data-chapter-id="${chapter.id}"  style="text-decoration: none; color: black;">
                                        <span style="margin-left: -20rem; position: relative;">${topic.title}</span>
                                    </a>
                                </div>
                            </div>`;
                            // Add assignment details if available
                
                            
                    });

                    courseSections += `</div></div>`;
                });

                courseSections += `</div>`;
                 
                
            }

            // Append generated HTML to the course sections container
            $('#course-sections').html(courseSections);
            
            // Attach expand/collapse functionality
            initializeExpandCollapse();
            
            // Attach click event for topics
        },
        error: function (xhr) {
            console.error('Failed to fetch course details', xhr);
        }
    });

    $(document).on('click', '.topic-link', function (e) {
        e.preventDefault();
        topicUrl = $(this).data('url');
        
        initializeTopicLinks(topicUrl, course_id, $(this).data('chapter-id'), $(this).data('topic-id'));
    });

});


</script>
  
@endsection