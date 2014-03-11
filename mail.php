<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$name = @trim($_POST['name']);
$site = @trim($_POST['site']);
$adress = @trim($_POST['adress']);
$tel = @trim($_POST['tel']);

header('Content-Type: application/json; charset=utf-8');

if($name == '' || $tel == '') {
    echo json_encode(array('success'    => false));
    exit;
} 
$name = mb_convert_encoding($name, "cp1251", "utf8");
$adress = mb_convert_encoding($adress, "cp1251", "utf8");

$to = "goshazvir@gmail.com";
$headers ="From: <$to>\n";
$headers.="X-Mailer: PHP/".phpversion()."\n";
$headers.="Content-Type: text/html; charset=cp1251";
$subject = "������ ��: ";
$message = "
<table>
<tr>
    <td><strong>���:</strong></td>
    <td> $name </td>
</tr>
<tr>
    <td><strong>�������:</strong></td>
    <td> $tel </td>
</tr>
<tr>
    <td><strong>�����:</strong></td>
    <td> $adress </td>
</tr>
<tr>
    <td><strong>����:</strong></td>
    <td> $site </td>
</tr>
</table>";
$send = mail($to, $subject, $message, $headers);
if ($send == 'true')
{
    echo json_encode(array('success'    => true));
    exit;
} else {
    echo json_encode(array('success'    => false));
    exit;
}
?>