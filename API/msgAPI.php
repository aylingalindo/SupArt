<?php
session_start();
 include_once '../Consultas/msgConsult.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $message = new msgAPI();
    echo($action);

    switch ($action) {
        case 'getAll':
            $message->getConversations();
            break;
    }
}

class msgAPI {
    public function __construct() {
        
    }

    function getConversations(){
        $option = 1;
        $conversation = new Message();

		if (isset($_SESSION['usersAPI']['userID'])){
			$arrConvers = array();
			$arrConvers["convers"] = array();
			$_SESSION['messageAPI'] = array();

			$userID = $_SESSION['usersAPI']['userID'];

			$resultado = $conversation->msgManagement($option, $userID);
            echo json_encode($resultado);
            if(isset($resultado))
			{
				while($row = $resultado->fetch(PDO::FETCH_ASSOC))	
				{
					$conver = array(
						"conversationID" => $row['messageID'],
						"senderID" => $row['senderID'],
						"receiverID" => $row['receiverID'],
						"message" => $row['message'],
					);

					array_push($arrConvers["convers"], $conver);
				}
				$_SESSION['messageAPI'] = $arrConvers["convers"];
				echo json_encode($_SESSION['messageAPI']);
			} else {
				echo 'this is the result--->' . $resultado . '<---';
				echo json_encode(array('mensaje' => 'No hay elementos'));
			}
		} else {
            echo "no se proporcionan todos los datos necesarios";
		}
    }

}
?>