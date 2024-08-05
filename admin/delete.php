<?php
include '../koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM list_kodam WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: homepage.php");
exit();
?>
