<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Responses</title>
    <link rel="stylesheet" href="{{ asset('css/contactUs/contactFormReply.css') }}">
</head>
<body>

    @include('includes.navigationbar')
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
                            <th>Status</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr>
                                <td style="text-align: center;">
                                    <form action="{{ route('messages.delete', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; cursor: pointer;">
                                            <img src="https://img.icons8.com/ios-glyphs/24/808080/trash--v1.png" alt="Delete" title="Delete">
                                    </form>
                                </td>
                                <td>{{ $message->issue }}</td>
                                <td>
                                    @if ($message->reply)
                                        {{ $message->reply }}
                                    @else
                                        <span class="no-reply">No reply yet</span>
                                    @endif
                                </td>
                                <td class="
                                    {{ $message->status === 'pending' ? 'status-pending' : '' }}
                                    {{ $message->status === 'resolved' ? 'status-resolved' : '' }}
                                    {{ $message->status === 'in-progress' ? 'status-inprogress' : '' }}
                                ">
                                    {{ $message->status }}
                                </td>
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
