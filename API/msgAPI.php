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
			$message->getChat($_POST['productID']);
			break;
		case 'sendMessage':
			$message->sendMessage();
			break;
		case 'loadChats':
			$message->getChats();
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
		if (isset($_SESSION['usersAPI']['userID']) ){
			//initialize arrays	
			$arrChat = array();
			$arrChat["chat"] = array();
			$_SESSION['chatAPI'] = array();

			//Set variables from product page
			if(($_POST['idProducto'] != -1) && ($_POST['idVendedor'] != -1)){
				$producto = $_POST['idProducto'];
			}
			//set variables from selected chat
			else{
				$producto = $_POST['dinamicID'];
			}
			$vendedor = $_POST['idVendedor'];
			$userID = $_SESSION['usersAPI']['userID'];

			//get the product name
			$option = 3;
			$chat = new Message();
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

		echo json_encode($_SESSION['chatAPI']); 

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
	function getChat($productID) {
        $option = 4;
        $chat = new Message();
        
        // set arrays
        $arrMessages = array();
        $arrMessages["message"] = array();
        $_SESSION['chatAPI'][0]['messages'] = array();

        // set session variables into local variables
        $product = $productID;

            $resultado = $chat->msgManagement($option, 'null', 'null', 'null', 'null', $product);
			echo json_encode($resultado);
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $message = array(
                    "message" => $row['message'],
                    "senderID"	=> 	$row['senderID']
                );

                array_push($arrMessages["message"], $message);
            }

            $_SESSION['chatAPI'][0]['messages'] = $arrMessages["message"];
            echo json_encode($_SESSION['chatAPI'][0]['messages']);
            echo 'succesfully retrieved chat';
        
    }

	/*	========================================================
		=============  Function to send a message  =============
	    ======================================================== */
	function sendMessage(){
		$option = 5;
        $chat = new Message();
        
		// set session variables into local variables
		$currentUser = $_SESSION['chatAPI'][0]['senderID'];
		$product = $_SESSION['chatAPI'][0]['producto'];
		$message = "'" . $_POST['message'] . "'";

        if (isset($currentUser) && isset($product) && isset($message)) 
        {
            $resultado = $chat->msgManagement($option, $currentUser, 'null', 'null', $message, $product);

            echo json_encode($resultado);
			echo 'succesfully added message';
        } else {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
        }
	}

	/*	========================================================
		===== Function get all different chat for side bar =====
	    ======================================================== */
	function getChats() {
		if (isset($_SESSION['usersAPI']['userID'])) {
			// initialize arrays    
			$arrChat = array();
			$arrChat["chats"] = array();
			$_SESSION['allchatAPI'] = array();

			// Set variables from product page
			$userID = $_SESSION['usersAPI']['userID'];

			// get the product name
			$option = 6;
			$chat = new Message();
			$resultado = $chat->msgManagement($option, $userID, 'null', 'null', 'null', 'null');
			echo json_encode($resultado);
        
			if(isset($resultado)) {
				// set current chat info into session variable
				while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
					foreach ($row as $key => $value) {
						echo "Key: $key, Value: $value\n";
					}
					$_chat = array(
						"producto" => $row['productID'],
						"nombreProducto" => $row['name']
					);

					array_push($arrChat["chats"], $_chat);
				}

				$_SESSION['allchatAPI'] = $arrChat["chats"];
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