<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	header('Content-Type: application/json;charset=utf-8');
	require 'vendor/autoload.php';
	
	
	$app = new \Slim\App();
	
	function dbConnect(){
		$host='127.0.0.1';
		$user='root';
		$pass='';
		$dbname='token';
		$pdo= new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $pdo;
	}
	
	$app->get('/', function (Request $request, Response $response) {
		
		$data = array('name' => 'Thiago', 'app' => 'SlimApp', 'Hellow' => 'Word');
		$newResponse = $response->withJson($data);
		
		return $newResponse;
	});
	
	$app->get('/insert/', function (Request $request, Response $response) {
		
		$pdo = dbConnect();
		$stmt = $pdo->prepare("INSERT INTO test (pew, pie) VALUES (?, ?)");

		$stmt->bindParam(1, $f);
		$stmt->bindParam(2, $s);
		
		$f = 'pew';
		$s = 'diepie';
	
		
		$stmt->execute();
		
		$response->getBody()->write('ok');
		
		return $response;
	});
	
	$app->get('/select/', function (Request $request, Response $response) {
		
		$pdo = dbConnect();
		$q = $pdo->query('SELECT * from test');
		$result = $q->fetchAll();
		$newResponse = $response->withJson($result);
		return $newResponse;
	});
	
	
	$app->run();
?>