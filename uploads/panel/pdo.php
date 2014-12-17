<?php
require ('./include/init.inc.php');
try {
	$pdo = new PDO('mysql:host=' . OSA_DB_URL . ';dbname=' . OSA_DB_NAME , OSA_USER_NAME,OSA_PASSWORD);
	$pdo->exec('SET NAMES \'UTF8\'');
	$result = $pdo->query("select now()");
	$row = $result->fetch();
	var_dump($row);
}
catch (PDOException $e) {
	echo $e->getMessage();
}

?>
