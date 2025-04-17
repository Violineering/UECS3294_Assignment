<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Responses</title>
    <style>
        body {
            background-color: #f5f0eb;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .title {
            text-align: center; 
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

        th, td {
            padding: 10px;
            text-align: left;
            white-space: nowrap;
        }

        /* Table Header */
        thead tr{
            background-color: rgb(119, 115, 111);
        }

        thead th {
            text-align: center;
            font-weight: bold;
            border-bottom: 2px solid #dee2e6;
            color: white;
        }

        thead tr:hover {
            background-color: rgb(119, 115, 111);
        }

        /* Table Rows */
        tr {
            border-bottom: 1px solid #dee2e6;
            background-color: #f9f9f9;
        }


        tr:hover {
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
            background-color: rgba(245, 245, 245);
            color: black;
            border: 1px solid rgba(245, 245, 245);
        }

        .pagination .page-link:hover {
            background-color: rgb(209, 209, 209);
            border: 1px solid rgb(209, 209, 209);
        }

        .pagination .page-item.active .page-link {
            background-color: rgb(163, 163, 163);
            font-weight: bold;
        }

        .MessageList {
            margin: 10px 300px 10px 300px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .no-reply {
            color: #999999; /* light grey */
            font-style: italic;
        }

    </style>
</head>
<body>

    @include('includes.navigationbar')
    <!-- Main Content -->
    <div class="MessageList">
    <div class="title">
        <h1>Contact Us Responses</h1>
    </div>

    @if ($messages->count() > 0)
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Your Message</th>
                        <th>Reply</th>
                        <th>Message at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <!-- Action (Delete Button) -->
                            <td style="text-align: center;">
                                <form action="{{ route('messages.delete', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                                        <img src="https://img.icons8.com/ios-glyphs/24/808080/trash--v1.png" alt="Delete" title="Delete">
                                </form>
                            </td>

                            <!-- Your Message -->
                            <td>{{ $message->issue }}</td>

                            <!-- Reply -->
                            <td>
                                @if ($message->reply)
                                    {{ $message->reply }}
                                @else
                                    <span class="no-reply">No reply yet</span>
                                @endif
                            </td>

                            <!-- Message At -->
                            <td>{{ $message->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <span>
            {{ $messages->links('pagination::bootstrap-4') }}
        </span>
    @else
        <p style="text-align: center; margin-top: 30px;">No messages found.</p>
    @endif
</div>

    @include('includes.footer')

</body>
</html>
