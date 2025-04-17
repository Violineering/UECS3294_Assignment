<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://rsms.me/inter/inter-ui.css" rel="stylesheet">
    <style>
    ::selection {
        background: #333;
        color: white;
    }
    ::-webkit-selection {
        background: #333;
        color: white;
    }
    ::-moz-selection {
        background: #333;
        color: white;
    }

    body.profile-page {
        background-color: #f5f0eb;
        font-family: 'Inter UI', sans-serif;
        color: #000000;
        padding-top: 0;
    }

    .profile-page .profile-container {
        max-width: 700px;
        margin: 30px auto;
        padding: 40px;
        border-radius: 8px;
        background: #ffffff;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        border: 1px solid #cccccc;
    }

    .profile-page .profile-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 25px;
        border: 3px solid #cccccc;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .profile-page .profile-img:hover {
        transform: scale(1.05);
    }

    .profile-page .profile-container .form-control {
        border-radius: 0;
        padding: 8px 10px;
        border: 0;
        border-bottom: 1px solid #cccccc;
        background: transparent;
        color: #000000;
        transition: border-color 0.3s ease;
    }

    .profile-page .profile-container .form-control:focus {
        border-bottom-color: #000000;
        box-shadow: none;
        background: transparent;
    }

    .profile-page .readonly-email {
        background-color: #eeeeee;
        cursor: not-allowed;
        border-bottom: 1px solid #cccccc;
        color: #666666;
    }

    .profile-page .password-toggle {
        cursor: pointer;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #666666;
    }

    .profile-page .password-section {
        background: #f5f5f5;
        padding: 25px;
        border-radius: 8px;
        margin-top: 30px;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #cccccc;
    }

    .profile-page .profile-container h2 {
        color: #000000;
        font-weight: 900;
        margin-bottom: 30px;
        font-size: 28px;
    }

    .profile-page .btn-primary {
        background-color: #000000;
        border-color: #000000;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
</head>
<body class="profile-page">

@include('includes.adminSideBar')
<div class = "profile-page">
    <div class="container">
        <div class="profile-container">
            <h2 class="mb-4">Admin Profile</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="text-center mb-4">
                @if($users->profile_image)
                    <img src="{{ asset('storage/' . $users->profile_image) }}" 
                        class="profile-img" 
                        alt="Profile Picture">
                @else
                    <img src="{{ asset('storage/profile_pic/default_profile_pic.jpg') }}" 
                        class="profile-img" 
                        alt="Default Profile">
                @endif
            </div>

            <form method="POST" action="{{ route('auth.profile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                        value="{{ old('name', $users->name) }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control readonly-email" id="email" 
                        value="{{ $users->email }}" readonly>
                    <small class="form-text">Contact support to change your email</small>
                </div>

                <div class="mb-4">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image"
                        accept="image/jpeg, image/png, image/jpg, image/gif">
                    <div class="form-text">Max 2MB. JPG, PNG, or GIF.</div>
                    @if($users->profile_image)
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" 
                                id="remove_image" name="remove_image" value="1">
                            <label class="form-check-label" for="remove_image">
                                Remove current profile image
                            </label>
                        </div>
                    @endif
                </div>

                <div class="password-section">
                    <h5 class="mb-3">Change Password (optional)</h5>

                    <div class="mb-4 position-relative">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" 
                            name="current_password">
                        <i class="bi bi-eye-slash password-toggle" 
                        onclick="togglePassword('current_password')"></i>
                        <div class="form-text">Required only if changing password</div>
                    </div>

                    <div class="mb-4 position-relative">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" 
                            name="new_password">
                        <i class="bi bi-eye-slash password-toggle" 
                        onclick="togglePassword('new_password')"></i>
                    </div>

                    <div class="mb-4 position-relative">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" 
                            name="new_password_confirmation">
                        <i class="bi bi-eye-slash password-toggle" 
                        onclick="togglePassword('new_password_confirmation')"></i>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = input.nextElementSibling;
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    }
</script>
</body>
</html>
