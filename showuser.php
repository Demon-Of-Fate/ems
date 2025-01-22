<!-- index.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be any percentage */
        }

        .modal-header, .modal-footer {
            padding: 10px 0;
            text-align: right;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<button id="openModalBtn">Open Modal</button>

<!-- Modal Box -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <h3>Are you Sure you Want to Delete the user</h3>
                    <form action="">

                    </form>
                </div>
                
            </div>
        </div>
    <div class="container mt-4">
        <h2>Centre List</h2>
        <div id="datatable">
            <!-- Data will be loaded here -->
        </div>
    </div>

    <script>
    $(document).ready(function(){
        var modal = $('#myModal');
        var btn = $('#openModalBtn');
        var span = $('.close');
        var closeBtn = $('#closeModalBtn');// Get the close button that closes the modal

        // When the user clicks the button, open the modal
        btn.click(function() {
            modal.show();
        });

        // When the user clicks on <span> (x), close the modal
        span.click(function() {
            modal.hide();
        });

        // When the user clicks the close button, close the modal
        closeBtn.click(function() {
            modal.hide();
        });

        // When the user clicks anywhere outside of the modal, close it
        $(window).click(function(event) {
            if ($(event.target).is(modal)) {
                modal.hide();
            }
        });


       
        loadData();

        function loadData() {
            $.ajax({
                url: "list-user.php",
                type: "POST",
                success: function(response) {
                    $("#datatable").html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    $("#datatable").html("<p>Error loading data</p>");
                }
            });
        }

        // Event delegation for edit and delete buttons
        $(document).on('click', '.edit-btn', function() {
            const centreCode = $(this).data('id');
            // Add your edit logic here
            console.log('Edit clicked for centre:', centreCode);
        });

        $(document).on('click', '.delete-btn', function() {
            const centreCode = $(this).data('id');
            // Add your delete logic here
            console.log('Delete clicked for centre:', centreCode);
        });
    });
    </script>
</body>
</html>