<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contact Forms</title>
    <style>
        .contactformlist {
            margin-left: 300px; /* Default when sidebar is open */
            padding: 20px;
            transition: margin-left 0.3s ease;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* When Sidebar is Collapsed */
        .sidebar.collapsed ~ .contactformlist {
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
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        /* Table Header */
        thead {
            background-color: rgb(119, 115, 111);
        }

        thead th {
            text-align: center;
            padding: 12px;
            font-weight: bold;
            border-bottom: 2px solid #dee2e6;
            color: white;
        }

        /* Table Rows */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Dropdown Button */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .actionBtn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .actionBtn:hover {
            background-color: #0056b3;
        }

        /* Dropdown Content */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 120px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            z-index: 1;
        }

        .dropdown-content a {
            display: block;
            padding: 8px;
            text-decoration: none;
            color: black;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

@include('includes.adminSideBar')

<div class="contactformlist">
    <div class="title">
        <h1>Contact Form Reply</h1>
    </div>
    <div class="table-container">
        <table border="1">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Issue</th>
                    <th>Reply</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ContactForms as $ContactForm)
                <tr>
                    <td>
                        <div class="dropdown">
                            <button class="actionBtn" onclick="toggleDropdown(this)">Action ▼</button>
                            <div class="dropdown-content">
                                <a href="#">Reply</a>
                                <a href="#">Assign Status</a>
                            </div>
                        </div>
                    </td>
                    <td>{{ $ContactForm->user_id }}</td>
                    <td>{{ $ContactForm->user->name ?? 'Unknown' }}</td>
                    <td>{{ $ContactForm->issue }}</td>
                    <td>{{ $ContactForm->reply }}</td>
                    <td>{{ $ContactForm->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <span>
        {{ $ContactForms->links('pagination::bootstrap-4') }}
    </span>
</div>

<script>
    function toggleDropdown(button) {
        var dropdownContent = button.nextElementSibling;
        var isVisible = dropdownContent.style.display === "block";

        // Close all dropdowns first
        document.querySelectorAll(".dropdown-content").forEach(menu => {
            menu.style.display = "none";
        });

        // Toggle only the clicked one
        dropdownContent.style.display = isVisible ? "none" : "block";

        // Stop event propagation
        event.stopPropagation();
    }

    // Close dropdown when clicking outside
    document.addEventListener("click", function(event) {
        if (!event.target.closest(".dropdown")) {
            document.querySelectorAll(".dropdown-content").forEach(menu => {
                menu.style.display = "none";
            });
        }
    });
</script>

</body>
</html>
