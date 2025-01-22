<!-- index.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Centre List</h2>
        <div id="datatable">
            <!-- Data will be loaded here -->
        </div>
    </div>

    <script>
    $(document).ready(function(){
        loadData();

        function loadData() {
            $.ajax({
                url: "list-center.php",
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