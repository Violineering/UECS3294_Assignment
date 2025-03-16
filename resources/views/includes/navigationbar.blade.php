<style>
.logo-link {
    text-decoration: none; /* Remove underline */
    color: inherit; /* Inherit the color from the parent */
    cursor: pointer; /* Show pointer cursor on hover */
}

.logo-link:hover {
    text-decoration: none; /* Ensure no underline on hover */
    color: inherit; /* Ensure color doesn't change on hover */
}
</style>

<header>
        <nav>
        <div class="logo">
            <a href="{{ url('/') }}" class="logo-link">Bliss</a> <!-- Link to home page -->
        </div>
            <ul class="nav-links">
                <li><a href="#">About Us</a></li>
                <li><a href="/book/booklist">Books</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Categories</a></li>
            </ul>
            <div class="search-bar">
                <input type="text" placeholder="Search book here...">
                <button>🔍</button>
            </div>
            <button class="create-account">Create Account</button>
        </nav>
</header>