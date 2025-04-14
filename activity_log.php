<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Activity Log</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .log-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
            color: black; /* Changed text color to black */
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: black;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: black;
        }

        table th {
            background-color: #3498db;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
            color: black;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="display-4" style="color: white;">Activity Log</h1>
            <p class="lead">Track all activities on the platform</p>
        </div>
    </div>

   <!-- Activity Log Table -->
<div class="container py-5">
    <div class="log-container">
        <h2 class="text-center mb-4">Recent Activities</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="color: black;">Activity Type</th>
                    <th style="color: black;">User</th>
                    <th style="color: black;">Timestamp</th>
                    <th style="color: black;">Details</th>
                </tr>
            </thead>
           
</div>
                    <!-- Example data, this should be dynamically generated from the database -->
                    
    <td>Service Request</td>
    <td>John Doe</td>
    <td>2023-07-01 10:30:00</td>
    <td>Request for tire puncture repair</td>
</tr>
<tr>
    <td>Account Update</td>
    <td>Jane Smith</td>
    <td>2023-07-02 14:15:00</td>
    <td>Updated contact information</td>
</tr>
<tr>
    <td>Service Completion</td>
    <td>Michael Brown</td>
    <td>2023-07-03 09:45:00</td>
    <td>Completed vehicle towing service</td>
</tr>
<tr>
    <td>Payment Processed</td>
    <td>Emily Davis</td>
    <td>2023-07-04 16:20:00</td>
    <td>Payment for key replacement service</td>
</tr>
<tr>
    <td>New Registration</td>
    <td>Chris Wilson</td>
    <td>2023-07-05 11:00:00</td>
    <td>Registered as a new service provider</td>
</tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include 'footer.php'; ?>