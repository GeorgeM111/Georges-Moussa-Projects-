<?php
if(isset($_POST['cartItems'])) {
    // Decode the JSON string to retrieve the array
    $cartItems = json_decode($_POST['cartItems'], true);

	$total = 0; $sum=0;
	require("fpdf/fpdf.php");

	// Create a new PDF instance
	$pdf = new FPDF();
	$pdf->AddPage();

	$pdf->SetFont('Arial', '', 12);
	$pdf->Cell(170, 10, "Cart Items", 1, 1, 'C'); // Add line break after this row
	// Output header row
    $pdf->Cell(50, 10, "Name", 1, 0, 'C');
    $pdf->Cell(30, 10, "Price", 1, 0, 'C');
    $pdf->Cell(30, 10, "Cover", 1, 0, 'C');
    $pdf->Cell(30, 10, "Quantity", 1, 0, 'C');
    $pdf->Cell(30, 10, "Total", 1, 1, 'C');
    
    // Output cart items
    foreach($cartItems as $item) {
        $name = $item['name'];
        $cover = $item['cover'];
        $price= $item['price'];
        $quantity= $item['quantity'];
        $total = $price * $quantity;
		$sum+= $total;
		
        // Output item details
        $pdf->Cell(50, 10, $name, 1, 0, 'C');
        $pdf->Cell(30, 10, $price, 1, 0, 'C');
        $pdf->Cell(30, 10, $cover, 1, 0, 'C');
        $pdf->Cell(30, 10, $quantity, 1, 0, 'C');
        $pdf->Cell(30, 10, $total, 1, 1, 'C');
    }

		$pdf->Cell(50, 10, '', 1, 0, 'C');
        $pdf->Cell(30, 10, '', 1, 0, 'C');
        $pdf->Cell(30, 10, '', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Total Price', 1, 0, 'C');
        $pdf->Cell(30, 10, $sum, 1, 1, 'C');
		
	$file = time() . '.pdf';
	$pdf->Output($file, 'D'); // Output PDF as download
    // Now $cartItems is an array containing the cart items
    // Process the array and generate the PDF
} else {
    echo "Error: No data received.";
}


?>
