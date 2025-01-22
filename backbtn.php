<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <style>
        .back-header {
            position: fixed;
            margin-left: 1150px;
            margin-top: 10px;
            z-index: 1000;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            transform: translateX(-3px);
        }

        .back-btn i {
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <div class="back-header">
        <a href="dashboard.php" class="btn btn-secondary back-btn">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</body>
</html>
