<?php
require_once('../../tcpdf/tcpdf.php');
require_once('config.php');

// -----------------------------
// SAFE GET PARAMETERS
// -----------------------------
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
$end_date   = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
$start_time = isset($_GET['start_time']) ? $_GET['start_time'] : '00:00:00';
$end_time   = isset($_GET['end_time']) ? $_GET['end_time'] : '23:30:00';

$from_datetime = $start_date . ' ' . $start_time;
$to_datetime   = $end_date . ' ' . $end_time;

// Sampling interval (seconds)
$sampling_interval_sec = 2;
$interval_hours = $sampling_interval_sec / 3600;

// -----------------------------
// FETCH SUMMARY
// -----------------------------
$summary_sql = "
    SELECT 
        SUM(solar_power) * $interval_hours AS total_solar_energy,
        SUM(battery_power) * $interval_hours AS total_battery_energy,
        AVG(battery_soc) AS avg_battery_soc,
        MAX(temperature) AS max_temp,
        MIN(temperature) AS min_temp,
        COUNT(*) AS total_readings
    FROM sensor_reading
    WHERE reading_time BETWEEN '$from_datetime' AND '$to_datetime'
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

        $this->SetX($xText);
        $this->Cell(0, 6, 'From: ' . $this->reportStart . ' To: ' . $this->reportEnd, 0, 1, 'L');

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

        $this->SetY(-($footerHeight + 7));
        if (file_exists($footerImage)) {
            $this->Image($footerImage, 15, $this->GetY(), $pageWidth - 30, $footerHeight);
        }

        $this->SetY(-($footerHeight / 2));
        $this->SetFont('helvetica', 'I', 8);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, 'Generated on ' . date('Y-m-d H:i:s'), 0, 0, 'R');
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
    [13, 110, 253], [25, 135, 84], [253, 126, 20],
    [220, 53, 69], [13, 202, 240], [108, 117, 125]
];
$summaryHeaders = [
    'Total Solar Energy (Wh)','Total Battery Energy (Wh)','Avg Battery SOC (%)',
    'Max Temp (°C)','Min Temp (°C)','Readings'
];
$summaryCellWidth = 45;
$summaryCellHeight = 12;

foreach ($summaryHeaders as $i => $header) {
    $pdf->SetFillColor($headerColors[$i][0], $headerColors[$i][1], $headerColors[$i][2]);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell($summaryCellWidth, $summaryCellHeight, $header, 1, 0, 'C', 1);
}
$pdf->Ln();

$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(0);
$pdf->SetFillColor(224,235,255);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, number_format($summary['total_solar_energy'],4),1,0,'C',1);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, number_format($summary['total_battery_energy'],4),1,0,'C',1);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, number_format($summary['avg_battery_soc'],2),1,0,'C',1);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, number_format($summary['max_temp'],2),1,0,'C',1);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, number_format($summary['min_temp'],2),1,0,'C',1);
$pdf->Cell($summaryCellWidth, $summaryCellHeight, $summary['total_readings'],1,1,'C',1);
$pdf->Ln(5);

// -----------------------------
// DETAILED TABLE WITH ROW NUMBERS
// -----------------------------
$pdf->SetFont('helvetica','B',14);
$pdf->SetTextColor(0,51,102);
$pdf->Cell(0,8,"Detailed Data Logs",0,1,'L');
$pdf->Ln(2);

$pdf->SetFont('helvetica','B',10);
$detailHeaders = [
    'No.', 'Solar V', 'Solar A', 'Solar W',
    'Battery V', 'Battery A', 'Battery W',
    'SOC %','Temp °C','Reading Time'
];
$detailHeaderColors = [
    [108,117,125],[13,110,253],[13,110,253],[13,110,253],
    [25,135,84],[25,135,84],[25,135,84],
    [253,126,20],[220,53,69],[108,117,125]
];
$detailCellWidth = 27;
$detailCellHeight = 12;

foreach($detailHeaders as $i => $header){
    $pdf->SetFillColor($detailHeaderColors[$i][0], $detailHeaderColors[$i][1], $detailHeaderColors[$i][2]);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell($detailCellWidth,$detailCellHeight,$header,1,0,'C',1);
}
$pdf->Ln();

$pdf->SetFont('helvetica','',9);
$pdf->SetTextColor(0);
$fillColors = [[224,235,255],[255,255,255]];
$rowIndex = 0;

if($data_result->num_rows>0){
    $no = 1;
    while($row = $data_result->fetch_assoc()){
        $fillColor = $fillColors[$rowIndex%2];
        $pdf->SetFillColor($fillColor[0],$fillColor[1],$fillColor[2]);

        $pdf->Cell($detailCellWidth,$detailCellHeight,$no,1,0,'C',1);
        $pdf->Cell($detailCellWidth,$detailCellHeight,number_format($row['solar_voltage'],2),1,0,'C',1);
        $pdf->Cell($detailCellWidth,$detailCellHeight,number_format($row['solar_current'],2),1,0,'C',1);
        $pdf->Cell($detailCellWidth,$detailCellHeight,number_format($row['solar_power'],2),1,0,'C',1);

        $pdf->Cell($detailCellWidth,$detailCellHeight,number_format($row['battery_voltage'],2),1,0,'C',1);
        $pdf->Cell($detailCellWidth,$detailCellHeight,number_format($row['battery_current'],2),1,0,'C',1);
        $pdf->Cell($detailCellWidth,$detailCellHeight,number_format($row['battery_power'],2),1,0,'C',1);

        $pdf->SetFont('helvetica','B',9);
        $pdf->Cell($detailCellWidth,$detailCellHeight,number_format($row['battery_soc'],2),1,0,'C',1);
        $pdf->SetFont('helvetica','',9);

        $pdf->Cell($detailCellWidth,$detailCellHeight,number_format($row['temperature'],2),1,0,'C',1);
        $pdf->Cell($detailCellWidth,$detailCellHeight,date('m/d/Y H:i',strtotime($row['reading_time'])),1,1,'C',1);

        $rowIndex++;
        $no++;
    }
}else{
    $pdf->SetFont('helvetica','I',10);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell($detailCellWidth*10,$detailCellHeight,"No data available",1,1,'C',1);
}

// -----------------------------
// OUTPUT PDF
// -----------------------------
$pdf->Output('Smart_Solar_Report.pdf','I');
exit;
