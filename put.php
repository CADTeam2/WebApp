<?php

if(isset($_GET["submission"])) {
$question = $_GET['updatedq'];
$priority = $_GET['priority'];
$questionID = $_GET['user'];


$url = "https://cadgroup2.jdrcomputers.co.uk/api/questions/".$questionID;
$data = array('question'=>$question,'priority'=>$priority);
$data_json = json_encode($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);
header("Location: moderator.php?submission=success&sessionID={$sessionID}");
exit();
}

if(isset($_GET["delete"])) {
$question = $_GET['updatedq'];
$priority = $_GET['priority'];
$questionID = $_GET['user'];
$url = "https://cadgroup2.jdrcomputers.co.uk/api/questions/".$questionID;
$data = array('question'=>$question,'priority'=>$priority);
$data_json = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);
header("Location: moderator.php?submission=success&sessionID={$sessionID}");
exit();
}
?>
