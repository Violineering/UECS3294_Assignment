<style>
    header {
        background-color: #fff;
        padding: 20px;
        display: flex;
        justify-content: center;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }

    nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 80%;
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .nav-links {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    .nav-links li a {
        text-decoration: none;
        color: #1d1d1f;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .nav-links li a:hover {
        color: #007AFF;
    }

    /* Search Bar Styling */
    .search-container {
        display: flex;
        align-items: center;
        background: #f5f5f5;
        border-radius: 10px;
        padding: 5px 10px;
        width: 300px; 
        border: 2px solid transparent;
        transition: 0.3s ease-in-out;
        margin-left: auto;
    }

    .search-container:focus-within {
        border-color: rgb(170,170,170);
    }

    .search-container input {
        border: none;
        outline: none;
        background: transparent;
        flex: 1;
        padding: 10px;
        font-size: 16px;
    }

    .search-container .searchButton {
        padding: 10px 15px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
        width: 20px;
        height: 20px;
        filter: brightness(1);
    }

    .search-container .searchButton:hover {
        filter: brightness(2); 
        transform: scale(1.2); 
    }

    .logo-link{
        text-decoration: none;
        color: black;
        font-style: oblique;
        font-family: "Times New Roman", serif;
        font-size: 30px;
        margin-right: 70px;
        margin-left: 40px;
    }

    .create-account{
        background-color: transparent;
        border-radius: 10px;
        padding: 15px 10px;
        border: 2px solid black;
        margin-left: 10px;
        font-size: 16px;
        margin-right: -60px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .create-account:hover {
        background-color: #1d1d1f;
        color: white;
    }

    li a{
        padding: 15px;
    }

</style>

<header>
    <nav>
        <div class="logo">
            <a href="{{ url('/') }}" class="logo-link">Unpopular.</a> <!-- Link to home page -->
        </div>
        <ul class="nav-links">
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="/book/booklist">Books</a></li>
            <li><a href="#">My Books</a></li>
        </ul>
        <div class="search-container">
            <input type="text" placeholder="Search books here...">
            <img class = "searchButton" src="{{ asset('icon/search.png') }}">
        </div>
        <button class="create-account">Create Account</button>
    </nav>
</header>
