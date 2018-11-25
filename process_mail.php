<?php 
date_default_timezone_set("Europe/Warsaw");
//if(strlen($_POST['phone'])==9){
$object = (object)[
'name' => $_POST['name'],
'title' => $_POST['title'],
'msg' => str_replace("\n.", "\n..", wordwrap($_POST['email'], 70, "\r\n")),
'date' => mktime ($_POST['hour'], $_POST['minute'], 0, $_POST['month'], $_POST['day'], $_POST['year']),
'phone' => $_POST['phone'],

];

$fp = fopen('/archives/mails.json', "a");
fwrite($fp, json_encode($object) . "\r\n");
fclose($fp);
header( 'Location: index.php?date='.$object->date);
//}
//else{
//	header('Location: index.php?date=fail');
//
//}
?>


