<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="{{ asset('css/admin/addBook.css') }}">
</head>
<body>

    <div class="form-container">
        <h1>Add New Book</h1>

        <form action="{{ route('admin.addBook') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-wrapper-upper">
                <div class="form-left">
                    <div class="form-group">
                        <label><span style="color:red">* </span>Title:</label>
                        <input type="text" name="title" placeholder="Enter book title" required>
                        <span style="color:red">@error('title'){{$message}}@enderror</span><br>
                    </div>

                    <div class="form-group">
                        <label><span style="color:red">* </span>Author:</label>
                        <input type="text" name="author" placeholder="Enter author's name" required>
                        <span style="color:red">@error('author'){{$message}}@enderror</span><br>
                    </div>

                    <div class="form-group">
                        <label><span style="color:red">* </span>Publisher:</label>
                        <input type="text" name="publisher" placeholder="Enter publisher">
                        <span style="color:red">@error('publisher'){{$message}}@enderror</span><br>
                    </div>

                    <div class="form-group">
                        <label><span style="color:red">* </span>Genre:</label>
                        <input type="text" name="genre" placeholder="Enter genre">
                        <span style="color:red">@error('genre'){{$message}}@enderror</span><br>
                    </div>
                </div>

                <div class="form-right">
                    <div class="form-group">
                        <label><span style="color:red">* </span>ISBN:</label>
                        <input type="text" name="isbn" placeholder="Enter ISBN">
                        <span style="color:red">@error('isbn'){{$message}}@enderror</span><br>
                    </div>

                    <div class="form-group">
                        <label><span style="color:red">* </span>Pages:</label>
                        <input type="text" name="pages" placeholder="Enter number of pages">
                        <span style="color:red">@error('pages'){{$message}}@enderror</span><br>
                    </div>

                    <div class="form-group">
                        <label><span style="color:red">* </span>Publication Year:</label>
                        <input type="text" name="publication_year" placeholder="Enter publication year">
                        <span style="color:red">@error('publication_year'){{$message}}@enderror</span><br>
                    </div>

                    <div class="form-group">
                        <label><span style="color:red">* </span>Language:</label>
                        <input type="text" name="language" placeholder="Enter language">
                        <span style="color:red">@error('language'){{$message}}@enderror</span><br>
                    </div>

                    <div class="form-group">
                        <label><span style="color:red">* </span>Price:</label>
                        <input type="text" name="price" placeholder="Enter Price">
                        <span style="color:red">@error('price'){{$message}}@enderror</span><br>
                    </div>
                </div>
            </div>
            <div class="description-container">
                <label>Description:</label>
                <textarea name="description" rows="5" placeholder="Enter book description"></textarea>
                <span style="color:red">@error('description'){{$message}}@enderror</span><br>
            </div>
            <div class = "horizontal-line"><hr></div>
            <div class="form-wrapper-below">
                <div class="form-left-below">
                    <div class="form-group">
                        <label>Book Cover:</label>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <input type="file" name="cover_image" accept="image/*" onchange="previewCover(event)">
                            <button type="button" id="remove-cover" style="display:none; padding: 10px; background-color: #f44336; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="removeCover()">Remove</button>
                        </div>
                        <span style="color:red">@error('cover_image'){{$message}}@enderror</span><br>
                        <div class="cover-preview-box">
                            <img id="cover-preview" class="cover-preview" alt="Book Cover">
                        </div>
                    </div>
                </div>
                <div class="form-right-below">
                    <div class="form-group">
                        <label><span style="color:red">* </span>Content (PDF):</label>
                        <input type="file" name="pdf_file" accept="application/pdf" onchange="previewPDF(event)">
                        <span style="color:red">@error('pdf_file'){{$message}}@enderror</span><br>
                        <div class="pdf-preview-box">
                            <iframe id="pdf-preview" class="pdf-preview"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="availability" value="available">

            <div class="btn-container">
                <button type="submit" class="add-btn">Add Book</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='{{ route('admin.bookManaging') }}'">
                    Cancel
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewCover(event) {
            const input = event.target;
            const preview = document.getElementById('cover-preview');
            const removeBtn = document.getElementById('remove-cover');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    removeBtn.style.display = 'inline-block'; // Show the remove button
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeCover() {
            const input = document.querySelector('input[name="cover_image"]');
            const preview = document.getElementById('cover-preview');
            const removeBtn = document.getElementById('remove-cover');
            input.value = ''; // Clear the input field
            preview.src = ''; // Hide the preview image
            preview.style.display = 'none'; // Hide the preview image
            removeBtn.style.display = 'none'; // Hide the remove button
        }

        function previewPDF(event) {
            const input = event.target;
            const preview = document.getElementById('pdf-preview');
            if (input.files && input.files[0]) {
                const fileURL = URL.createObjectURL(input.files[0]);
                preview.src = fileURL;
                preview.style.display = 'block';
            }
        }
    </script>

</body>
</html>
