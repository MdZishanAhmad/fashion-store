<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>

    <title>Sign up</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link"> --}}
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="../assets/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="../assets/css/style-preset.css">

</head>
<style>
    .auth-main .auth-wrapper.v3 .auth-form:after {
        background-color: azure;
    }
</style>
<style>
    .auth-header {
        text-align: left;  /* Changed from center to left */
        padding: 1.5rem 0;
    }
    
    .auth-header .auth-logo {
        max-height: 60px;
        width: auto;
        object-fit: contain;
        margin: 0;  /* Removed auto margin */
        display: inline-block;  /* Changed from block to inline-block */
    }
    
    /* Add responsive adjustments */
    @media (max-width: 576px) {
        .auth-header .auth-logo {
            max-height: 30px;
        }
    }
    
    /* Add a subtle shadow to the logo */
    .auth-header .auth-logo {
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }
</style>
<style>
.btn:disabled {
    cursor: not-allowed;
    opacity: 0.7;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

/* Optional: Add a tooltip to show why the button is disabled */
.btn:disabled::after {
    content: "Please fill in at least one field";
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    padding: 5px 10px;
    background-color: #333;
    color: white;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.3s;
    pointer-events: none;
}

.btn:disabled:hover::after {
    opacity: 1;
}
</style>
<style>
/* Add to your existing styles */
input[name="phone"].is-invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

input[name="phone"]:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}
</style>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form"> 
                <div class="auth-header">
                    <a href="{{ route('user.index') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="auth-logo">
                    </a>
                </div>
                <div class="card my-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <h3 class="mb-0"><b>Sign up</b></h3>
                            <a href="{{route('login')}}" class="link-primary">Already have an account?</a>
                        </div>
                        <form action="{{ route('signup') }}" method="POST" id="registerForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Name*</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Full Name" value="{{ old('name') }}" required
                                            data-validate="required">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Email Address*</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email Address" value="{{ old('email') }}" required
                                    data-validate="required">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Phone Number*</label>
                                <input type="tel" 
                                       name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="Phone Number (10 digits)" 
                                       value="{{ old('phone') }}" 
                                       pattern="[0-9]{10}"
                                       maxlength="10"
                                       minlength="10"
                                       title="Please enter exactly 10 digits"
                                       required
                                       data-validate="required">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        @if($message == 'The phone field is required.')
                                            Please enter your phone number
                                        @elseif($message == 'The phone must be exactly 10 digits.')
                                            Phone number must be exactly 10 digits
                                        @elseif($message == 'The phone must be a number.')
                                            Phone number must contain only digits
                                        @else
                                            {{ $message }}
                                        @endif
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Password*</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    value="{{ old('password') }}" required
                                    data-validate="required">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Confirm Password*</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Confirm Password" required
                                    data-validate="required">
                                    @error('password_confirmation')
                                              <div class="invalid-feedback">{{$message}}</div>
                                              
                                            @enderror
                            </div>

                            <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#"
                                    class="text-primary"> Terms of Service </a> and <a href="#"
                                    class="text-primary">
                                    Privacy Policy</a></p>
                            <div class="d-grid mt-3">
                                <input type="submit" class="btn btn-primary" id="submitBtn" value="Create Account" />
                            </div>
                        </form>

                        {{-- <div class="auth-footer row">
                            <div class="col my-1">
                                <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
                            </div>
                            <div class="col-auto my-1">
                                <ul class="list-inline footer-link mb-0">
                                    <li class="list-inline-item"><a href="#">Home</a></li>
                                    <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                                    <li class="list-inline-item"><a href="#">Contact us</a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="../assets/js/plugins/popper.min.js"></script>
    <script src="../assets/js/plugins/simplebar.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/fonts/custom-font.js"></script>
    <script src="../assets/js/pcoded.js"></script>
    <script src="../assets/js/plugins/feather.min.js"></script>

    <script>
        layout_change('light');
    </script>

    <script>
        change_box_container('false');
    </script>

    <script>
        layout_rtl_change('false');
    </script>

    <script>
        preset_change("preset-1");
    </script>

    <script>
        font_change("Public-Sans");
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registerForm');
        const submitBtn = document.getElementById('submitBtn');
        const requiredFields = form.querySelectorAll('input[required]');

        // Function to check if all required fields are empty
        function checkEmptyFields() {
            let allEmpty = true;
            requiredFields.forEach(field => {
                if (field.value.trim() !== '') {
                    allEmpty = false;
                }
            });
            return allEmpty;
        }

        // Phone number validation
        const phoneInput = document.querySelector('input[name="phone"]');
        
        // Only allow numbers
        phoneInput.addEventListener('input', function(e) {
            // Remove any non-digit characters
            this.value = this.value.replace(/\D/g, '');
            
            // Limit to 10 digits
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }
        });

        // Validate phone number on blur
        phoneInput.addEventListener('blur', function() {
            if (this.value.length !== 10) {
                this.classList.add('is-invalid');
                const feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.textContent = 'Phone number must be exactly 10 digits';
                }
            } else {
                this.classList.remove('is-invalid');
            }
        });

        // Update form validation to include phone number check
        function validateForm() {
            const allEmpty = checkEmptyFields();
            const phoneValid = phoneInput.value.length === 10;
            
            submitBtn.disabled = allEmpty || !phoneValid;
            
            if (allEmpty || !phoneValid) {
                submitBtn.classList.add('btn-secondary');
                submitBtn.classList.remove('btn-primary');
            } else {
                submitBtn.classList.add('btn-primary');
                submitBtn.classList.remove('btn-secondary');
            }
        }

        // Add input event listener for phone
        phoneInput.addEventListener('input', validateForm);

        // Form submission handler
        form.addEventListener('submit', function(e) {
            if (checkEmptyFields() || phoneInput.value.length !== 10) {
                e.preventDefault();
                if (phoneInput.value.length !== 10) {
                    alert('Please enter exactly 10 digits for the phone number.');
                } else {
                    alert('Please fill in at least one field to proceed.');
                }
            }
        });
    });
    </script>
</body>
<!-- [Body] end -->

</html>