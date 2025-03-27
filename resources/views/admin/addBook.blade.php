<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
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
            max-height: 100%;
            display: none;
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

        .add-btn {
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
        <h1>Add New Book</h1>

        <form action="{{ route('admin.addBook') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-wrapper-upper">
                <div class="form-left">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" name="title" placeholder="Enter book title" required>
                    </div>

                    <div class="form-group">
                        <label>Author:</label>
                        <input type="text" name="author" placeholder="Enter author's name" required>
                    </div>

                    <div class="form-group">
                        <label>Publisher:</label>
                        <input type="text" name="publisher" placeholder="Enter publisher">
                    </div>

                    <div class="form-group">
                        <label>Genre:</label>
                        <input type="text" name="genre" placeholder="Enter genre">
                    </div>
                </div>

                <div class="form-right">
                    <div class="form-group">
                        <label>ISBN:</label>
                        <input type="text" name="isbn" placeholder="Enter ISBN">
                    </div>

                    <div class="form-group">
                        <label>Pages:</label>
                        <input type="text" name="pages" placeholder="Enter number of pages">
                    </div>

                    <div class="form-group">
                        <label>Publication Year:</label>
                        <input type="text" name="publication_year" placeholder="Enter publication year">
                    </div>

                    <div class="form-group">
                        <label>Language:</label>
                        <input type="text" name="language" placeholder="Enter language">
                    </div>
                </div>
            </div>
            <div class="description-container">
                <label>Description:</label>
                <textarea name="description" rows="5" placeholder="Enter book description"></textarea>
            </div>
            <div class = "horizontal-line"><hr></div>
            <div class="form-wrapper-below">
                <div class="form-left-below">
                    <div class="form-group">
                        <label>Book Cover:</label>
                        <input type="file" name="cover_image" accept="image/*" onchange="previewCover(event)">
                        <div class="cover-preview-box">
                            <img id="cover-preview" class="cover-preview" alt="Book Cover">
                        </div>
                        
                    </div>
                </div>
                <div class="form-right-below">
                    <div class="form-group">
                        <label>Content (PDF):</label>
                        <input type="file" name="pdf_file" accept="application/pdf" onchange="previewPDF(event)">
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
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
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
