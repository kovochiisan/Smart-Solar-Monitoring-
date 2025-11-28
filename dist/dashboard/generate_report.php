<?php
require_once('../../tcpdf/tcpdf.php');
require_once('config.php');

// -----------------------------
// SET TIMEZONE
// -----------------------------
date_default_timezone_set('Asia/Manila');

// -----------------------------
// SAFE GET PARAMETERS
// -----------------------------
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
$end_date   = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
$start_time = isset($_GET['start_time']) ? $_GET['start_time'] : '00:00:00';
$end_time   = isset($_GET['end_time']) ? $_GET['end_time'] : '23:30:00';

$from_datetime = $start_date . ' ' . $start_time;
$to_datetime   = $end_date . ' ' . $end_time;

// -----------------------------
// FETCH SUMMARY WITH CAPPED TIME
// -----------------------------
$summary_sql = "
SELECT 
    SUM(energy_wh) AS total_solar_energy,
    SUM(battery_energy_wh) AS total_battery_energy,
    AVG(battery_soc) AS avg_battery_soc,
    MAX(temperature) AS max_temp,
    MIN(temperature) AS min_temp,
    COUNT(*) AS total_readings
FROM (
    SELECT 
        solar_power,
        battery_power,
        battery_soc,
        temperature,
        reading_time,
        LAG(reading_time) OVER (ORDER BY reading_time) AS prev_time,
        IF(
            LAG(reading_time) OVER (ORDER BY reading_time) IS NULL,
            0,
            solar_power * LEAST(
                TIMESTAMPDIFF(SECOND, LAG(reading_time) OVER (ORDER BY reading_time), reading_time),
                3600
            ) / 3600
        ) AS energy_wh,
        IF(
            LAG(reading_time) OVER (ORDER BY reading_time) IS NULL,
            0,
            battery_power * LEAST(
                TIMESTAMPDIFF(SECOND, LAG(reading_time) OVER (ORDER BY reading_time), reading_time),
                3600
            ) / 3600
        ) AS battery_energy_wh
    FROM sensor_reading
    WHERE reading_time BETWEEN '$from_datetime' AND '$to_datetime'
) AS subquery
";

$summary = $conn->query($summary_sql)->fetch_assoc();


// -----------------------------
// FETCH DETAILED DATA
// -----------------------------
$data_sql = "
    SELECT * FROM sensor_reading
    WHERE reading_time BETWEEN '$from_datetime' AND '$to_datetime'
    ORDER BY reading_time ASC
";
$data_result = $conn->query($data_sql);

// -----------------------------
// CUSTOM TCPDF CLASS
// -----------------------------
class CustomPDF extends TCPDF
{
    public $reportStart;
    public $reportEnd;

    public function Header()
    {
        $headerImage = __DIR__ . '/../../images/LogoWhiteBG.jpg';
        $pageWidth = $this->getPageWidth();
        $logoWidth = 30;
        $xLogo = 15;
        $yLogo = 10;
        if (file_exists($headerImage)) {
            $this->Image($headerImage, $xLogo, $yLogo, $logoWidth);
        }

        $xText = $xLogo + $logoWidth + 5;
        $this->SetX($xText);

        $this->SetFont('helvetica', 'B', 14);
        $this->SetTextColor(0, 51, 102);
        $this->Cell(0, 7, 'Smart Solar Monitoring', 0, 1, 'L');

        $this->SetFont('helvetica', '', 12);
        $this->SetX($xText);
        $this->Cell(0, 6, 'Data Logs', 0, 1, 'L');

        $fromFormatted = date('m/d/y h:i A', strtotime($this->reportStart));
        $toFormatted   = date('m/d/y h:i A', strtotime($this->reportEnd));
        $this->SetX($xText);
        $this->Cell(0, 6, 'From: ' . $fromFormatted . ' To: ' . $toFormatted, 0, 1, 'L');

        $this->SetDrawColor(0, 51, 102);
        $this->SetLineWidth(0.4);
        $this->Line(15, $yLogo + 22, $pageWidth - 15, $yLogo + 22);
        $this->Ln(5);
    }

    public function Footer()
    {
        $footerImage = __DIR__ . '/../../images/footer.jpg';
        $pageWidth = $this->getPageWidth();
        $footerHeight = 15;

        $this->SetY(- ($footerHeight + 7));
        if (file_exists($footerImage)) {
            $this->Image($footerImage, 15, $this->GetY(), $pageWidth - 30, $footerHeight);
        }

        $this->SetY(- ($footerHeight / 2));
        $this->SetFont('helvetica', 'I', 8);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, 'Generated on ' . date('Y-m-d h:i:s A'), 0, 0, 'R');
    }
}

// -----------------------------
// PDF SETUP
// -----------------------------
$pdf = new CustomPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->reportStart = $from_datetime;
$pdf->reportEnd   = $to_datetime;

$pdf->SetCreator('Smart Solar Monitoring');
$pdf->SetTitle("Solar Data Report");
$pdf->SetMargins(15, 35, 15);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(15);
$pdf->SetAutoPageBreak(TRUE, 20);

$pdf->AddPage();

