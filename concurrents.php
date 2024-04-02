<?php
	include_once('triathlonDAO.inc.php');
	try {
		$request_method = $_SERVER["REQUEST_METHOD"];
		switch($request_method)
		{
			case 'GET':
				getConcurrents();
				break;
			
			case 'PUT':
				putConcurrents();
				break;
				
			default:
				http_response_code(405);
				break;
		}
	} 
	catch (Exception $e) {
		echo $e->getMessage();
		http_response_code(500);
	}
	
	// requête GET localhost/APITriathlon/concurrents
	function getConcurrents()
	{
		header('Content-type: application/json');
		$triathlonDAO = new TriathlonDAO();
		$lesConcurrents = $triathlonDAO->getAllConcurrents();
		echo json_encode($lesConcurrents);
	}

	// requête PUT localhost/APITriathlon/concurrents
	function putConcurrents() 
	{
		$triathlonDAO = new TriathlonDAO();
		$json = file_get_contents('php://input');
		if (!empty($json)) {
			$obj = json_decode($json);
			if (property_exists($obj, "Concurrents")) {
				$res = $obj->Concurrents;
				$messageInfo = "";
				foreach ($res as $unConcurrent) {
					if (property_exists($unConcurrent, "dossard") && property_exists($unConcurrent, "natation")
						&& property_exists($unConcurrent, "cyclisme") && property_exists($unConcurrent, "course")) {
						$dossard = $unConcurrent->dossard;
						$natation = $unConcurrent->natation;
						$cyclisme = $unConcurrent->cyclisme;
						$course = $unConcurrent->course;
						$triathlonDAO->updateConcurrent($dossard, $natation, $cyclisme, $course);
						$messageInfo .= "Concurrent " . $dossard . " modifié avec succès. ";
					}
				}
				header('Content-Type: application/json');
				echo json_encode($messageInfo);
				http_response_code(200);
			}
		}
		else {
			header('Content-Type: application/json');
			echo json_encode("JSON Object empty");
			http_response_code(400);
		}
	}
?>