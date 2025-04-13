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
                                    <a href = #  onclick="openModal({{ $ContactForm->id }})">Update</a>
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

        <span>
            {{$users->links('pagination::bootstrap-4')}}
        </span>
</div>
<div id="updateModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
    background-color: rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; padding:20px; border-radius:8px; width:400px; max-width:90%;">
        <h3>Update Contact Form</h3>
        <form id="modalForm" method="POST">
            @csrf
            <textarea name="reply" id="modalReply" placeholder="Write a reply..." required style="width:100%; height:100px;"></textarea><br><br>
            <select name="status" id="modalStatus" required style="width:100%;">
                <option value="" disabled selected id="statusPlaceholder">Select status</option>
                <option value="Pending">Pending</option>
                <option value="In-progress">In-progress</option>
                <option value="Resolved">Resolved</option>       
            </select><br><br>
            <button type="submit" class="actionBtn">Save</button>
            <button type="button" class="actionBtn" style="background-color:gray;" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>
<script>
        function toggleDropdown(button) {
            var dropdownContent = button.nextElementSibling;
            
            // Close all other dropdowns
            document.querySelectorAll(".dropdown-content").forEach(menu => {
                if (menu !== dropdownContent) {
                    menu.style.display = "none";
                }
            });

            // Toggle the visibility of the clicked dropdown menu
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
    </script>

</body>
</html>

