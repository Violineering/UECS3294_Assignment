<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contact Forms</title>
    <link rel="stylesheet" href="{{ asset('css/admin/contactForm.css') }}">
</head>
<body>

@include('includes.adminSideBar')

<div class="contactformlist">
    <div class="title">
        <h1>Contact Form Reply</h1>
    </div>
    <div class="table-container">
        <table border="1">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Issue</th>
                    <th>Reply</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ContactForms as $ContactForm)
                <tr>
                    <td>
                        <button class="actionBtn" onclick="openModal({{ $ContactForm->id }})">Update</button>
                    </td>
                    <td>{{ $ContactForm->user_id }}</td>
                    <td>{{ $ContactForm->user->name ?? 'Unknown' }}</td>
                    <td>{{ $ContactForm->issue }}</td>
                    <td>
                        @if ($ContactForm->reply)
                            {{ $ContactForm->reply }}
                        @else
                            <span style="color: grey; font-style: italic;">No reply yet</span>
                        @endif
                    </td>
                    <td class="
                        {{ $ContactForm->status === 'pending' ? 'status-pending' : '' }}
                        {{ $ContactForm->status === 'resolved' ? 'status-resolved' : '' }}
                        {{ $ContactForm->status === 'in-progress' ? 'status-inprogress' : '' }}
                    ">
                        {{ $ContactForm->status }}
                    </td>
                    <td>{{ $ContactForm->created_at }}</td>
                    <td>{{ $ContactForm->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <span>
        {{ $ContactForms->links('pagination::bootstrap-4') }}
    </span>
</div>

<div id="updateModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
    background-color: rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; padding:20px; border-radius:8px; width:400px; max-width:90%;">
        <h3>Update Contact Form</h3>
        <form id="modalForm" method="POST">
            @csrf
            <textarea name="reply" id="modalReply" placeholder="Write a reply..." style="width:100%; height:100px;"></textarea><br><br>
            <select name="status" id="modalStatus" required style="width:100%;">
                <option value="" disabled selected id="statusPlaceholder">Select status</option>
                <option value="Pending">Pending</option>
                <option value="In-progress">In-progress</option>
                <option value="Resolved">Resolved</option>       
            </select><br><br>
            <button type="submit" class="actionBtn">Save</button>
            <button type="button" class="actionBtn" style="background-color:gray;" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>


<script>
    let currentFormId = null;

    function openModal(id) {
        currentFormId = id;

        const contactForm = @json($ContactForms->keyBy('id'));
        const statusSelect = document.getElementById('modalStatus');
        const statusPlaceholder = document.getElementById('statusPlaceholder');
        const form = contactForm[id];
        if (!form) return;

        document.getElementById('modalReply').value = form.reply ?? '';

        // Reset selection
        statusSelect.selectedIndex = 0;

        // Set placeholder text to show current status
        statusPlaceholder.textContent = `${form.status ?? 'Pending'}`;
        document.getElementById('modalForm').action = `/admin/contactForm/update/${id}`;
        document.getElementById('updateModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('updateModal').style.display = 'none';
    }

    // Close modal on outside click
    window.onclick = function(event) {
        const modal = document.getElementById('updateModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>



</body>
</html>
