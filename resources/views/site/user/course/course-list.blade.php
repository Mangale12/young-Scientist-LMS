@extends('site.layout.student')
@section('css')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@endsection
@section('content')
@include('site.includes.user.sidebar')
@include('site.includes.user.nav')

<section class="container mt-4">
    <h2 class="text-center mb-4">Course List</h2>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Available Courses</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="courseTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course Title</th>
                        <th scope="col">Course Thumbnail</th>
                        <th scope="col">Unique ID</th>
                        <th scope="col">School</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="course-tbody">
                    <!-- Data will be populated here dynamically -->
                </tbody>
            </table>
        </div> <!-- End of card-body -->
    </div> <!-- End of card -->
</section>


<!-- Modal for Assignments -->
<div class="modal fade" id="assignmentsModal" tabindex="-1" aria-labelledby="assignmentsModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignmentsModalLabel">Assignments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="assignmentTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Assignment</th>
                            <th>Chapter</th>
                            <th>Topic</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="assignmentTbody">
                        <!-- Assignments will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for submitted list -->
<div class="modal fade" id="assignmentSubmitModal" tabindex="-1" aria-labelledby="assignmentSubmitModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 140%">
            <div class="modal-header">
                <h5 class="modal-title" id="assignmentSubmitModalLabel">Assignments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="assignmentSubmitTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Course Title</th>
                            <th>Chapter</th>
                            <th>Submitted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="assignmentSubmitTbody">
                        <!-- Assignments will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Teacher feedback form -->
<div class="modal fade" id="teacherFeedbackModal" tabindex="-1" aria-labelledby="teacherFeedbackModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 140%">
            <div class="modal-header">
                <h5 class="modal-title" id="teacherFeedbackModalLabel">Assignments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{Route::has($route.'.feedback') ? route($route.'.feedback') : ''}} " enctype="multipart/form-data" class="teacher-feedback" id="teacherFeedbackForm">
                   @csrf
                    <div class="form-group">
                      <label for="feedback-file">File</label>
                      <input type="file" class="form-control-file form-control" name="feedback_file" id="feedback-file">
                    </div>
                    <div class="form-group">
                        <label for="description">Feedback</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                      </div>
                  </form>
            </div>
        </div>
    </div>
</div>




@endsection

