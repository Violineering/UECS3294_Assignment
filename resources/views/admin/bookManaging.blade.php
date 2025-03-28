<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Managing</title>
    <style>

        body{
            background-color: #f5f0eb;
        }

        .title{
            display: flex;
            align-items: justify; 
            justify-content: space-between; 
        }

        .addNewBtn{
            background-color:rgb(219, 219, 219);
            border: none;
            height: 40px;
            line-height: normal; 
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            display: inline-block;
            margin-top: 18px;
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

        td:nth-child(5), /* Publication Year */
        td:nth-child(6), /* Genre */
        td:nth-child(7), /* Language */
        td:nth-child(8),  /* Pages */ 
        td:nth-child(9),  /* Availability */ 
        td:nth-child(11)  /* Cover img */ {
            text-align: center;
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

        .booklist {
            margin-left: 300px; /* Default when sidebar is open */
            padding: 20px;
            transition: margin-left 0.3s ease;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* When Sidebar is Collapsed */
        .sidebar.collapsed ~ .booklist {
            margin-left: 90px; 
            width: calc(100% - 90px); /* Expand content width */
        }
    </style>
</head>
<body>

    <!-- Include Sidebar -->
    @include('includes.adminSideBar')

    <!-- Main Content -->
    <div class="booklist">
        <div class= "title">
            <h1>BookList</h1>
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
                                    <a href = {{"updateBook/".$book['id']}}>Edit</a>
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
