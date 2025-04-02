<style>
    /* Navigation Bar Specific Styles - Scoped to header only */
    header.navigation-header {
        background-color: #ffffff;
        padding: 20px;
        display: flex;
        justify-content: center;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }

    header.navigation-header nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 80%;
    }

    header.navigation-header .logo {
        font-size: 24px;
        font-weight: bold;
        transition: transform 0.3s ease;
    }

    header.navigation-header .logo:hover {
        transform: scale(1.05);
    }

    header.navigation-header .nav-links {
        list-style: none;
        display: flex;
        gap: 20px;
        margin: 0;
        padding: 0;
    }

    header.navigation-header .nav-links li a {
        text-decoration: none;
        color: #1d1d1f;
        font-weight: 500;
        transition: color 0.3s ease;
        padding: 15px;
    }

    header.navigation-header .nav-links li a:hover {
        color: #007AFF;
    }

    /* Search Bar Styling - Scoped to navigation only */
    header.navigation-header .search-container {
        display: flex;
        align-items: center;
        background: #f5f5f5;
        border-radius: 10px;
        padding: 5px 10px;
        width: 300px;
        border: 2px solid transparent;
        transition: 0.3s ease-in-out;
        margin-left: auto;
        position: relative; /* Added for positioning */
    }

    header.navigation-header .search-container:focus-within {
        border-color: rgb(170,170,170);
    }

    header.navigation-header .search-container input {
        border: none;
        outline: none;
        background: transparent;
        flex: 1;
        padding: 10px;
        font-size: 16px;
        width: calc(100% - 30px); /* Make space for icon */
    }

    header.navigation-header .search-container .searchButton {
        position: absolute;
        right: 10px;
        width: 20px;
        height: 20px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
    }

    header.navigation-header .search-container .searchButton:hover {
        filter: brightness(2); 
        transform: scale(1.2); 
    }

    header.navigation-header .logo-link {
        text-decoration: none;
        color: black;
        font-style: oblique;
        font-family: "Times New Roman", serif;
        font-size: 30px;
        margin-right: 70px;
        margin-left: 40px;
    }

    header.navigation-header .profile-icon-container {
        position: relative;
        margin-left: 20px;
    }
    
    header.navigation-header .profile-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        transition: transform 0.3s ease;
        object-fit: cover;
        border: 2px solid transparent;
    }
    
    header.navigation-header .profile-icon:hover {
        transform: scale(1.1);
        border-color: #007AFF;
    }
    
    header.navigation-header .profile-tooltip {
        position: absolute;
        right: 0;
        top: 50px;
        background: white;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: none;
        z-index: 100;
        min-width: 150px;
    }
    
    header.navigation-header .profile-icon-container:hover .profile-tooltip {
        display: block;
    }

    /* Protection against other pages' styles */
    header.navigation-header * {
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
    }
</style>

<header class="navigation-header">
    <nav>
        <div class="logo">
            <a href="{{ url('/') }}" class="logo-link">Unpopular.</a>
        </div>
        <ul class="nav-links">
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="/book/booklist">Books</a></li>
            <li><a href="/purchased_books">My Books</a></li>
            <li>
                <a href="/cart">
                    <img src="{{ asset('icon/cart.png') }}" alt="Shopping Cart" style="width: 24px; height: 24px;">
                </a>
            </li>
        </ul>
        <div class="search-container">
            <input type="text" placeholder="Search books here...">
            <img class="searchButton" src="{{ asset('icon/search.png') }}" alt="Search">
        </div>
        
        <div class="profile-icon-container">
            @auth
                <a href="{{ route('auth.profile') }}">
                    @if(Auth::user()->profile_image)
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                             class="profile-icon" 
                             alt="Profile Picture">
                    @else
                        <img src="{{ asset('storage/profile_pic/default_profile_pic.jpg') }}" 
                             class="profile-icon" 
                             alt="Default Profile">
                    @endif
                </a>
                <div class="profile-tooltip">
                    <p class="mb-2">{{ Auth::user()->name }}</p>
                    <a href="{{ route('auth.profile') }}" class="d-block">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}">
                    <img src="{{ asset('storage/profile_pic/default_profile_pic.jpg') }}" 
                         class="profile-icon" 
                         alt="Login">
                </a>
            @endauth
        </div>
    </nav>
</header>