// -----------------------------
// SUMMARY TABLE
// -----------------------------
$pdf->SetFont('helvetica', 'B', 16);
$pdf->SetTextColor(0, 51, 102);
$pdf->Cell(0, 10, "Summary Totals", 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('helvetica', 'B', 10);
$headerColors = [
    [13, 110, 253],
    [25, 135, 84],
    [253, 126, 20],
    [220, 53, 69],
    [13, 202, 240],
    [108, 117, 125]
];
$summaryHeaders = [
    'Total Solar Energy (Wh)',
    'Total Battery Energy (Wh)',
    'Avg Battery SOC (%)',
    'Max Temp (°C)',
    'Min Temp (°C)',
    'Readings'
];
$summaryCellWidth = 44.5;
$summaryCellHeight = 12;

foreach ($summaryHeaders as $i => $header) {
    $pdf->SetFillColor($headerColors[$i][0], $headerColors[$i][1], $headerColors[$i][2]);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell($summaryCellWidth, $summaryCellHeight, $header, 1, 0, 'C', 1);
}
$pdf->Ln();

$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(0);
$pdf->SetFillColor(224, 235, 255);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, number_format($summary['total_solar_energy'], 4), 1, 0, 'C', 1);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, number_format($summary['total_battery_energy'], 4), 1, 0, 'C', 1);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, number_format($summary['avg_battery_soc'], 2), 1, 0, 'C', 1);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, number_format($summary['max_temp'], 2), 1, 0, 'C', 1);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, number_format($summary['min_temp'], 2), 1, 0, 'C', 1);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, $summary['total_readings'], 1, 1, 'C', 1);
$pdf->Ln(5);

// -----------------------------
// DETAILED TABLE
$pdf->SetFont('helvetica', 'B', 14);
$pdf->SetTextColor(0, 51, 102);
$pdf->Cell(0, 8, "Detailed Data Logs", 0, 1, 'L');
$pdf->Ln(2);

$pdf->SetFont('helvetica', 'B', 10);
$detailHeaders = ['No.', 'Solar V', 'Solar A', 'Solar W', 'Battery V', 'Battery A', 'Battery W', 'SOC %', 'Temp °C', 'Reading Time'];
$detailHeaderColors = [
    [108, 117, 125],
    [13, 110, 253],
    [13, 110, 253],
    [13, 110, 253],
    [25, 135, 84],
    [25, 135, 84],
    [25, 135, 84],
    [253, 126, 20],
    [220, 53, 69],
    [108, 117, 125]
];

// Set widths
$noCellWidth = 10;             // "No." column
$groupCellWidth = 26;          // grouped 8 columns
$readingTimeWidth = 50;        // separate for reading time
$detailCellHeight = 12;
$fillColors = [[224, 235, 255], [255, 255, 255]];

// Table header
foreach ($detailHeaders as $i => $header) {
    $pdf->SetFillColor($detailHeaderColors[$i][0], $detailHeaderColors[$i][1], $detailHeaderColors[$i][2]);
    $pdf->SetTextColor(255, 255, 255);

    if ($i == 0) $width = $noCellWidth;
    elseif ($i == 9) $width = $readingTimeWidth; // Reading Time
    else $width = $groupCellWidth;            // all other columns

    $pdf->Cell($width, $detailCellHeight, $header, 1, 0, 'C', 1);
}
$pdf->Ln();

// Table rows
if ($data_result->num_rows > 0) {
    $no = 1;
    $rowIndex = 0;
    while ($row = $data_result->fetch_assoc()) {
        $fillColor = $fillColors[$rowIndex % 2];
        $pdf->SetFillColor($fillColor[0], $fillColor[1], $fillColor[2]);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('helvetica', '', 9);

        $pdf->Cell($noCellWidth, $detailCellHeight, $no, 1, 0, 'C', 1);

        // grouped columns
        $pdf->Cell($groupCellWidth, $detailCellHeight, number_format($row['solar_voltage'], 2), 1, 0, 'C', 1);
        $pdf->Cell($groupCellWidth, $detailCellHeight, number_format($row['solar_current'], 2), 1, 0, 'C', 1);
        $pdf->Cell($groupCellWidth, $detailCellHeight, number_format($row['solar_power'], 2), 1, 0, 'C', 1);
        $pdf->Cell($groupCellWidth, $detailCellHeight, number_format($row['battery_voltage'], 2), 1, 0, 'C', 1);
        $pdf->Cell($groupCellWidth, $detailCellHeight, number_format($row['battery_current'], 2), 1, 0, 'C', 1);
        $pdf->Cell($groupCellWidth, $detailCellHeight, number_format($row['battery_power'], 2), 1, 0, 'C', 1);
        $pdf->Cell($groupCellWidth, $detailCellHeight, number_format($row['battery_soc'], 2), 1, 0, 'C', 1);
        $pdf->Cell($groupCellWidth, $detailCellHeight, number_format($row['temperature'], 2), 1, 0, 'C', 1);

        // Reading Time
        $pdf->Cell($readingTimeWidth, $detailCellHeight, date('m/d/y h:i:s A', strtotime($row['reading_time'])), 1, 1, 'C', 1);

        $rowIndex++;
        $no++;
    }
} else {
    $pdf->SetFont('helvetica', 'I', 10);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell($noCellWidth + $groupCellWidth * 8 + $readingTimeWidth, $detailCellHeight, "No data available", 1, 1, 'C', 1);
}


// -----------------------------
// OUTPUT PDF
// -----------------------------
$pdf->Output('Smart_Solar_Report.pdf', 'I');
exit;
