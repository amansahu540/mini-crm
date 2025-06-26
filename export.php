<?php
include 'config.php';
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=clients.csv');

$output = fopen("php://output", "w");
fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Company', 'Notes', 'Created At']);

$result = $conn->query("SELECT * FROM clients");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}
fclose($output);
?>
