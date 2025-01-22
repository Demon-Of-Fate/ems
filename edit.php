<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Modal Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.4s;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>

<!-- Edit Button -->
<button id="edit-btn" class="btn btn-primary">Edit Item</button>

<!-- The Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Edit Item</h3>
        <form id="editForm">
            <div class="form-group">
                <label for="editInput">Center Code:</label>
                <input type="text" class="form-control" id="editInput" placeholder="Enter new name">
            </div>
            <div class="form-group">
                <label for="editInput">Center Name:</label>
                <input type="text" class="form-control" id="editInput" placeholder="Enter new name">
            </div>
            <div class="form-group">
                <label for="editInput">Center Location:</label>
                <input type="text" class="form-control" id="editInput" placeholder="Enter new name">
            </div>
            <button type="button" class="btn btn-success" id="saveChanges">Save Changes</button>
        </form>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    // jQuery code for modal functionality

    // Get modal and close button
    var modal = $('#editModal');
    var closeBtn = $('.close');

    // When the user clicks the button, open the modal
    $('#edit-btn').click(function() {
        modal.show();
    });

    // When the user clicks the close button, close the modal
    closeBtn.click(function() {
        modal.hide();
    });

    // When the user clicks anywhere outside the modal, close it
    $(window).click(function(event) {
        if ($(event.target).is(modal)) {
            modal.hide();
        }
    });

    // Save changes
    $('#saveChanges').click(function() {
        var editedName = $('#editInput').val(); // Get the input value
        if (editedName.trim() === '') {
            alert('Please enter a name');
        } else {
            // Perform the save action (e.g., send to server with AJAX)
            console.log('Edited name:', editedName);
            
            // Close modal after save
            modal.hide();
            
            // Optionally update the UI with the new value (here we log it)
            alert('Changes saved: ' + editedName);
        }
    });
</script>

</body>
</html>
