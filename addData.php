<?php
include("class.php");
include("connectMySQL.php");
echo "test";

$newAccount = new Account();
$newAccount->setAccount($_POST["accountInput"]);
$newAccount->setName($_POST["nameInput"]);
$newAccount->setGender($_POST["selectGender"]);
$newAccount->setBirthday($_POST["datepicker_add"]);
$newAccount->setMail($_POST["mailInput"]);
$newAccount->setNote($_POST["noteText"]);

$account = $newAccount->getAccount();
$name = $newAccount->getName();
$gender = $newAccount->getGender();
$birthday = $newAccount->getBirthday();
$mail = $newAccount->getMail();
$note = $newAccount->getNote();


$sql = "INSERT INTO `account_info` (`account`, `name`, `gender`, `birthday`, `mail`, `note`) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $db->prepare($sql);
$stmt->bind_param('ssssss', $account, $name, $gender, $birthday, $mail, $note);
$stmt->execute();
/*
if (mysqli_affected_rows($db)>0) {
    echo "我成功了";
}
*/
header("Location: test.php")
?>
