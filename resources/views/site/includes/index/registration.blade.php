<div class="modal fade login-modals" id="registerForm" tabindex="-1" aria-labelledby="registerFormLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content position-relative-content">

        <div class="modal-header">
            <h1 class="modal-title fs-5 fw-bold w-100" id="exampleModalLabel">
                <button class="btn submit-btn active" id="studentButton">Student Registration</button>
                <button class="btn submit-btn" id="teacherButton">Teacher Registration</button>
            </h1>

            <button type="button" class="btn-close close-btn-right" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>

        <!-- Student Registration Form -->
        <!-- Student Registration Form -->
        <div class="modal-body" id="student-registration">
            <form id="studentForm">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="name" placeholder="Student Name">
                    </div>
                    <div class="col-lg-6">
                        <input type="number" class="form-control" name="student_id" placeholder="Student ID">
                    </div>
                    <div class="col-lg-6">
                        <input type="email" class="form-control" name="email" placeholder="Student Email">
                    </div>
                    <!-- Add other input fields as needed -->
                    <div class="col-lg-6">
                        <select name="school_id" id="school-id" class="form-control">
                            <option value="">Select School</option>
                            @foreach ($data['schools'] as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <select name="grade_id" id="grade-id" class="form-control">
                            <option value="">Select Grade</option>
                            @foreach ($data['grades'] as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <select name="section_id" id="section-id" class="form-control">
                            <option value="">Select Section</option>
                            @foreach ($data['sections'] as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="dob" class="form-control" id="dateOfBirth" placeholder="Date of Birth"
                            onfocus="(this.type='date')" onblur="(this.type='text')">
                    </div>

                    <div class="col-lg-6">
                        <input type="text" name="address" class="form-control" placeholder="Address">
                    </div>
                    <div class="col-lg-6">
                        <input type="number" name="parent_phone" class="form-control" placeholder="Parents Phone Number">
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="parent_email" class="form-control" placeholder="Parents Email">
                    </div>
                    <div class="col-lg-6">
                        <input type="password" name="password" class="form-control" placeholder="Your Password">
                    </div>
                    <div class="col-lg-6">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <button type="submit" class="btn w-100 submit-btn">Sign Up</button>
                        </div>
                        <!-- Error Display -->
                        <div id="error-messages" style="color: red;"></div>
                    </div>
                </div>
            </form>
        </div>

        

        <!-- Teacher Registration Form -->
        <div class="modal-body" id="teacher-registration" style="display: none;">
            <form id="teacherForm">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <input type="text" id="teacherName" name="name" class="form-control" placeholder="Teacher Name">
                        <span class="text-danger error-message" id="teacherNameError"></span>
                    </div>
                    <div class="col-lg-6">
                        <input type="number" id="teacherID" name="teacher_id" class="form-control" placeholder="Teacher ID">
                        <span class="text-danger error-message" id="teacherIDError"></span>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="teacherEmail" name="email" class="form-control" placeholder="Teacher Email">
                        <span class="text-danger error-message" id="teacherEmailError"></span>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="subjectExpert" name="subject_expert" class="form-control" placeholder="Subject Expert">
                        <span class="text-danger error-message" id="subjectExpertError"></span>
                    </div>
                    <div class="col-lg-6">
                        <input type="number" id="phoneNumber" name="phone" class="form-control" placeholder="Phone Number">
                        <span class="text-danger error-message" id="phoneNumberError"></span>
                    </div>
                    <div class="col-lg-6">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Your Password">
                        <span class="text-danger error-message" id="passwordError"></span>
                    </div>
                    <div class="col-lg-6">
                        <input type="password" id="confirmPassword" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        <span class="text-danger error-message" id="confirmPasswordError"></span>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <button type="submit" class="btn w-100 submit-btn">Sign Up</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
</div>

