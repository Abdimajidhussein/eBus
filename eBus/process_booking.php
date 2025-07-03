<?php
// Start a session to store temporary booking data (e.g., for confirmation page)
session_start();

// In a real application, you would include your database connection file here
// include 'db_connection.php';

// --- Simulate Database Data (replace with actual DB calls) ---
// This should ideally come from your 'schedules' table
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

// This should ideally come from your 'bookings' table
// We'll use a global variable to simulate changes for this session
// In a real app, this would be a DB query result

if (!isset($_SESSION['simulated_booked_seats'])) {
    $_SESSION['simulated_booked_seats'] = [
        101 => [1, 2, 5, 12, 16, 20, 25, 30, 35, 40], // Example booked seats for schedule 101
        103 => [3, 4, 6, 9, 10, 11, 13, 14, 15, 17, 18, 21, 22, 23, 24, 26, 27, 28, 29, 31, 32, 33, 34, 36, 37, 38, 39, 41, 42, 43, 44, 45, 46], // Many booked
    ];
}
// --- 1. Receive POST data ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $schedule_id = filter_input(INPUT_POST, 'schedule_id', FILTER_SANITIZE_NUMBER_INT);
    $selected_seats_json = filter_input(INPUT_POST, 'selected_seats', FILTER_UNSAFE_RAW); // It's JSON, raw is fine for now
    $total_fare_posted = filter_input(INPUT_POST, 'total_fare', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Keep original chars for phone number

    $errors = [];

    // --- 2. Server-side Validation ---
    // Validate schedule ID
    if (!isset($all_schedules[$schedule_id])) {
        $errors[] = "Invalid schedule ID.";
    } else {
        $current_schedule = $all_schedules[$schedule_id];
    }

    // Validate selected seats
    $selected_seats = json_decode($selected_seats_json, true);
    if (!is_array($selected_seats) || empty($selected_seats)) {
        $errors[] = "No seats selected.";
    }

    // Validate passenger details
    if (empty($full_name)) {
        $errors[] = "Full Name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email Address.";
    }
    if (empty($phone)) {
        $errors[] = "Phone Number is required.";
    }

    // Check if total fare matches calculated fare on server-side
    // This prevents users from manipulating fare via client-side
    if (isset($current_schedule) && is_array($selected_seats)) {
        $calculated_fare = count($selected_seats) * $current_schedule['fare'];
        if ($calculated_fare != $total_fare_posted) {
            $errors[] = "Fare mismatch. Please re-select your seats.";
        }
    }


    // --- 3. Server-side Availability Check (Crucial step!) ---
    if (empty($errors) && isset($current_schedule) && is_array($selected_seats)) {
        // Get currently booked seats for this specific schedule
        $current_booked_seats = $_SESSION['simulated_booked_seats'][$schedule_id] ?? [];

        foreach ($selected_seats as $seat) {
            if ($seat < 1 || $seat > $current_schedule['total_seats']) {
                $errors[] = "Selected seat " . htmlspecialchars($seat) . " is out of valid range.";
                break;
            }
            if (in_array($seat, $current_booked_seats)) {
                $errors[] = "Seat " . htmlspecialchars($seat) . " is already booked by another user. Please choose a different seat.";
                break; // Stop and report error
            }
        }
    }

    // If no errors, proceed with simulated booking
    if (empty($errors)) {
        // --- Simulate Database Transaction ---
        // In a real application:
        // 1. Start a database transaction.
        // 2. Insert booking into `bookings` table.
        // 3. Update `bus_seats` table to mark seats as occupied (or decrement available_seats in schedules).
        // 4. Commit transaction if all successful, rollback if any error.

        // Simulate booking ID
        $booking_id = "BUS" . strtoupper(uniqid());
        $booking_date = date("Y-m-d H:i:s");

        // Simulate marking seats as booked in our session
        foreach ($selected_seats as $seat) {
            $_SESSION['simulated_booked_seats'][$schedule_id][] = $seat;
        }

        // Store booking details in session for confirmation page
        $_SESSION['booking_details'] = [
            'booking_id' => $booking_id,
            'full_name' => $full_name,
            'email' => $email,
            'phone' => $phone,
            'schedule' => $current_schedule,
            'selected_seats' => $selected_seats,
            'total_fare' => $calculated_fare,
            'booking_date' => $booking_date
        ];

        // --- Simulate Payment Gateway Redirect ---
        // In a real scenario, you'd integrate with M-Pesa, Stripe, PayPal, etc.
        // This usually involves sending payment details to the gateway and waiting for a callback.
        // For this simulation, we'll assume immediate success.

        // Redirect to a success/confirmation page
        header("Location: booking_confirmation.php");
        exit();

    } else {
        // Store errors in session to display on book_now.php or a dedicated error page
        $_SESSION['booking_errors'] = $errors;
        // Redirect back to book_now.php with the errors, or a generic error page
        header("Location: book_now.php?schedule_id=" . $schedule_id . "&error=1");
        exit();
    }

} else {
    // If accessed directly without POST data, redirect to schedules page
    header("Location: view_schedules.php");
    exit();
}
?>