<?php
include("connectMySQL.php");

echo "test";

$account = $_POST['deleteAccount'];
echo $account;

$sql = "DELETE FROM account_info WHERE account = ?";

$stmt = $db->prepare($sql);
$stmt->bind_param('s', $account);
$stmt->execute();

if (mysqli_affected_rows($db)>0) {
    echo "ζζεδΊ";
}

header("Location: test.php")
?>