@section('scripts')
<!-- Add any additional scripts here -->
<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    // Your API endpoint
    var schoolId = null;
    var url = '{{ route($route . ".courses") }}';
    
    $.ajax({
        url: url, // API endpoint to fetch courses
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token for protection
        },
        success: function(response) {
            if (response.courses.length === 0) {
                $(".course-tbody").html("<tr><td colspan='5' class='text-center'>No courses available</td></tr>");
                return;
            }

            // Clear existing rows
            $(".course-tbody").empty();

            // Loop through the courses and populate the table
            response.courses.forEach(function(course, index) {
                var courseRow = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${course.course_title}</td>
                        <td>${course.course_description}</td>
                        <td>${course.unique_id}</td>
                        <td>${course.school.name}</td>
                        <td>
                            <button class="btn btn-primary view-assignments-btn" data-course-id="${course.unique_id}" data-school-id="${course.school.id}">View Assignments</button>
                        </td>
                    </tr>
                `;
                // Append the course row to the table body
                $(".course-tbody").append(courseRow);

            });

            // Initialize DataTable after dynamically populating the table
            $('#courseTable').DataTable({
                responsive: true,
                pageLength: 10, // Set the default page length
            });
        },
        error: function(xhr, status, error) {
            console.error("Error loading courses:", error);
            alert("Error loading courses. Please try again.");
        }
    });    
    // Event Listener for "View Assignments" Button
    $(document).on('click', '.view-assignments-btn', function () {
        var courseId = $(this).data('course-id');
        schoolId = $(this).data('school-id');
        fetchAssignments(courseId);
    });
    $(document).on('click', '.view-assignment-submit-btn', function (){
        var assignmentId = $(this).data('assignment-id');
        var courseId = $(this).data('course-id');
        $('#assignmentSubmitModal').modal('show');
        fetchAssignmentSubmits(schoolId, courseId, assignmentId);
    });
    $(document).on('click', '.teacher-feedback-btn', function (e){
        e.preventDefault();
        var assignmentId = $(this).data('assignment-id');
        var courseId = $(this).data('course-id');
        var studentId = $(this).data('student-id');
        var assignmentSubmissionId = $(this).data('id');
        $('#teacherFeedbackModal').modal('show');

        // Feedback form submission
        $('#teacherFeedbackForm').off('submit').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('school_id', schoolId);
            formData.append('course_id', courseId);
            formData.append('assignment_id', assignmentId);
            formData.append('assignment_submission_id', assignmentSubmissionId);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log("Feedback submitted successfully");
                    $('#teacherFeedbackModal').modal('hide');
                    alert("Feedback submitted successfully!");
                },
                error: function (xhr) {
                    console.error("Failed to submit feedback", xhr.responseText);
                    alert("Error submitting feedback. Please try again.");
                }
            });
        });
    })

    // Fetch Assignments
    function fetchAssignments(courseId) {
        var url = '{{ route($route . ".course.assignments", ":course_id") }}'
                        .replace(':course_id', courseId);
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                // Clear previous assignments
                $('#assignmentTbody').empty();
                
                // Populate assignments in the modal
                if (response.assignments.length > 0) {
                    response.assignments.forEach((assignment, index) => {
                        $('#assignmentTbody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${assignment.description}</td>
                                <td>title</td>
                                <td>topic</td>
                                <td>
                                    <button class="btn btn-primary view-assignment-submit-btn" data-course-id="${courseId}" data-assignment-id="${assignment.id}">Submitted List</button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#assignmentTbody').append(`
                        <tr>
                            <td colspan="4" class="text-center">No assignments available for this course.</td>
                        </tr>
                    `);
                }

                // Show the modal
                $('#assignmentsModal').modal('show');
            },
            error: function (xhr) {
                console.error("Failed to fetch assignments", xhr.responseText);
                $('#assignmentTbody').append(`
                        <tr>
                            <td colspan="4" class="text-center">Error fetching assignments. Please try again..</td>
                        </tr>
                    `);
                alert("Error fetching assignments. Please try again.");
            },
        });
    }
    

    function fetchAssignmentSubmits(schoolId, courseId, assignmentId){
        var url = '{{ route($route . ".assignment.submits", [":school_id",":course_id", ":assignment_id"]) }}'
                        .replace(':school_id', schoolId)
                        .replace(':course_id', courseId)
                        .replace(':assignment_id', assignmentId);

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                // Clear previous submissions
                $('#assignmentSubmitTbody').empty();
                
                // Populate submissions in the modal
                if (response.submitted_assignments.length > 0) {
                    response.submitted_assignments.forEach((submit, index) => {
                        $('#assignmentSubmitTbody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${submit.student_name}</td>
                                <td>${submit.course_title}</td>
                                <td>${submit.chapter_title}</td>
                                <td>${submit.submitted_at}</td>
                                <td>
                                    <a href="${submit.file_path}" class="btn btn-primary" target="_blank">Download</a>
                                    <a class="btn btn-primary teacher-feedback-btn" data-id="${submit.id}" data-student-id="${submit.student_id}" data-assignment-id="${assignmentId}">Feedback</a>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#assignmentSubmitTbody').append(`
                        <tr>
                            <td colspan="4" class="text-center">No submissions available for this assignment.</td>
                        </tr>
                    `);
                }
                // Show the modal
            },
            error: function (xhr) {
                console.error("Failed to fetch assignment submissions", xhr.responseText);
                alert("Error fetching assignment submissions. Please try again.");
                $('#assignmentSubmitTbody').append(`
                        <tr>
                            <td colspan="4" class="text-center">Error fetching assignment submissions. Please try again.</td>
                        </tr>
                    `);
            },
        });

        
    }
});

</script>
@endsection
  
  