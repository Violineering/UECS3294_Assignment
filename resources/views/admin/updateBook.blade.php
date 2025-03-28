<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f0eb;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form Container */
        .form-container {
            background: white;
            padding-left: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            padding-right: 40px;
        }

        .horizontal-line{
            padding-left: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        /* Form Layout */
        .form-wrapper-upper,
        .form-wrapper-below {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
        }

        .form-left-below,
        .form-right-below {
            flex: 1;
            min-width: 45%; /* Makes sure both elements have space */
            box-sizing: border-box;
            padding: 20px;
        }

        .form-left {
            flex: 3;  /* 75% width */
            padding: 20px;
            box-sizing: border-box;
        }

        .form-right {
            flex: 1;  /* 25% width */
            padding: 20px;
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .description-container {
            width: 95%;
            max-width: 95%;
            margin-left: 20px;
            margin-right: 20px;
        }

        textarea[name="description"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            resize: vertical;
            min-height: 60px;
            margin-bottom: 20px;
        }


        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .cover-preview-box,
        .pdf-preview-box {
            width: 105%;
            max-width: 105%;
            height: 250px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            overflow: hidden;
            margin-top: 10px;
        }

        .cover-preview {
            max-width: 100%;
            max-height: 100%; /* Ensures the image does not exceed the preview box */
            object-fit: contain; /* Keeps the image aspect ratio */
            display: block;
        }

        .pdf-preview {
            width: 100%;
            height: 100%;
            display: none;
        }

        /* Button Styles */
        .btn-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
            margin-bottom: 30px;
            margin-left: 20px;
        }

        button {
            flex: 1;
            padding: 10px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-btn {
            background-color: #4CAF50;
            color: white;
        }

        .cancel-btn {
            background-color: #ccc;
            color: black;
        }

        button:hover {
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .form-wrapper-upper,
            .form-wrapper-below {
                flex-direction: column;
                gap: 10px;
            }

            .btn-container {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Update Book</h1>

        <form action="updateBook" method="POST" enctype="multipart/form-data">
            @csrf
			
		<input type = "hidden" name = "id" value="{{ $book['id'] }}" >

            <div class="form-wrapper-upper">
                <div class="form-left">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type = "text" name = "title" value="{{ $book['title'] }}" >
                    </div>

                    <div class="form-group">
                        <label>Author:</label>
                        <input type = "text" name = "author" value="{{ $book['author'] }}" >
                    </div>

                    <div class="form-group">
                        <label>Publisher:</label>
                        <input type = "text" name = "publisher" value="{{ $book['publisher'] }}" >
                    </div>

                    <div class="form-group">
                        <label>Genre:</label>
                        <input type = "text" name = "genre" value="{{ $book['genre'] }}" >
                    </div>
                </div>

                <div class="form-right">
                    <div class="form-group">
                        <label>Availability: </label>
                        <input type = "text" name = "availability" value="{{ $book['availability'] }}" >
                    </div>

                    <div class="form-group">
                        <label>Pages:</label>
                        <input type = "text" name = "pages" value="{{ $book['pages'] }}" >
                    </div>

                    <div class="form-group">
                        <label>Publication Year:</label>
                        <input type = "text" name = "publication_year" value="{{ $book['publication_year'] }}" >
                    </div>

                    <div class="form-group">
                        <label>Language:</label>
                        <input type = "text" name = "language" value="{{ $book['language'] }}" >
                    </div>
                </div>
            </div>
            <div class="description-container">
                <label>Description:</label>
                <textarea name="description" rows="5">{{ $book['description'] }}</textarea>
            </div>
            <div class = "horizontal-line"><hr></div>
            <div class="form-wrapper-below">
                <div class="form-left-below">
                    <div class="form-group">
                        <label>Book Cover:</label>
                        <input type="file" name="cover_image">
                        <div class="cover-preview-box">
                            @if ($book->cover_image)
                                <img id="cover-preview" src="{{ asset('storage/' . $book->cover_image) }}" class="cover-preview" alt="Book Cover">
                            @endif
                        </div>

                        
                    </div>
                </div>
                <div class="form-right-below">
                    <div class="form-group">
                        <label>Content (PDF):</label>
                        <input type="file" name="pdf_file">
                        <div class="pdf-preview-box">
                            @if ($book->pdf_file)
                                <embed id="pdf-preview" src="{{ asset('storage/' . $book->pdf_file) }}" type="application/pdf" width="100%" height="100%">
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <div class="btn-container">
                <button class = "update-btn" type = "submit">Update Book</button>
				<button type="button" class="cancel-btn" onclick="window.location.href = '{{ route('admin.bookManaging') }}'">
                    Cancel
                </button>
            </div>
        </form>
    </div>

    <script>
    function previewCover(event) {
        const input = event.target;
        const previewBox = document.querySelector('.cover-preview-box');
        let preview = document.getElementById('cover-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'cover-preview';
                    preview.className = 'cover-preview';
                    preview.style.maxHeight = '100%';
                    preview.style.maxWidth = '100%';
                    previewBox.innerHTML = ''; // Clear previous content
                    previewBox.appendChild(preview);
                }
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewPDF(event) {
        const input = event.target;
        const previewBox = document.querySelector('.pdf-preview-box');
        let preview = document.getElementById('pdf-preview');

        if (input.files && input.files[0]) {
            const fileURL = URL.createObjectURL(input.files[0]);
            if (!preview) {
                preview = document.createElement('iframe');
                preview.id = 'pdf-preview';
                preview.className = 'pdf-preview';
                preview.style.width = '100%';
                preview.style.height = '100%';
                previewBox.innerHTML = ''; // Clear previous content
                previewBox.appendChild(preview);
            }
            preview.src = fileURL;
            preview.style.display = 'block';
        }
    }

    // Event Listeners for instant preview update
    document.querySelector('input[name="cover_image"]').addEventListener('change', previewCover);
    document.querySelector('input[name="pdf_file"]').addEventListener('change', previewPDF);
</script>


</body>
</html>
