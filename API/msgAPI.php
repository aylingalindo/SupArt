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
		case 'chat':
			$message->newChat();
			break;
		case 'startChat':
			$message->startChat();
			break;
		case 'getChat':
			$message->getChat();
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

	/*	=================================================================
		=== Function to set global variables on possible current chat === 
	    ================================================================= */
	function newChat(){
		$option = 3;
		$chat = new Message();

		echo 'producto';
		echo $_POST['idProducto'];
		echo 'vendedor';
		echo $_POST['idVendedor'];
		echo 'usuario';
		echo $_SESSION['usersAPI']['userID'];

		if (isset($_SESSION['usersAPI']['userID']) && isset($_POST['idProducto']) && isset($_POST['idVendedor'])){
			//initialize arrays	
			$arrChat = array();
			$arrChat["chat"] = array();
			$_SESSION['chatAPI'] = array();

			//Set variables from product page
			$producto = $_POST['idProducto'];
			$vendedor = $_POST['idVendedor'];
			$userID = $_SESSION['usersAPI']['userID'];

			//get the product name
			$resultado = $chat->msgManagement($option, 'null', 'null', 'null', 'null', $producto);
			echo json_encode($resultado);
            
			if(isset($resultado))
			{
				//set current chat info into session variable
				while($row = $resultado->fetch(PDO::FETCH_ASSOC))	
				{
					$_chat = array(
					"senderID" => $userID,
					"receiverID" => $vendedor,
					"producto" => $producto,
					"nombreProducto" => $row['name']
				);

				array_push($arrChat["chat"], $_chat);
				}

				$_SESSION['chatAPI'] = $arrChat["chat"];
				echo json_encode($_SESSION['chatAPI']); 

			} else {
				echo 'this is the result--->' . $resultado . '<---';
				echo json_encode(array('mensaje' => 'No hay elementos'));
			}
		} else {
			echo "no se proporcionan todos los datos necesarios";
		}
	}

	/*	========================================================
		=== Function to send default first message into chat === 
	    ======================================================== */
	function startChat(){
		$option = 2;
		$chat = new Message();
        
		// set session variables into local variables
		$currentUser = $_SESSION['chatAPI'][0]['senderID'];
		$seller = $_SESSION['chatAPI'][0]['receiverID'];
		$product = $_SESSION['chatAPI'][0]['producto'];
		$message = "'". $_POST['message'] . " " . $_SESSION['chatAPI'][0]['nombreProducto']. "'";


        echo 'Adding to chat';
        if (isset($currentUser) && isset($seller) && isset($product) && isset($message)) 
        {
            $resultado = $chat->msgManagement($option, $currentUser, $seller, 'null', $message, $product);
            echo json_encode($resultado);
			echo 'succesfully added message';
        } else {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
        }
	}

	/*	========================================================
		====  Function to get all messages on current chat  ==== 
	    ======================================================== */
	function getChat(){
		$option = 4;
		$chat = new Message();
        
		//set arrays
		$arrMessages = array();
		$arrMessages["message"] = array();
        $_SESSION['chatAPI'][0]['messages'] = array();

		//set session variables into local variables
		$product = $_SESSION['chatAPI'][0]['producto'];
        
		echo "in get chat";
		if (isset($product)) 
        {
            $resultado = $chat->msgManagement($option, 'null', 'null', 'null', 'null', $product);
            echo json_encode($resultado);

			while($row = $resultado->fetch(PDO::FETCH_ASSOC))	
			{
				$message = array(
					"message" => $row['message'],
					"senderID"	=> 	$row['senderID']
				);

				array_push($arrMessages["message"], $message);
			}

            $_SESSION['chatAPI'][0]['messages'] = $arrMessages["message"];
			echo json_encode($_SESSION['chatAPI'][0]['messages']);

			echo 'succesfully retrieved chat';
        } else {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
        }
	}
}
?>