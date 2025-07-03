<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Seats - Your Bus Line</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Professional Blue Palette */
            --primary-color: #0F4C81; /* Deep, professional blue */
            --primary-dark: #0A3763; /* Even darker blue for subtle contrast */
            --accent-color: #FF6F61; /* A muted, yet warm orange/coral for highlights */
            --text-color: #343a40; /* Darker gray for main text */
            --light-gray: #f8f9fa; /* Very light background for sections */
            --mid-gray: #e9ecef; /* Slightly darker gray for borders/dividers */
            --white: #ffffff;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
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
        .navbar a.current-page {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 4px 15px var(--shadow);
            display: flex; /* Use flexbox for layout */
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            gap: 30px;
        }

        h2.section-title {
            width: 100%; /* Take full width in container */
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 30px;
            font-size: 2.5em;
            font-weight: 600;
            position: relative;
        }

        h2.section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -10px;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        .schedule-details {
            flex: 1; /* Take available space */
            min-width: 300px; /* Minimum width before wrapping */
            padding-right: 20px;
        }

        .schedule-details p {
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .schedule-details strong {
            color: var(--primary-color);
        }

        .seat-selection-area {
            flex: 2; /* Take more space than details */
            min-width: 400px; /* Minimum width for seat layout */
            display: flex;
            flex-direction: column;
            align-items: center;
            border-left: 1px solid var(--mid-gray); /* Separator */
            padding-left: 30px;
        }

        .seat-map-wrapper {
            background-color: var(--light-gray);
            border: 1px solid var(--mid-gray);
            border-radius: 10px;
            padding: 20px;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align top for driver/door */
            position: relative;
        }

        .bus-layout {
            display: grid;
            grid-template-columns: repeat(2, 60px) 30px repeat(2, 60px); /* 2 seats, gap, 2 seats */
            gap: 10px; /* Gap between seats/rows */
            padding: 10px;
            background-color: var(--white);
            border-radius: 5px;
            border: 1px solid var(--mid-gray);
            position: relative;
            z-index: 1;
        }

        .seat-section {
            display: contents; /* Allows children to participate directly in grid */
        }

        .seat {
            width: 50px; /* Adjust seat size */
            height: 50px;
            background-color: #ffc107; /* Available seat color (yellow/orange) */
            border: 1px solid #e0a800;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease, border-color 0.2s ease;
            user-select: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .seat:hover:not(.booked):not(.selected) {
            background-color: #ffda6a;
            border-color: #d39e00;
        }

        .seat.booked {
            background-color: #dc3545; /* Red for booked seats */
            border-color: #bd2130;
            cursor: not-allowed;
            opacity: 0.7;
            color: var(--white);
        }

        .seat.selected {
            background-color: var(--accent-color); /* Selected seat color */
            border-color: #d1473d;
            color: var(--white);
        }

        /* Specific grid positions for your layout */
        .seat[data-seat="1"] { grid-column: 1; grid-row: 2; }
        .seat[data-seat="2"] { grid-column: 2; grid-row: 2; }
        .seat[data-seat="3"] { grid-column: 1; grid-row: 3; }
        .seat[data-seat="4"] { grid-column: 2; grid-row: 3; }
        .seat[data-seat="5"] { grid-column: 4; grid-row: 2; }
        .seat[data-seat="6"] { grid-column: 5; grid-row: 2; }
        .seat[data-seat="7"] { grid-column: 1; grid-row: 4; }
        .seat[data-seat="8"] { grid-column: 2; grid-row: 4; }
        .seat[data-seat="9"] { grid-column: 4; grid-row: 3; }
        .seat[data-seat="10"] { grid-column: 5; grid-row: 3; }
        .seat[data-seat="11"] { grid-column: 4; grid-row: 4; }
        .seat[data-seat="12"] { grid-column: 5; grid-row: 4; }

        .seat[data-seat="15"] { grid-column: 1; grid-row: 6; }
        .seat[data-seat="16"] { grid-column: 2; grid-row: 6; }
        .seat[data-seat="19"] { grid-column: 1; grid-row: 7; }
        .seat[data-seat="20"] { grid-column: 2; grid-row: 7; }
        .seat[data-seat="23"] { grid-column: 1; grid-row: 8; }
        .seat[data-seat="24"] { grid-column: 2; grid-row: 8; }
        .seat[data-seat="27"] { grid-column: 1; grid-row: 9; }
        .seat[data-seat="28"] { grid-column: 2; grid-row: 9; }
        .seat[data-seat="31"] { grid-column: 1; grid-row: 10; }
        .seat[data-seat="32"] { grid-column: 2; grid-row: 10; }
        .seat[data-seat="35"] { grid-column: 1; grid-row: 11; }
        .seat[data-seat="36"] { grid-column: 2; grid-row: 11; }
        .seat[data-seat="39"] { grid-column: 1; grid-row: 12; }
        .seat[data-seat="40"] { grid-column: 2; grid-row: 12; }
        .seat[data-seat="43"] { grid-column: 1; grid-row: 13; }
        .seat[data-seat="44"] { grid-column: 2; grid-row: 13; }

        .seat[data-seat="13"] { grid-column: 4; grid-row: 5; }
        .seat[data-seat="14"] { grid-column: 5; grid-row: 5; }
        .seat[data-seat="17"] { grid-column: 4; grid-row: 6; }
        .seat[data-seat="18"] { grid-column: 5; grid-row: 6; }
        .seat[data-seat="21"] { grid-column: 4; grid-row: 7; }
        .seat[data-seat="22"] { grid-column: 5; grid-row: 7; }
        .seat[data-seat="25"] { grid-column: 4; grid-row: 8; }
        .seat[data-seat="26"] { grid-column: 5; grid-row: 8; }
        .seat[data-seat="29"] { grid-column: 4; grid-row: 9; }
        .seat[data-seat="30"] { grid-column: 5; grid-row: 9; }
        .seat[data-seat="33"] { grid-column: 4; grid-row: 10; }
        .seat[data-seat="34"] { grid-column: 5; grid-row: 10; }
        .seat[data-seat="37"] { grid-column: 4; grid-row: 11; }
        .seat[data-seat="38"] { grid-column: 5; grid-row: 11; }
        .seat[data-seat="41"] { grid-column: 4; grid-row: 12; }
        .seat[data-seat="42"] { grid-column: 5; grid-row: 12; }
        .seat[data-seat="45"] { grid-column: 4; grid-row: 13; }
        .seat[data-seat="46"] { grid-column: 5; grid-row: 13; }


        .driver-door-label {
            background-color: #dc3545; /* Red for labels */
            color: var(--white);
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 600;
            text-align: center;
            font-size: 0.8em;
            grid-column: span 2; /* Spanning two columns */
            align-self: center; /* Vertically center in its row */
            justify-self: center; /* Horizontally center in its columns */
            margin-bottom: 5px; /* Space below label */
        }
        .driver-label {
            grid-column: 4 / span 2; /* Position driver label */
            grid-row: 1; /* First row */
            width: 100%; /* Take full width of its span */
        }
        .door-label {
            grid-column: 1 / span 2; /* Position door label */
            grid-row: 5; /* Row below first set of seats */
            width: 100%;
        }


        .seat-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
            width: 100%;
        }
        .legend-item {
            display: flex;
            align-items: center;
            font-size: 0.9em;
        }
        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            margin-right: 8px;
            border: 1px solid rgba(0,0,0,0.2);
        }
        .legend-color.available { background-color: #ffc107; }
        .legend-color.selected { background-color: var(--accent-color); }
        .legend-color.booked { background-color: #dc3545; }


        .booking-summary, .passenger-details-form {
            width: 100%;
            margin-top: 30px;
            padding: 25px;
            border: 1px solid var(--mid-gray);
            border-radius: 8px;
            background-color: var(--light-gray);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .booking-summary h3, .passenger-details-form h3 {
            color: var(--primary-dark);
            margin-top: 0;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--mid-gray);
            padding-bottom: 10px;
        }
        .booking-summary p {
            font-size: 1.1em;
            margin-bottom: 8px;
        }
        .booking-summary #selected-seats-display {
            font-weight: 600;
            color: var(--accent-color);
        }
        .booking-summary #total-fare-display {
            font-weight: 700;
            font-size: 1.3em;
            color: var(--primary-color);
            margin-top: 15px;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-dark);
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"] {
            width: calc(100% - 22px); /* Adjust for padding and border */
            padding: 10px;
            border: 1px solid var(--mid-gray);
            border-radius: 5px;
            font-size: 1em;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
            transition: border-color 0.2s ease;
        }
        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="tel"]:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 111, 97, 0.2); /* Light accent shadow on focus */
        }
        .form-group small {
            color: #6c757d;
            font-size: 0.85em;
            margin-top: 5px;
            display: block;
        }


        .proceed-btn-container {
            text-align: center;
            margin-top: 25px;
        }

        .btn {
            background-color: var(--accent-color);
            color: var(--white);
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
            border: none; /* Make buttons consistent */
            cursor: pointer;
        }

        .btn:hover {
            background-color: #e05e54;
            transform: translateY(-2px);
        }
        .btn:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
            transform: none;
        }


        .footer {
            background-color: var(--primary-dark);
            color: var(--white);
            text-align: center;
            padding: 25px 0;
            margin-top: 50px;
            font-size: 0.9em;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 20px;
            }
            .schedule-details, .seat-selection-area {
                min-width: unset;
                padding-left: 0;
                border-left: none;
                padding-right: 0;
            }
            .seat-map-wrapper {
                width: 100%; /* Take full width on smaller screens */
                padding: 15px;
            }
            .bus-layout {
                grid-template-columns: repeat(2, 1fr) 20px repeat(2, 1fr);
                gap: 8px;
            }
            .seat {
                width: 45px;
                height: 45px;
                font-size: 0.8em;
            }
            .driver-door-label {
                padding: 3px 8px;
                font-size: 0.7em;
            }
            .form-group input[type="text"],
            .form-group input[type="email"],
            .form-group input[type="tel"] {
                width: calc(100% - 20px); /* Adjust for smaller screens */
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
        <h2 class="section-title">Select Your Seats & Provide Details</h2>

        <?php
// ... (existing PHP code for session_start(), schedule_id, $all_schedules, $current_schedule, $booked_seats) ...

// Add this block to display errors from process_booking.php
if (isset($_SESSION['booking_errors']) && !empty($_SESSION['booking_errors'])) {
    echo '<div class="error-messages" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px;">';
    echo '<h4>Booking Failed:</h4>';
    echo '<ul>';
    foreach ($_SESSION['booking_errors'] as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    // Clear the errors from the session after displaying them
    unset($_SESSION['booking_errors']);
}
?>

<div class="container">
    <h2 class="section-title">Select Your Seats & Provide Details</h2>

    <?php
    // ... (rest of your existing PHP and HTML for book_now.php) ...
    ?>
</div>

        <?php
        // Get schedule ID from URL
        $schedule_id = isset($_GET['schedule_id']) ? intval($_GET['schedule_id']) : 0;

        // --- Simulate fetching schedule details from a database ---
        // In a real app, you'd perform a DB query here
        $all_schedules = [
            101 => [
                'origin' => 'Mombasa', 'destination' => 'Garissa', 'departure_time' => '07:00 AM',
                'arrival_time' => '02:00 PM', 'bus_type' => 'Luxury Coach', 'fare' => 2500, 'total_seats' => 46
            ],
            102 => [
                'origin' => 'Garissa', 'destination' => 'Mombasa', 'departure_time' => '08:30 AM',
                'arrival_time' => '03:30 PM', 'bus_type' => 'Standard Express', 'fare' => 2200, 'total_seats' => 46
            ],
            103 => [
                'origin' => 'Nairobi', 'destination' => 'Garissa', 'departure_time' => '09:00 AM',
                'arrival_time' => '04:00 PM', 'bus_type' => 'VIP Shuttle', 'fare' => 1800, 'total_seats' => 46
            ],
            104 => [
                'origin' => 'Garissa', 'destination' => 'Nairobi', 'departure_time' => '10:00 AM',
                'arrival_time' => '05:00 PM', 'bus_type' => 'Luxury Coach', 'fare' => 1900, 'total_seats' => 46
            ],
            105 => [
                'origin' => 'Mombasa', 'destination' => 'Nairobi', 'departure_time' => '06:00 AM',
                'arrival_time' => '01:00 PM', 'bus_type' => 'Standard Express', 'fare' => 1500, 'total_seats' => 46
            ],
            106 => [
                'origin' => 'Nairobi', 'destination' => 'Mombasa', 'departure_time' => '10:00 PM',
                'arrival_time' => '05:00 AM', 'bus_type' => 'Night Sleeper', 'fare' => 1700, 'total_seats' => 46
            ]
        ];

        $current_schedule = $all_schedules[$schedule_id] ?? null;

        // --- Simulate fetching booked seats for this schedule ---
        // In a real app, you'd perform a DB query like:
        // SELECT seat_number FROM bookings WHERE schedule_id = :schedule_id AND booking_status = 'confirmed';
        $booked_seats = [];
        if ($schedule_id == 101) {
            $booked_seats = [1, 2, 5, 12, 16, 20, 25, 30, 35, 40]; // Example booked seats for schedule 101
        } elseif ($schedule_id == 103) {
            $booked_seats = [3, 4, 6, 9, 10, 11, 13, 14, 15, 17, 18, 21, 22, 23, 24, 26, 27, 28, 29, 31, 32, 33, 34, 36, 37, 38, 39, 41, 42, 43, 44, 45, 46]; // Many booked
        }

        if (!$current_schedule) {
            echo '<p class="no-schedules">Schedule not found or invalid ID. Please go back to <a href="view_schedules.php">Schedules</a>.</p>';
        } else {
            ?>
            <div class="schedule-details">
                <h3>Journey Details</h3>
                <p><strong>Route:</strong> <?php echo htmlspecialchars($current_schedule['origin']) . ' to ' . htmlspecialchars($current_schedule['destination']); ?></p>
                <p><strong>Departure:</strong> <?php echo htmlspecialchars($current_schedule['departure_time']); ?></p>
                <p><strong>Arrival:</strong> <?php echo htmlspecialchars($current_schedule['arrival_time']); ?></p>
                <p><strong>Bus Type:</strong> <?php echo htmlspecialchars($current_schedule['bus_type']); ?></p>
                <p><strong>Fare per seat:</strong> Ksh <?php echo number_format($current_schedule['fare']); ?></p>
                <p><strong>Total Seats:</strong> <?php echo htmlspecialchars($current_schedule['total_seats']); ?></p>
            </div>

            <div class="seat-selection-area">
                <h3>Choose Your Seats</h3>
                <div class="seat-map-wrapper">
                    <div class="bus-layout">
                        <div class="driver-door-label driver-label">DRIVER</div>
                        <div class="driver-door-label door-label">DOOR</div>
                        <?php
                        // Loop through seats 1 to 46 to create seat elements
                        for ($i = 1; $i <= $current_schedule['total_seats']; $i++) {
                            $is_booked = in_array($i, $booked_seats);
                            $seat_class = $is_booked ? 'booked' : ''; // Start with 'booked' if applicable
                            echo '<div class="seat ' . $seat_class . '" data-seat="' . $i . '">' . $i . '</div>';
                        }
                        ?>
                    </div>
                </div>

                <div class="seat-legend">
                    <div class="legend-item"><span class="legend-color available"></span> Available</div>
                    <div class="legend-item"><span class="legend-color selected"></span> Selected</div>
                    <div class="legend-item"><span class="legend-color booked"></span> Booked</div>
                </div>

                <div class="passenger-details-form" id="passenger-details-section">
                    <h3>Passenger Details (Main Contact)</h3>
                    <form id="booking-form" action="process_booking.php" method="POST">
                        <div class="form-group">
                            <label for="full_name">Full Name:</label>
                            <input type="text" id="full_name" name="full_name" required>
                            <small>As per ID/Passport</small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" id="email" name="email" required>
                            <small>For booking confirmation and updates</small>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" id="phone" name="phone" placeholder="e.g., +254712345678" required>
                            <small>Including country code (e.g., +254)</small>
                        </div>

                        <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>">
                        <input type="hidden" name="selected_seats" id="selected-seats-input">
                        <input type="hidden" name="total_fare" id="total-fare-input">

                        <div class="booking-summary">
                            <h3>Booking Summary</h3>
                            <p>Selected Seats: <span id="selected-seats-display">None</span></p>
                            <p>Total Fare: <span id="total-fare-display">Ksh 0</span></p>
                            <div class="proceed-btn-container">
                                <button type="submit" class="btn" id="proceed-to-payment-btn" disabled>Proceed to Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> Your Bus Line. All rights reserved.</p>
        <p>Located in Mombasa, Mombasa County, Kenya.</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seats = document.querySelectorAll('.seat');
            const selectedSeatsDisplay = document.getElementById('selected-seats-display');
            const totalFareDisplay = document.getElementById('total-fare-display');
            const selectedSeatsInput = document.getElementById('selected-seats-input');
            const totalFareInput = document.getElementById('total-fare-input');
            const proceedToPaymentBtn = document.getElementById('proceed-to-payment-btn');

            const fullNameInput = document.getElementById('full_name');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const passengerDetailsSection = document.getElementById('passenger-details-section');

            let selectedSeats = [];
            const farePerSeat = <?php echo $current_schedule['fare'] ?? 0; ?>;

            // Initially hide passenger details until seats are selected
            passengerDetailsSection.style.display = 'none';

            seats.forEach(seat => {
                seat.addEventListener('click', function() {
                    const seatNumber = parseInt(this.dataset.seat);

                    if (this.classList.contains('booked')) {
                        return; // Cannot select booked seats
                    }

                    if (this.classList.contains('selected')) {
                        // Deselect seat
                        this.classList.remove('selected');
                        selectedSeats = selectedSeats.filter(seat => seat !== seatNumber);
                    } else {
                        // Select seat
                        this.classList.add('selected');
                        selectedSeats.push(seatNumber);
                    }
                    updateSummaryAndFormVisibility();
                });
            });

            // Add event listeners to form fields for validation
            fullNameInput.addEventListener('input', updateSummaryAndFormVisibility);
            emailInput.addEventListener('input', updateSummaryAndFormVisibility);
            phoneInput.addEventListener('input', updateSummaryAndFormVisibility);


            function updateSummaryAndFormVisibility() {
                selectedSeats.sort((a, b) => a - b); // Sort for consistent display
                selectedSeatsDisplay.textContent = selectedSeats.length > 0 ? selectedSeats.join(', ') : 'None';

                const totalFare = selectedSeats.length * farePerSeat;
                totalFareDisplay.textContent = `Ksh ${totalFare.toLocaleString()}`;

                // Update hidden input fields for form submission
                selectedSeatsInput.value = JSON.stringify(selectedSeats); // Send as JSON string
                totalFareInput.value = totalFare;

                // Check form validity
                const isFormValid = fullNameInput.value.trim() !== '' &&
                                    emailInput.value.trim() !== '' && emailInput.checkValidity() &&
                                    phoneInput.value.trim() !== '';

                // Enable/disable proceed button based on seats selected AND form validity
                if (selectedSeats.length > 0 && isFormValid) {
                    proceedToPaymentBtn.removeAttribute('disabled');
                    passengerDetailsSection.style.display = 'block'; // Show form once seats are selected
                } else {
                    proceedToPaymentBtn.setAttribute('disabled', 'disabled');
                    if (selectedSeats.length === 0) {
                        passengerDetailsSection.style.display = 'none'; // Hide form if no seats selected
                    } else {
                         passengerDetailsSection.style.display = 'block'; // Keep form visible if seats selected but form not valid
                    }
                }
            }
        });
    </script>
</body>
</html>