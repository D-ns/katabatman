<?php 

class asertijoModel {

    /**
     * dtq
     * Funcion que retorna Informacion base
     * @return  array
     */
    public function infoBase ($dato){
		
        $patron =  array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $tablero = array(
            1 =>    array('B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A'),
            2 =>    array('C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B'),
            3 =>    array('D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C'),
            4 =>    array('E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D'),
            5 =>    array('F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E'),
            6 =>    array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F'),
            7 =>    array('H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G'),
            8 =>    array('I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H'),
            9 =>    array('J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I'),
            10 =>   array('K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J'),
            11 =>   array('L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K'),
            12 =>   array('M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L'),
            13 =>   array('N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M'),
            14 =>   array('O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N'),
            15 =>   array('P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O'),
            16 =>   array('Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P'),
            17 =>   array('R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q'),
            18 =>   array('S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R'),
            19 =>   array('T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S'),
            20 =>   array('U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T'),
            21 =>   array('V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U'),
            22 =>   array('W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V'),
            23 =>   array('X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W'),
            24 =>   array('Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X'),
            25 =>   array('Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y')
        );

		if(isset($dato->key)  && $dato->key <=25 && $dato->key >=0){
            $info = $tablero[$dato->key];
		}else{
			$info = $tablero;
		}
		
		if(!isset($dato->array)){
			$tmp_arr = array();
			foreach ($info as $key => $value) {
				$obj = new \stdClass();
				foreach ($value as $k => $v) {
					$obj->{"v".$k} = $v;
				}
				$tmp_arr[] = $obj; 
			}
			$info = $tmp_arr;
		}
		
        return $resul = array(
            "status" => 200,
            "mensaje" => 'Ok',
            "data" => array(
					"patron"=> $patron,
					"tablero"=>$info
            )
        );
    }
    

    /**
     * dtq
     * Funcion que decodifica el dato
     * @return  array
     */
    public function desencriptCodigo ($info){
        try {
            $palabra ="";
            $obj = new \stdClass();
            $tmp_patron = $this->infoBase(null);
            $patron = $tmp_patron["data"]["patron"];
			$arr = array_filter($info);
			$obj->array = true;
				
            foreach ($arr as $key=>$item){
                $obj->key = $item->cod;
                $tmp_tablero = $this->infoBase($obj);
                $item_tabl = $tmp_tablero["data"]["tablero"];
				unset($obj->key);
				$vals = str_split($item->val);
				foreach($vals as $char){
					$char_pos = array_search(strtoupper($char),$item_tabl);
                    $palabra .= $patron[$char_pos];
				}
				$palabra .= " ";
            }
        
            return $resul = array(
                "status" => 200,
                "mensaje" => 'Ok',
                "data" => trim($palabra)
            );
        } catch (\PDOException $e) {
            $resul = array(
                "status" => 400,
                "mensaje" => "Error en el proceso",
                "data" => ""
            );
            
            return $resul;
        }
    }
}
  
?>