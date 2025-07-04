<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Schedules - Your Bus Line</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <?php include 'includes/Header.php'; ?>

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

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 4px 15px var(--shadow);
            margin-top: 100px;
        }

        h2.section-title {
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

        .schedules-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .schedules-table th,
        .schedules-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--mid-gray);
        }

        .schedules-table th {
            background-color: var(--primary-color);
            color: var(--white);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
        }

        .schedules-table tr:nth-child(even) {
            background-color: #f2f2f2; /* Lighter shade for even rows */
        }

        .schedules-table tr:hover {
            background-color: #e0e0e0; /* Hover effect for rows */
        }

        .schedules-table td {
            font-size: 0.95em;
            color: var(--text-color);
        }

        .schedules-table .fare {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1em;
        }

        .schedules-table .availability {
            font-weight: 600;
        }

        .schedules-table .availability.available {
            color: var(--accent-color); /* Use accent color for available */
        }
        .schedules-table .availability.limited {
            color: orange;
        }
        .schedules-table .availability.booked {
            color: red;
        }

        .btn {
            background-color: var(--accent-color);
            color: var(--white);
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
            font-size: 0.9em;
        }

        .btn:hover {
            background-color: #e05e54;
            transform: translateY(-2px);
        }

        .no-schedules {
            text-align: center;
            padding: 50px;
            color: #777;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="section-title">Bus Schedules</h2>

        <?php
        // Simulate fetching bus schedules from a database
        // In a real application, you would connect to a database and query data
        $schedules = [
            [
                'id' => 101,
                'origin' => 'Mombasa',
                'destination' => 'Garissa',
                'departure_time' => '07:00 AM',
                'arrival_time' => '02:00 PM',
                'bus_type' => 'Luxury Coach',
                'fare' => 'Ksh 2,500',
                'available_seats' => 25,
            ],
            [
                'id' => 102,
                'origin' => 'Garissa',
                'destination' => 'Mombasa',
                'departure_time' => '08:30 AM',
                'arrival_time' => '03:30 PM',
                'bus_type' => 'Standard Express',
                'fare' => 'Ksh 2,200',
                'available_seats' => 10, // Limited seats
            ],
            [
                'id' => 103,
                'origin' => 'Nairobi',
                'destination' => 'Garissa',
                'departure_time' => '09:00 AM',
                'arrival_time' => '04:00 PM',
                'bus_type' => 'VIP Shuttle',
                'fare' => 'Ksh 1,800',
                'available_seats' => 5, // Very limited seats
            ],
            [
                'id' => 104,
                'origin' => 'Garissa',
                'destination' => 'Nairobi',
                'departure_time' => '10:00 AM',
                'arrival_time' => '05:00 PM',
                'bus_type' => 'Luxury Coach',
                'fare' => 'Ksh 1,900',
                'available_seats' => 0, // Fully booked
            ],
            [
                'id' => 105,
                'origin' => 'Mombasa',
                'destination' => 'Nairobi',
                'departure_time' => '06:00 AM',
                'arrival_time' => '01:00 PM',
                'bus_type' => 'Standard Express',
                'fare' => 'Ksh 1,500',
                'available_seats' => 30,
            ],
            [
                'id' => 106,
                'origin' => 'Nairobi',
                'destination' => 'Mombasa',
                'departure_time' => '10:00 PM',
                'arrival_time' => '05:00 AM', // Next day
                'bus_type' => 'Night Sleeper',
                'fare' => 'Ksh 1,700',
                'available_seats' => 15,
            ]
        ];

        if (!empty($schedules)) {
            echo '<table class="schedules-table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Route</th>';
            echo '<th>Departure</th>';
            echo '<th>Arrival</th>';
            echo '<th>Bus Type</th>';
            echo '<th>Fare</th>';
            echo '<th>Available Seats</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($schedules as $schedule) {
                $availabilityClass = '';
                $actionButton = '';

                if ($schedule['available_seats'] > 10) {
                    $availabilityClass = 'available';
                    $actionButton = '<a href="book_now.php?schedule_id=' . $schedule['id'] . '" class="btn">Book Now</a>';
                } elseif ($schedule['available_seats'] > 0) {
                    $availabilityClass = 'limited';
                    $actionButton = '<a href="book_now.php?schedule_id=' . $schedule['id'] . '" class="btn">Book Now</a>';
                } else {
                    $availabilityClass = 'booked';
                    $actionButton = '<span class="btn" style="background-color: #6c757d; cursor: not-allowed;">Fully Booked</span>';
                }

                echo '<tr>';
                echo '<td>' . htmlspecialchars($schedule['origin']) . ' to ' . htmlspecialchars($schedule['destination']) . '</td>';
                echo '<td>' . htmlspecialchars($schedule['departure_time']) . '</td>';
                echo '<td>' . htmlspecialchars($schedule['arrival_time']) . '</td>';
                echo '<td>' . htmlspecialchars($schedule['bus_type']) . '</td>';
                echo '<td class="fare">' . htmlspecialchars($schedule['fare']) . '</td>';
                echo '<td class="availability ' . $availabilityClass . '">';
                echo ($schedule['available_seats'] > 0) ? htmlspecialchars($schedule['available_seats']) . ' Seats' : 'Fully Booked';
                echo '</td>';
                echo '<td>' . $actionButton . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p class="no-schedules">No bus schedules available at the moment. Please check back later.</p>';
        }
        ?>
    </div>
    <?php include 'includes/footer.php'; ?>

</body>
</html>