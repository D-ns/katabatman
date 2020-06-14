<?php 
include_once("decryptModel.php");

class asertijoController {    

    /**
     * dtq
     * Funcion para obtener informcion base
     * @return  json
     */
    public function getinformacionBase(){
        if (isset($_REQUEST)) {
            $dm =  new asertijoModel();
            $data = $_REQUEST['data'];
            $res = $dm->infoBase(isset($data)?$data:null);
			echo json_encode($res);
        } else {
            $res = array(
                    "status" => 400,
                    "mensaje" => "Error en el proceso"
                );
			echo json_encode($res);
        }
    }


    /**
     * dtq
     * Funcion para proceso de desencriptado
     * @return  json
     */
    public function DesencriptarCodigo(){
        $resul = file_get_contents("php://input");
        $_data = json_decode($resul);
		
        if (isset($_data->data)) {
			$dm =  new asertijoModel();
            $res = $dm->desencriptCodigo($_data->data);
			echo json_encode($res);
        } else {
            $res = array(
                "status" => 400,
                "mensaje" => "Error en el proceso"
            );
            echo json_encode($res);
        }
    }
}

?>