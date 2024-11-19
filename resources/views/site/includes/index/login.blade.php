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
                            <form id="loginForm" method="POST" action="{{ route('login') }}">
                                @csrf
                            <div id="loginError" class="text-danger" style="display: none;"></div>

                                <div class="mb-4">
                                    <input type="email" name="email" class="form-control" id="username-email" name="username" placeholder="Username / Email">
                                </div>
                                <div class="mb-2">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="mb-2 d-flex justify-content-end">
                                    <a class="forget-password" href="#">Forgot Password?</a>
                                </div>
                                <div class="mb-4">
                                    <button type="button" id="loginButton" class="btn w-100 submit-btn">Sign in</button>
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