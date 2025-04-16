<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* Sidebar Styling */
    .sidebar {
        width: 250px;
        background: rgb(75, 71, 68);
        color: white;
        padding: 20px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        transition: width 0.3s ease;
    }

    /* Collapsed Sidebar */
    .sidebar.collapsed {
        width: 40px;
        overflow: hidden;
    }

    /* Sidebar Logo */
    .sidebar .logo {
        font-size: 40px;
        text-align: center;
        transition: font-size 0.3s ease, opacity 0.3s ease;
    }

    .sidebar.collapsed .logo {
        font-size: 0;
        opacity: 0;
    }

    /* Sidebar Navigation */
    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar ul li {
        padding: 15px;
        text-align: left;
    }

    .sidebar ul li a {
        color: white;
        text-decoration: none;
        display: block;
    }

    .sidebar ul li a:hover {
        background: #34495e;
    }

    .logoutBtn :hover {
        background: #34495e;
    }

    .logoutBtn {
        margin-left: -8px;
        min-height: 4px;
        min-width: 20px;
    }

    .sidebar ul li i{
        padding-right: 10px;
        min-height: 4px;
        min-width: 20px;
    }

    /* Toggle Button */
    .toggle-btn {
        position: absolute;
        top: 15px;
        right: 10px;
        background: transparent;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        font-size: 18px;
        transition: right 0.3s ease;
    }

    .sidebar.collapsed .link-text {
        display: none;
    }
</style>

<div class="sidebar" id="sidebar">
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <h2 class="logo">Unpopular.</h2>
    <hr>
    <ul>
        <li>
            <a href="/admin/bookManaging">
                <i class="fas fa-book"></i>
                <span class="link-text">Manage Books</span>
            </a>
        </li>
        <li>
            <a href="/admin/manageAdmin">
                <i class="fas fa-user-cog"></i>
                <span class="link-text">Manage Admin</span>
            </a>
        </li>
        <li>
            <a href="/admin/contactForm">
                <i class="fas fa-envelope"></i>
                <span class="link-text">Manage Contact Form</span>
            </a>
        </li>
        <hr>
        <li>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; cursor: pointer;" class="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="link-text">Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>

<script>
    function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    var booklist = document.querySelector(".booklist");

    sidebar.classList.toggle("collapsed");

    // Adjust booklist margin based on sidebar state
    if (sidebar.classList.contains("collapsed")) {
        booklist.style.marginLeft = "90px";
        booklist.style.width = "calc(100% - 90px)";
    } else {
        booklist.style.marginLeft = "300px";
        booklist.style.width = "calc(100% - 300px)";
    }
}

</script>
