<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "smart_solar");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get start and end dates from GET parameters
$startDate = isset($_GET['start']) ? $_GET['start'] : null;
$endDate   = isset($_GET['end']) ? $_GET['end'] : null;

if (!$startDate || !$endDate) {
    echo json_encode(['error' => 'Invalid date range']);
    exit;
}

// Convert to full datetime
$start = $startDate . " 00:00:00";
$end   = $endDate . " 23:59:59";

// Initialize totals
$totalSolar = 0;
$totalBattery = 0;

// Query readings for the range
$sql = "SELECT solar_power, battery_power, reading_time
        FROM sensor_reading
        WHERE reading_time BETWEEN ? AND ?
        ORDER BY reading_time ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start, $end);
$stmt->execute();
$res = $stmt->get_result();

// Time-weighted energy calculation
$prevTime = null;
while ($row = $res->fetch_assoc()) {
    $curTime = strtotime($row['reading_time']);
    if ($prevTime !== null) {
        $diffSec = min($curTime - $prevTime, 3600); // cap at 1 hour
        $totalSolar   += $row['solar_power'] * ($diffSec / 3600);
        $totalBattery += $row['battery_power'] * ($diffSec / 3600);
    }
    $prevTime = $curTime;
}

// Return JSON response
echo json_encode([
    'solar'   => round($totalSolar, 3),
    'battery' => round($totalBattery, 3)
]);

$conn->close();
?>
