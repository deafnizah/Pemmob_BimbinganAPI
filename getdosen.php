<?php
require 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT user_id, username, email FROM users WHERE role = 'lecturer'");
$lecturers = [];

while ($row = mysqli_fetch_assoc($query)) {
    $lecturers[] = $row;
}

echo json_encode($lecturers);
echo mysqli_error($koneksi);
?>

