<?php
require_once 'controll.php';
$cont=new controller($_GET['action']);
$cont->run();
exit;
?>