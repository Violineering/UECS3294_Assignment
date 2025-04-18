<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Managing</title>
    <link rel="stylesheet" href="{{ asset('css/admin/bookManaging.css') }}">
</head>
<body>

    @include('includes.adminSideBar')

    <div class="booklist">
        <div class= "title">
            <h1>Manage Books</h1>
            <button class="addNewBtn"><a href="{{ route('admin.addBook') }}" style="text-decoration: none; color: black;">+ New</a></button>
        </div>
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Publication Year</th>
                        <th>Genre</th>
                        <th>Language</th>
                        <th>Pages</th>
                        <th>Availability</th>
                        <th>Description</th>
                        <th>Cover Image</th>
                        <th>Content(pdf)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="actionBtn" onclick="toggleDropdown(this)">Action ▼</button>
                                <div class="dropdown-content">
                                    <a href = {{"updateBook/".$book['id']}}>Update</a>
                                    <a href="{{ route('admin.deleteBook', ['id' => $book->id]) }}" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                                </div>
                            </div>
                        </td>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td>{{$book->publisher}}</td>
                        <td>{{$book->publication_year}}</td>
                        <td>{{$book->genre}}</td>
                        <td>{{$book->language}}</td>
                        <td>{{$book->pages}}</td>
                        <td>{{$book->availability}}</td>
                        <td>{{$book->description}}</td>
                        <td><img src="{{ asset('storage/' . $book->cover_image) }}" height="150" alt="Book Cover"></td>
                        <td>@if ($book->pdf_file)
                                <a href="{{ asset('storage/' . $book->pdf_file) }}" download>Download Current PDF</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <span>
            {{$books->links('pagination::bootstrap-4')}}
        </span>
    </div>

    <script>
        function toggleDropdown(button) {
            var dropdownContent = button.nextElementSibling;
            
            document.querySelectorAll(".dropdown-content").forEach(menu => {
                if (menu !== dropdownContent) {
                    menu.style.display = "none";
                }
            });

            dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
        }
        
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
