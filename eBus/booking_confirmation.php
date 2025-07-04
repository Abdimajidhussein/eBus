<?php
session_start();

// Check if booking details exist in the session
if (!isset($_SESSION['booking_details'])) {
    // If no booking details, redirect to home or schedules page
    header("Location: view_schedules.php");
    exit();
}

// Retrieve booking details from session
$booking = $_SESSION['booking_details'];

// Optionally, clear booking details from session if they are no longer needed
// after being displayed (e.g., to prevent refresh re-displaying old data)
// unset($_SESSION['booking_details']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed! - Your Bus Line</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles for Screen Display */
        :root {
            --primary-color: #0F4C81;
            --primary-dark: #0A3763;
            --accent-color: #28a745; /* Green for success */
            --text-color: #343a40;
            --light-gray: #f8f9fa;
            --mid-gray: #e9ecef;
            --white: #ffffff;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif; /* Default for general page */
            margin: 0;
            padding: 0;
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
        }

        .header {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 15px 0;
            text-align: center;
            box-shadow: 0 2px 4px var(--shadow);
        }

        .header h1 {
            margin: 0;
            font-size: 2.2em;
            font-weight: 700;
        }

        .navbar {
            background-color: var(--primary-dark);
            padding: 10px 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .navbar a {
            color: var(--white);
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }

        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 4px 15px var(--shadow);
            text-align: center;
        }

        .confirmation-message {
            background-color: var(--accent-color);
            color: var(--white);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-size: 1.5em;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        h2.page-title {
            color: var(--primary-dark);
            margin-bottom: 20px;
            font-size: 2em;
        }

        .btn-group {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn.print-ticket-btn {
            background-color: #6c757d;
        }
        .btn.print-ticket-btn:hover {
            background-color: #5a6268;
        }

        .footer {
            background-color: var(--primary-dark);
            color: var(--white);
            text-align: center;
            padding: 25px 0;
            margin-top: 50px;
            font-size: 0.9em;
        }

        /* --- Receipt-Style E-Ticket Specifics (On-Screen) --- */
        .receipt-ticket {
            font-family: 'Roboto Mono', monospace;
            max-width: 380px; /* This is for screen display, print will override */
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: left;
            line-height: 1.3;
            font-size: 0.95em;
            box-sizing: border-box;
        }
        .receipt-ticket-header {
            text-align: center;
            margin-bottom: 10px;
        }
        .receipt-ticket-header h3 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
            text-transform: uppercase;
        }
        .receipt-ticket-header p {
            margin: 3px 0;
            font-size: 0.85em;
            color: #555;
        }
        .receipt-ticket-header .logo-placeholder {
            width: 80px;
            height: 80px;
            background-color: #eee;
            margin: 0 auto 10px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7em;
            color: #777;
            border: 1px dashed #ccc;
        }

        .ticket-section {
            padding: 5px 0;
            margin-top: 0;
        }
        .ticket-section:first-of-type {
            padding-top: 0;
        }

        .ticket-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }
        .ticket-item .label {
            flex-shrink: 0;
            margin-right: 10px;
            white-space: nowrap;
        }
        .ticket-item .value {
            flex-grow: 1;
            text-align: right;
        }
        .ticket-total {
            font-size: 1.2em;
            font-weight: 700;
            padding-top: 10px;
            border-top: 1px dashed #999;
            margin-top: 5px;
            display: flex;
            justify-content: space-between;
        }
        .ticket-final-message {
            text-align: center;
            margin-top: 10px;
            font-size: 0.85em;
            color: #555;
            padding-top: 10px;
            border-top: 1px dashed #999;
        }

        .receipt-qr-code-placeholder {
            width: 100px;
            height: 100px;
            background-color: #eee;
            border: 1px solid #ccc;
            margin: 10px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7em;
            color: #777;
            text-align: center;
            line-height: 1.2;
        }


        /* --- Print-specific styles for Receipt Ticket --- */
        @media print {
            /* Crucial: Define the page size and remove margins */
            @page {
                size: 80mm auto; /* Set width to 80mm (common thermal paper), height auto */
                margin: 0;       /* Remove all default printer margins */
                -webkit-print-color-adjust: exact; /* For Chrome/Safari to print colors precisely */
                print-color-adjust: exact;         /* Standard property */
            }

            html, body {
                margin: 0;
                padding: 0;
                width: 100%;
                background-color: #fff !important; /* Force white background for print */
                font-family: 'Roboto Mono', monospace; /* Ensure consistent font for print */
                font-size: 0.9em; /* Adjust overall font size for print readability */
            }

            .header, .navbar, .footer, .container h2.page-title, .confirmation-message, .btn-group {
                display: none; /* Hide non-ticket elements when printing */
            }

            .container {
                box-shadow: none;
                border: none;
                padding: 0;
                margin: 0;
                max-width: 100%;
                width: 100%;
                text-align: left;
            }

            .receipt-ticket {
                width: 80mm; /* Force the ticket container to the exact width of thermal paper */
                margin: 0 auto; /* Center the ticket on the narrower print page */
                padding: 5mm; /* Add some internal padding for content within the ticket */
                border: none;
                box-shadow: none;
                background-color: #fff !important; /* Ensure ticket background is white */
                color: #000 !important; /* Ensure text is black */
                box-sizing: border-box; /* Include padding in the 80mm width */
                float: none; /* Prevent any floating issues */
                overflow: hidden; /* Ensure content stays within bounds */
            }

            /* Ensure all text elements inherit black color for print */
            .receipt-ticket *,
            .receipt-ticket-header h3,
            .receipt-ticket-header p,
            .ticket-final-message,
            .ticket-total span {
                color: #000 !important;
            }

            /* Dashed lines for print */
            .ticket-total, .ticket-final-message {
                border-top: 1px dashed #000 !important;
            }
            .receipt-qr-code-placeholder {
                border-color: #000 !important;
                background-color: #fff !important;
            }
            .receipt-ticket-header .logo-placeholder {
                 border: 1px dashed #000 !important;
                 background-color: #fff !important;
            }

            /* Adjust spacing for print to be very compact */
            .ticket-section {
                padding: 2px 0 !important;
                margin-top: 0 !important;
            }
            .ticket-item {
                margin-bottom: 1px !important;
            }
            .ticket-total {
                padding-top: 5px !important;
                margin-top: 2px !important;
            }
            .ticket-final-message {
                margin-top: 5px !important;
                padding-top: 5px !important;
            }
            .receipt-qr-code-placeholder {
                margin: 5px auto !important;
            }
            .receipt-ticket-header .logo-placeholder {
                 margin-bottom: 5px !important;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Your Bus Line</h1>
    </div>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="view_schedules.php">View Schedules</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login / Register</a>
    </div>

    <div class="container">
        <div class="confirmation-message">
            Your Booking is Confirmed!
        </div>

        <h2 class="page-title">Your E-Ticket</h2>

        <div class="receipt-ticket">
            <div class="receipt-ticket-header">
                <div class="logo-placeholder">YOUR LOGO</div>
                <h3>Your Bus Line</h3>
                <p>Mombasa, Kenya</p>
                <p>Booking Hotline: +254 7XX XXX XXX</p>
                <p>VAT No: P00XXXXX</p>
            </div>

            <div class="ticket-section">
                <div class="ticket-item">
                    <span class="label">Booking ID:</span>
                    <span class="value"><?php echo htmlspecialchars($booking['booking_id']); ?></span>
                </div>
                <div class="ticket-item">
                    <span class="label">Booking Date:</span>
                    <span class="value"><?php echo htmlspecialchars(date("Y-m-d H:i", strtotime($booking['booking_date']))); ?></span>
                </div>
            </div>

            <div class="ticket-section">
                <div class="ticket-item">
                    <span class="label">Passenger:</span>
                    <span class="value"><?php echo htmlspecialchars($booking['full_name']); ?></span>
                </div>
                <div class="ticket-item">
                    <span class="label">Email:</span>
                    <span class="value"><?php echo htmlspecialchars($booking['email']); ?></span>
                </div>
                <div class="ticket-item">
                    <span class="label">Phone:</span>
                    <span class="value"><?php echo htmlspecialchars($booking['phone']); ?></span>
                </div>
            </div>

            <div class="ticket-section">
                <div class="ticket-item">
                    <span class="label">Route:</span>
                    <span class="value"><?php echo htmlspecialchars($booking['schedule']['origin']); ?> &#8594; <?php echo htmlspecialchars($booking['schedule']['destination']); ?></span>
                </div>
                <div class="ticket-item">
                    <span class="label">Departure Time:</span>
                    <span class="value"><?php echo htmlspecialchars($booking['schedule']['departure_time']); ?></span>
                </div>
                <div class="ticket-item">
                    <span class="label">Arrival Time:</span>
                    <span class="value"><?php echo htmlspecialchars($booking['schedule']['arrival_time']); ?></span>
                </div>
                <div class="ticket-item">
                    <span class="label">Bus Type:</span>
                    <span class="value"><?php echo htmlspecialchars($booking['schedule']['bus_type']); ?></span>
                </div>
            </div>

            <div class="ticket-section">
                <div class="ticket-item">
                    <span class="label">Selected Seat(s):</span>
                    <span class="value"><?php echo htmlspecialchars(implode(', ', $booking['selected_seats'])); ?></span>
                </div>
                <div class="ticket-item">
                    <span class="label">Fare per Seat:</span>
                    <span class="value">Ksh <?php echo number_format($booking['schedule']['fare']); ?></span>
                </div>
                <div class="ticket-total">
                    <span>TOTAL PAYABLE:</span>
                    <span>Ksh <?php echo number_format($booking['total_fare']); ?></span>
                </div>
            </div>

            <div class="ticket-section">
                 <div class="receipt-qr-code-placeholder">
                    SCAN FOR VALIDATION
                </div>
            </div>

            <div class="ticket-final-message">
                <p>Thank you for choosing Your Bus Line!</p>
                <p>Please present this ticket at boarding.</p>
            </div>
        </div>

        <div class="btn-group">
            <a href="view_schedules.php" class="btn">Book Another Journey</a>
            <button onclick="window.print()" class="btn print-ticket-btn">Print Ticket</button>
        </div>
    </div>

    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> Your Bus Line. All rights reserved.</p>
        <p>Located in Mombasa, Mombasa County, Kenya.</p>
    </div>
</body>
</html>