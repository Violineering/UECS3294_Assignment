<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        /* Sidebar Navigation */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
            border-bottom: 1px solid #34495e;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li:hover {
            background-color: #34495e;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        .content-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .content-section h2 {
            margin-bottom: 15px;
        }

        .logout-btn {
            display: block;
            background-color: #e74c3c;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="{{ route('admin.books') }}">Manage Books</a></li>
            <li><a href="{{ route('admin.orders') }}">Manage Orders</a></li>
            <li><a href="{{ route('admin.users') }}">Manage Users</a></li>
            <li><a href="{{ route('admin.messages') }}">Contact Messages</a></li>
            <li><a href="{{ route('admin.logout') }}" class="logout-btn">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-section">
            <h2>Welcome, Admin</h2>
            <p>Manage your bookstore efficiently using the options in the sidebar.</p>
        </div>

        <div class="content-section">
            <h2>Dashboard Overview</h2>
            <p>View important statistics and recent activities.</p>
            <!-- You can add charts or recent updates here -->
        </div>
    </div>

</body>
</html>
