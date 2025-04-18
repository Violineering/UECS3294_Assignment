<style>
    /* Navigation Bar Specific Styles - Scoped to header only */
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
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
        gap: 35px;
        margin: 0;
        padding: 0;
        margin-left: -110px;
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
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
        border-radius: 50%;
        transition: background-color 0.3s ease;
    }

    header.navigation-header .profile-icon-container:hover {
        background-color: #f0f0f0; 
    }

    header.navigation-header .profile-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        transition: transform 0.3s ease, border-color 0.3s ease;
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
        top: 60px; 
        background: white;
        padding: 12px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: none;
        z-index: 100;
        min-width: 180px;
    }

    header.navigation-header .profile-tooltip p, 
    header.navigation-header .profile-tooltip a {
        margin: 5px 0;
        font-size: 14px;
        color: #333;
        text-decoration: none;
    }

    header.navigation-header .profile-tooltip a:hover {
        color: #007AFF;
        font-size: 15px; 
        text-decoration: none; 
    }

    header.navigation-header * {
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
    }

    header.navigation-header input,
    header.navigation-header input[type="text"] {
        all: unset; 
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
        padding: 10px;
        font-size: 16px;
        background: transparent;
        }

        header.navigation-header .profile-tooltip p:first-child {
        text-align: center;
        font-weight: bold;
        margin-bottom: 10px;
    }

    header.navigation-header .profile-tooltip form {
        display: flex;
        justify-content: center; 
        align-items: center; 
        width: 100%; 
    }

    header.navigation-header .profile-tooltip form button {
        background-color: black; 
        color: white; 
        padding: 8px 15px; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer;
        font-size: 14px; 
        transition: background-color 0.3s ease; 
    }

    header.navigation-header .profile-tooltip form button:hover {
        background-color: grey;
    }

</style>

<header class="navigation-header">
    <nav>
        <div class="logo">
            <a href="{{ url('/') }}" class="logo-link">Unpopular.</a>
        </div>
        <ul class="nav-links">
            <li><a href="/contactUs">Contact Us</a></li>
            <li><a href="/bookCategories">Categories</a></li>
            <li><a href="/book/booklist">Books</a></li>
            <li><a href="/purchased_books">My Books</a></li>
            <li>
                <a href="/cart" style="position: relative;">
                    <img src="{{ asset('icon/cart.png') }}" alt="Shopping Cart" style="width: 24px; height: 24px;">
                    @if(session('cart_count', 0) > 0)
                        <span style="
                            position: absolute;
                            top: -5px;
                            right: -10px;
                            background-color: red;
                            color: white;
                            font-size: 12px;
                            font-weight: bold;
                            border-radius: 50%;
                            padding: 2px 6px;
                        ">
                            {{ session('cart_count') }}
                        </span>
                    @endif
                </a>
            </li>
        </ul>
        <div class="profile-icon-container" id="profileIconContainer">
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
                    <p><a href="{{ route('auth.profile') }}" class="d-block">Profile</a></p>
                    <p><a href="{{ route('user.contactUsResponses') }}" class="d-block">Contact Us Responses</a><p>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileContainer = document.getElementById('profileIconContainer');
        const tooltip = profileContainer.querySelector('.profile-tooltip');
        let timeout;

        profileContainer.addEventListener('mouseenter', function() {
            clearTimeout(timeout);
            tooltip.style.display = 'block';
        });

        profileContainer.addEventListener('mouseleave', function() {
            timeout = setTimeout(function() {
                tooltip.style.display = 'none';
            }, 500); 
        });

        tooltip.addEventListener('mouseenter', function() {
            clearTimeout(timeout);
            tooltip.style.display = 'block';
        });

        tooltip.addEventListener('mouseleave', function() {
            timeout = setTimeout(function() {
                tooltip.style.display = 'none';
            }, 500);
        });
    });
</script>
</header>