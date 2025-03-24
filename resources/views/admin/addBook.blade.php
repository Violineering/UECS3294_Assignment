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
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form Container */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        /* Form Layout */
        .form-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        /* Left Side: Book Details */
        .form-left {
            flex: 1;
            margin-right: 20px;
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

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Right Side: Book Cover & Content */
        .form-right {
            flex: 0.5;
            text-align: center;
            border-radius: 10px;
        }

        /* Cover Preview Box */
        .cover-preview-box {
            width: 150px;
            height: 200px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            margin: 10px auto;
            overflow: hidden;
        }

        .cover-preview {
            max-width: 100%;
            max-height: 100%;
            display: none;
        }

        /* PDF Preview Box */
        .pdf-preview-box {
            width: 100%;
            height: 300px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            margin-top: 10px;
            overflow: hidden;
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
            margin-top: 20px;
        }

        button {
            padding: 10px 15px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
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
            .form-wrapper {
                flex-direction: column;
            }

            .form-right {
                width: 100%;
            }

            .btn-container {
                flex-direction: column;
            }

            button {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Add New Book</h1>

        <form action="{{ route('admin.addBook') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-wrapper">
                <!-- Left Side: Book Details -->
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
                        <label>ISBN:</label>
                        <input type="text" name="isbn" placeholder="Enter ISBN">
                    </div>

                    <div class="form-group">
                        <label>Publisher:</label>
                        <input type="text" name="publisher" placeholder="Enter publisher">
                    </div>

                    <div class="form-group">
                        <label>Publication Year:</label>
                        <input type="text" name="publication_year" placeholder="Enter publication year">
                    </div>

                    <div class="form-group">
                        <label>Genre:</label>
                        <input type="text" name="genre" placeholder="Enter genre">
                    </div>

                    <div class="form-group">
                        <label>Language:</label>
                        <input type="text" name="language" placeholder="Enter language">
                    </div>

                    <div class="form-group">
                        <label>Pages:</label>
                        <input type="text" name="pages" placeholder="Enter number of pages">
                    </div>

                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" name="description" placeholder="Enter book description">
                    </div>
                </div>

                <!-- Right Side: Book Cover & PDF -->
                <div class="form-right">
                    <div class="form-group">
                        <label>Book Cover:</label>
                        <div class="cover-preview-box">
                            <img id="cover-preview" class="cover-preview" alt="Book Cover">
                        </div>
                        <input type="file" name="cover_image" accept="image/*" onchange="previewCover(event)">
                    </div>

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
