<?php
require('tcpdf/tcpdf.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'teacher');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Modify SQL query to include publication_date and join with users table
    $sql = "SELECT a.serial_number, a.title, a.form_of_work, a.publication_details, a.pages, a.co_authors, u.name as author_name 
            FROM articles a 
            JOIN users u ON a.user_id = u.id 
            WHERE a.publication_date BETWEEN '$start_date' AND '$end_date'";
    $result = $conn->query($sql);

    // Create new PDF document in landscape orientation
    $pdf = new TCPDF('L', 'mm', 'A4');
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Author');
    $pdf->SetTitle('Articles Report');
    $pdf->SetSubject('Articles from ' . $start_date . ' to ' . $end_date);
    $pdf->SetKeywords('TCPDF, PDF, articles, report');

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('dejavusans', '', 10);

    // Title
    $pdf->Cell(0, 10, "Articles from $start_date to $end_date", 0, 1, 'C');

    if ($result->num_rows > 0) {
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->Cell(10, 25, '№', 1);
        $pdf->Cell(60, 25, 'Title', 1);
        $pdf->Cell(25, 25, 'Form', 1);
        $pdf->Cell(60, 25, 'Details', 1);
        $pdf->Cell(20, 25, 'Pages', 1);
        $pdf->Cell(45, 25, 'Co-authors', 1);
        $pdf->Cell(40, 25, 'Author', 1);
        $pdf->Ln();

        while($row = $result->fetch_assoc()) {
            $pdf->MultiCell(10, 25, $row['serial_number'], 1, 'C', 0, 0);
            $pdf->MultiCell(60, 25, $row['title'], 1, 'L', 0, 0);
            $pdf->MultiCell(25, 25, $row['form_of_work'], 1, 'L', 0, 0);
            $pdf->MultiCell(60, 25, $row['publication_details'], 1, 'L', 0, 0);
            $pdf->MultiCell(20, 25, $row['pages'], 1, 'C', 0, 0);
            $pdf->MultiCell(45, 25, $row['co_authors'], 1, 'L', 0, 0);
            $pdf->MultiCell(40, 25, $row['author_name'], 1, 'L', 0, 1); // Last cell in row needs ln flag to be 1
        }

        // Output totals
        $pdf->Ln(10); // Add some space before the totals
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(0, 10, "Total Articles: " . $result->num_rows, 0, 1, 'L');
        $pdf->Cell(0, 10, "Total Pages: " . array_sum(array_column($result->fetch_all(MYSQLI_ASSOC), 'pages')), 0, 1, 'L');
    } else {
        $pdf->Cell(0, 10, 'No articles found.', 1, 1, 'C');
    }

    $conn->close();
    $pdf->Output('articles.pdf', 'D');
}
?>
