<?php
session_start();
 include_once '../Consultas/chatConsult.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $message = new chatAPI();
    echo($action);

    switch ($action) {
        case 'setCurrentChat':
            $message->clearChat();
            $message->setCurrentChat();
        case 'startChat':
            $sender = $_SESSION['chatAPI']['current']['senderID'];
            $reciever = $_SESSION['chatAPI']['current']['receiverID'];
            $product = $_SESSION['chatAPI']['current']['productID'];

            $message->startChat($sender, $reciever, $product);
            $message->getChatMessages($sender, $reciever, $product);
            break;
        case 'sendMessage':
            $sender = $_SESSION['chatAPI']['current']['senderID'];
            $reciever = $_SESSION['chatAPI']['current']['receiverID'];
            $product = $_SESSION['chatAPI']['current']['productID'];

            $message->sendMessage($sender, $reciever, $product);
            $message->getChatMessages($sender, $reciever, $product);
            break;
        case 'getChat':
            $sender = $_SESSION['chatAPI']['current']['senderID'];
            $reciever = $_SESSION['chatAPI']['current']['receiverID'];
            $product = $_SESSION['chatAPI']['current']['productID'];
            $message->getChatMessages($sender, $reciever, $product);
            break;
        case 'getAllChats':
            $message->getChats();
            break;
        case 'clearchats':
            $message->clearChat();
            break;
    }
}

class chatAPI {
    public function __construct() {
        
    }
    
    /*	=================================================================
		==============         Function clear chats        ============== 
	    ================================================================= */
    function clearChat(){
        $_SESSION['chatAPI']= array();
        $_SESSION['chatAPI']['current']= array();
        $_SESSION['allchatsAPI'] = array();
    }

    /*	=================================================================
		======= Function to set global variables on current chat. ======= 
	    ================================================================= */
    function setCurrentChat(){
        // Data into variables
        $option = 5; 
        $chat = new Message();
        $product = $_POST['idProducto'];
        $sender = $_SESSION['usersAPI']['userID'];
        $receiver = $_POST['idVendedor'];

        // Call to Consult
        $resultado = $chat->chatManagement($option, $product, 'null', 'null', 'null');
    
        if(!isset($resultado)){
            echo json_encode(array('resultado' => 'No hay elementos'));
            return;
        }

        $row = $resultado->fetch(PDO::FETCH_ASSOC); 

        // Save to global variables
        $_SESSION['chatAPI'] = array(
            'current' => array(
                'senderID' => $sender,
                'receiverID' => $receiver,
                'productID' => $product,
                'productName' => $row['name']
            )
        );

        echo json_encode($_SESSION['chatAPI']); 
		echo 'succesfully setted chat';

    }

    /*	========================================================
		=== Function to send default first message into chat === 
	    ======================================================== */
    function startChat($sender, $reciever, $product){
        // Data into variables
        $option = 1;
		$chat = new Message();
		$message = "'". $_POST['message'] . " " . $_SESSION['chatAPI']['current']['productName']. "'";

        if (!isset($sender) && !isset($reciever) && !isset($product) && !isset($message)) {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            return;
        }

        //Call to consult
        $resultado = $chat->chatManagement($option, $product, $sender, $reciever, $message);
        echo json_encode($resultado);
        if(!isset($resultado)){
            echo json_encode(array('resultado' => 'No hay elementos'));
            return;
        }
		echo 'succesfully added message';
    }

    /*	========================================================
		====  Function to get all messages on current chat  ==== 
	    ======================================================== */
    function getChatMessages($sender, $reciever, $product) {
        $option = 3;
        $chat = new Message();
        if (!isset($sender) && !isset($reciever) && !isset($product)) {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            return;
        }

        //Call to consult
        $_SESSION['chatAPI']['current']['receiverID'] = $sender == $reciever ? $recieverID : $reciever;
        $resultado = $chat->chatManagement($option, $product, $sender, $reciever, 'null');
		echo json_encode($resultado);

        //Messages into current chat session
        $_SESSION['chatAPI']['current']['messages'] = array();
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $message = array(
                "message" => $row['message'],
                "senderID"	=> 	$row['senderID']
            );
            array_push($_SESSION['chatAPI']['current']['messages'], $message);
        }

        echo json_encode($_SESSION['chatAPI']['current']['messages']);
        echo 'succesfully retrieved chat';
    }

    /*	========================================================
		=============  Function to send a message  =============
	    ======================================================== */
    function sendMessage($sender, $reciever, $product){
		$option = 2;
        $chat = new Message();
        
		// set session variables into local variables
		
		$message = "'". $_POST['message'] . "'";

        if (!isset($sender) && !isset($reciever) && !isset($product) && !isset($message)) {
            echo json_encode(array('mensaje' => 'No se han proporcionado los datos necesarios.'));
            return;
        }

        //Call to consult
        $resultado = $chat->chatManagement($option, $product, $sender, $reciever, $message);
        echo json_encode($resultado);
        if(!isset($resultado)){
            echo json_encode(array('resultado' => 'No hay elementos'));
            return;
        }
		echo 'succesfully added message';
	}

    /*	========================================================
		===== Function get all different chat for side bar =====
	    ======================================================== */
	function getChats() {
		$option = 4;
		$chat = new Message();
		$_SESSION['allchatsAPI'] = array();
		$sender = $_SESSION['usersAPI']['userID'];

        //Call to consult
		$resultado = $chat->chatManagement($option, 'null', $sender, 'null', 'null');
		echo json_encode($resultado);
        
		if(isset($resultado)) {
			while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
				$_chat = array(
					"productID" => $row['productID'],
					"productName" => $row['name'],
					"recieverUser" => $row['recieverUser'],
					"receiverID" => $row['receiverID'],
					"sellerID" => $row['sellerID'],
				);

				array_push($_SESSION['allchatsAPI'], $_chat);
			}
		} else {
			echo 'this is the result--->' . $resultado . '<---';
			echo json_encode(array('mensaje' => 'No hay elementos'));
		}
	}	
}

?>
