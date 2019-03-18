<?php 

class asertijoModel {

    /**
     * dtq
     * Funcion que retorna Informacion base
     * @return  array
     */
    public function infoBase ($dato){
		
        $patron =   ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $tablero = [
            1 =>    ['B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A'],
            2 =>    ['C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B'],
            3 =>    ['D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C'],
            4 =>    ['E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D'],
            5 =>    ['F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E'],
            6 =>    ['G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F'],
            7 =>    ['H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G'],
            8 =>    ['I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H'],
            9 =>    ['J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I'],
            10 =>   ['K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J'],
            11 =>   ['L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K'],
            12 =>   ['M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L'],
            13 =>   ['N','O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M'],
            14 =>   ['O','P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N'],
            15 =>   ['P','Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O'],
            16 =>   ['Q','R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P'],
            17 =>   ['R','S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q'],
            18 =>   ['S','T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R'],
            19 =>   ['T','U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S'],
            20 =>   ['U','V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T'],
            21 =>   ['V','W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U'],
            22 =>   ['W','X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V'],
            23 =>   ['X','Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W'],
            24 =>   ['Y','Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X'],
            25 =>   ['Z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y']
        ];

		if(isset($dato->key)  && $dato->key <=25 && $dato->key >=0){
            $info = $tablero[$dato->key];
		}else{
			$info = $tablero;
		}
		
		if(!isset($dato->array)){
			$tmp_arr = [];
			foreach ($info as $key => $value) {
				$obj = new \stdClass();
				foreach ($value as $k => $v) {
					$obj->{"v".$k} = $v;
				}
				$tmp_arr[] = $obj; 
			}
			$info = $tmp_arr;
		}
		
        return $resul = [
            "status" => 200,
            "mensaje" => 'Ok',
            "data" => [
					"patron"=> $patron,
					"tablero"=>$info
			]
        ];
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
            $patron = $this->infoBase(null)["data"]["patron"];
			$arr = array_filter($info);
			$obj->array = true;
				
            foreach ($arr as $key=>$item){
                $obj->key = $item->cod;
                $item_tabl = $this->infoBase($obj)["data"]["tablero"];
				unset($obj->key);
				$vals = str_split($item->val);
				foreach($vals as $char){
					$char_pos = array_search(strtoupper($char),$item_tabl);
                    $palabra .= $patron[$char_pos];
				}
				$palabra .= " ";
            }
        
            return $resul = [
                "status" => 200,
                "mensaje" => 'Ok',
                "data" => trim($palabra)
            ];
        } catch (\PDOException $e) {
            $resul = [
                "status" => 400,
                "mensaje" => "Error en el proceso",
                "data" => ""
            ];
            return $resul;
        }
    }
}
  
?>