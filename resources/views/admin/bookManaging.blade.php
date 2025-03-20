<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Managing</title>
</head>
<body>

    <!-- Include Sidebar -->
    @include('includes.adminSideBar')

    <!-- Main Content -->
    <div class="content" id="content">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Manage books, orders, users, and contact messages from here.</p>
    </div>

    <style>
        /* Main Content */
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        /* When Sidebar is Collapsed */
        .sidebar.collapsed + .content {
            margin-left: 60px;
        }
    </style>

</body>
</html>
