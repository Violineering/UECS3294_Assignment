<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contact Forms</title>
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

        th, td {
            white-space: nowrap;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        /* Table Header */
        thead {
            background-color: rgb(119, 115, 111);
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
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .status-pending {
            background-color: #d6d6d6; /* Light grey */
            text-align: center;
        }

        .status-resolved {
            background-color:rgb(115, 255, 120); /* Light green */
            text-align: center;
        }

        .status-inprogress {
            background-color: #f9a825;; /* Light yellow */
            text-align: center;
        }


        /* Dropdown Button */
        .actionBtn {
            background-color: #ffc107;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .actionBtn:hover {
            background-color:rgb(190, 145, 10);
        }

        /*modal*/
        #updateModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* semi-transparent background */
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Modal Content Box */
        #updateModal > div {
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
            animation: fadeInUp 0.3s ease;
        }

        /* Form elements inside modal */
        #modalForm textarea,
        #modalForm select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        #modalForm textarea{
            max-width: 94.5%;
        }

        /* Buttons inside modal */
        #modalForm button {
            padding: 10px 16px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.2s ease;
        }

        #modalForm button[type="submit"] {
            background-color: #ffc107;
            color: #000;
        }

        #modalForm button[type="submit"]:hover {
            background-color: rgb(190, 145, 10);
        }

        #modalForm button[type="button"] {
            background-color: #6c757d;
            color: #fff;
        }

        #modalForm button[type="button"]:hover {
            background-color: #5a6268;
        }

        /* Modal fade-in animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


    </style>
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
                    <td>{{ $ContactForm->reply }}</td>
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
            <textarea name="reply" id="modalReply" placeholder="Write a reply..." required style="width:100%; height:100px;"></textarea><br><br>
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
