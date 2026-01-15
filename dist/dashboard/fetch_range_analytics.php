<?php
$conn = new mysqli("localhost", "root", "", "smart_solar");
if ($conn->connect_error) die(json_encode(['error' => 'DB connection failed']));

$startDate = $_GET['start'] ?? null;
$endDate   = $_GET['end'] ?? null;

if (!$startDate || !$endDate) {
    echo json_encode(['error' => 'Invalid date range']);
    exit;
}

$start = $startDate . " 00:00:00";
$end   = $endDate . " 23:59:59";

$sql = "SELECT solar_power, battery_power, reading_time
        FROM sensor_reading
        WHERE reading_time BETWEEN ? AND ?
        ORDER BY reading_time ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start, $end);
$stmt->execute();
$res = $stmt->get_result();

$labels = [];
$solarSeries = [];
$batterySeries = [];

$totalSolar = 0;
$totalBattery = 0;

$prevTime = null;

while ($row = $res->fetch_assoc()) {
    $labels[] = date("M d H:i", strtotime($row['reading_time']));
    $solarSeries[] = (float)$row['solar_power'];
    $batterySeries[] = (float)$row['battery_power'];

    // Energy calculation (Wh)
    $curTime = strtotime($row['reading_time']);
    if ($prevTime !== null) {
        $diffSec = min($curTime - $prevTime, 3600);
        $totalSolar   += $row['solar_power'] * ($diffSec / 3600);
        $totalBattery += $row['battery_power'] * ($diffSec / 3600);
    }
    $prevTime = $curTime;
}

echo json_encode([
    'labels'        => $labels,
    'solarSeries'   => $solarSeries,
    'batterySeries' => $batterySeries,
    'totalSolar'    => round($totalSolar, 3),
    'totalBattery'  => round($totalBattery, 3)
]);

$conn->close();
