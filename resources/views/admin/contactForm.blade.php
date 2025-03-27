<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Managing</title>
    <style>
        .contactformlist {
            margin-left: 300px; /* Default when sidebar is open */
            padding: 20px;
            transition: margin-left 0.3s ease;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* When Sidebar is Collapsed */
        .sidebar.collapsed ~ .contactformlist {
            margin-left: 90px; 
            width: calc(100% - 90px); /* Expand content width */
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

        td:nth-child(1), 
        td:nth-child(4), {
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
    </style>

</head>
<body>

@include('includes.adminSideBar')

<div class="contactformlist">
        <div class= "title">
            <h1>Contact Form Reply</h1>
        </div>
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>User Id</th>
                        <th>Issue</th>
                        <th>Reply</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ContactForms as $ContactForm)
                    <tr>
                        <td>{{$ContactForm->user_id}}</td>
                        <td>{{$ContactForm->issue}}</td>
                        <td>{{$ContactForm->reply}}</td>
                        <td>{{$ContactForm->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <span>
            {{$ContactForms->links('pagination::bootstrap-4')}}
        </span>
</div>

</body>
</html>

