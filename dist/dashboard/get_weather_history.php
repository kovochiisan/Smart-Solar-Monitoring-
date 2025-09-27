<?php
header('Content-Type: application/json');

$mysqli = new mysqli("localhost", "root", "", "smart_solar");
if ($mysqli->connect_error) {
    die(json_encode(['error' => $mysqli->connect_error]));
}

$span = $_GET['span'] ?? 'daily';
$data = [];

if ($span === 'hourly') {
    // Last 24 hours, every reading (5-min intervals * 24h = 288)
    $result = $mysqli->query("SELECT time, temperature FROM weather_history ORDER BY time DESC LIMIT 288");
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} elseif ($span === 'daily') {
    // Average per day, last 7 days
    $result = $mysqli->query("
        SELECT DATE(time) AS day, AVG(temperature) AS temperature
        FROM weather_history
        GROUP BY DATE(time)
        ORDER BY day DESC
        LIMIT 7
    ");
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'time' => $row['day'],
            'temperature' => round($row['temperature'], 1)
        ];
    }
    // Reverse to have oldest → newest
    $data = array_reverse($data);
} elseif ($span === 'weekly') {
    // Average per week, last 4 weeks
    $result = $mysqli->query("
        SELECT YEAR(time) AS yr, WEEK(time,1) AS week_number, AVG(temperature) AS avg_temp
        FROM weather_history
        GROUP BY YEAR(time), WEEK(time,1)
        ORDER BY YEAR(time) DESC, WEEK(time,1) DESC
        LIMIT 4
    ");
    $weeklyData = [];
    while ($row = $result->fetch_assoc()) {
        $weeklyData[] = [
            'week_number' => $row['week_number'],
            'avg_temp' => round($row['avg_temp'], 1)
        ];
    }
    // Reverse to have oldest → newest
    $data = array_reverse($weeklyData);
} elseif ($span === 'monthly') {
    // Average per month, last 12 months
    $result = $mysqli->query("
        SELECT YEAR(time) AS yr, MONTH(time) AS month_number, AVG(temperature) AS avg_temp
        FROM weather_history
        GROUP BY YEAR(time), MONTH(time)
        ORDER BY YEAR(time) DESC, MONTH(time) DESC
        LIMIT 12
    ");
    $monthlyData = [];
    while ($row = $result->fetch_assoc()) {
        $monthlyData[] = [
            'month_number' => $row['month_number'],
            'avg_temp' => round($row['avg_temp'], 1)
        ];
    }
    // Reverse to have oldest → newest
    $data = array_reverse($monthlyData);
}

echo json_encode($data);
?>
