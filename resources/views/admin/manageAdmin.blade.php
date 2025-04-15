<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        .userslist {
            margin-left: 300px; /* Default when sidebar is open */
            padding: 20px;
            transition: margin-left 0.3s ease;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* When Sidebar is Collapsed */
        .sidebar.collapsed ~ .userslist {
            margin-left: 90px; 
            width: calc(100% - 90px); /* Expand content width */
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        table {
            width: max-content;
            min-width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        th, td {
            white-space: nowrap;
        }

        /* Table Header */
        thead {
            background-color:rgb(119, 115, 111);
        }

        thead th {
            text-align: center;
            padding: 12px;
            font-weight: bold;
            border-bottom: 2px solid #dee2e6;
            color: white;
        }

        thead tr:hover {
            background-color: inherit;
        }

        /* Table Rows */
        tr {
            border-bottom: 1px solid #dee2e6;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Table Data */
        td {
            padding: 10px;
            text-align: left;
        }

        td:nth-child(1), 
        td:nth-child(2), 
        td:nth-child(5) {
            text-align: center;
        }

        /* Dropdown Container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Action Button */
        .actionBtn {
            background-color: #ffc107;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .actionBtn:{
            background-color:rgb(190, 145, 10);
        }

        /* Dropdown Content*/
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 100px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 1;
        }

        /* Dropdown Links */
        .dropdown-content a {
            color: black;
            padding: 8px 12px;
            text-decoration: none;
            display: block;
        }

        /* Hover Effects */
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .pagination .page-item {
            display: inline-block;
            margin: 0 2px; 
        }

        .pagination .page-link {
            padding: 5px 8px;  
            font-size: 12px;  
            border-radius: 3px;
            text-decoration: none;
            background-color:rgba(245, 245, 245);
            color: black;
            border: 1px solid rgba(245, 245, 245);
        }

        .pagination .page-link:hover {
            background-color: rgb(209, 209, 209);
            border: 1px solid rgb(209, 209, 209);
        }

        .pagination .page-item.active .page-link {
            background-color:rgb(163, 163, 163);
            font-weight: bold;
        }

        #modalOverlay{
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background: rgba(0, 0, 0, 0.5); 
            z-index: 1000; display: flex;
            align-items: center; 
            justify-content: center;
        }

</style>

</head>
<body>

@include('includes.adminSideBar')

<div class="userslist">
        <div class= "title">
            <h1>Manage Admin</h1>
        </div>
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>Admin ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="actionBtn" onclick="toggleDropdown(this)">Action ▼</button>
                                <div class="dropdown-content">
                                    <a href="#" onclick="openModal({{ $user->id }})">Update</a>
                                    <a href =#>Delete</a>
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}" width="50" height="50" alt="Profile Image">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <span>
            {{$users->links('pagination::bootstrap-4')}}
        </span>
</div>


<div id="editModal" style="display: {{ $errors->any() ? 'block' : 'none' }};">
    <div id="modalOverlay" style="display: {{ $errors->any() ? 'flex' : 'none' }};">
        <div style="background: white; padding: 20px; border-radius: 8px; min-width: 300px; position: relative;">
            <h3>Update Admin</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.profile.update') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name', $user->name) }}" required>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control readonly-email" id="email" 
                           value="{{ $user->email }}" readonly>
                    <small class="form-text">Contact support to change your email</small>
                </div>
                
                <div class="mb-4">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image"
                           accept="image/jpeg, image/png, image/jpg, image/gif">
                    <div class="form-text">Max 2MB. JPG, PNG, or GIF.</div>
                    @if($user->profile_image)
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
                    <button type="button" onclick="closeModal()">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    @if(session('success'))
        window.onload = function() {
            alert("{{ session('success') }}");
        };
    @endif

    function toggleDropdown(button) {
        var dropdownContent = button.nextElementSibling;

        // Close other dropdowns
        document.querySelectorAll(".dropdown-content").forEach(menu => {
            if (menu !== dropdownContent) {
                menu.style.display = "none";
            }
        });

        // Toggle current dropdown
        dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    }

    // Close dropdown when clicking outside
    document.addEventListener("click", function(event) {
        if (!event.target.matches(".actionBtn")) {
            document.querySelectorAll(".dropdown-content").forEach(menu => {
                menu.style.display = "none";
            });
        }
    });

    function openModal(userId) {
        document.getElementById("editModal").style.display = "block";
        document.getElementById("modalOverlay").style.display = "flex";

        const form = document.getElementById("editAdminForm");
        form.action = "/admin/manageAdmin/" + userId;

        document.getElementById("adminId").value = userId;

        // Optionally pre-fill form (AJAX or pass data inline)
    }

    // Close Modal Function
    function closeModal() {
        document.getElementById("editModal").style.display = "none";
    }
</script>

</body>
</html>

