<?php
include("vertice.php");
Class Grafo{


	private $matrizA;
	private $vectorV;
	private $dirigido;

	public function __construct($dir = true){
		$this->matrizA = null;
		$this->vectorV = null;
		$this->dirigido = $dir;
	}

	//recibe objeto tipo vertice, no pueden repetirce id
	public function agregarVertice($v){
		if(!isset($this->vectorV[$v->getId()])){
			$this->matrizA[$v->getId()] = null;
			$this->vectorV[$v->getId()] = $v;
		} else{
			return false;
		}
		return true;

	}

	public function getVertice($v){
		return $this->vectorV[$v];
	}

	//recibe id de nodo origen, destino y peso (opcional)
	public function agregarArista($o, $d, $p){
		if (isset($this->vectorV[$o]) && isset($this->vectorV[$d])){
			$this->matrizA[$o][$d] = $p;
		} else {
			return false;
		}
		return true;
	}

	//recibe id de nodo y retorna en un arreglo sus adyacentes.
	public function getAdyacentes($v){
		return $this->matrizA[$v];
	}

	public function getMatrizA(){
		return $this->matrizA;
	}

	public function getVectorV(){
		return $this->vectorV;
	}

	//recibe el id del vertice y retorna grado de salida del mismo
	public function gradoSalida($v){

		return count($this->matrizA[$v]);

	}

	public function gradoEntrada($v){
		$gr = 0;
		if ($this->matrizA != null){
			foreach ($this->matrizA as $vp => $adya) {
				if($adya !=null){
					foreach ($adya as $de => $pe) {
						if($de == $v){
							$gr++;
						}
					}
				}
			}
		}

		return $gr;
	}

	//recibe el id del vertice y retorna grado del mismo
	public function grado($v){
		return $this->gradoSalida($v) + $this->gradoEntrada($v);

	}

	//recibe id de vertice origen y destino
	public function eliminarArista($o, $d){
		if (isset($this->matrizA[$o][$d])){
			unset($this->matrizA[$o][$d]);
		}else{
			return false;
		}

		return true;
	}

		//recibe id de vertice a eliminar, elimina aristas relacionadas
	public function eliminarVertice($v){
		if(isset($this->vectorV[$v])){
			foreach ($this->matrizA as $vp => $adya) {
				if($adya !=null){
					foreach ($adya as $de => $pe) {
						if($de == $v){
							unset($this->matrizA[$vp][$de]);
						}
					}
				}
			}
			unset($this->matrizA[$v]);
			unset($this->vectorV[$v]);
		} else{
			return false;
		}
		return true;

	}

	public function getAllDatos (){
		$arrayKeys = array_keys($this->vectorV);
		return $arrayKeys;
	}

	public function limpiar () {
		$this->vectorV = null;
		$this->matrizA = null;
	}

    public function caminoMasCorto($a,$b){
        $S = array();
        $Q = array();
        foreach(array_keys($this->matrizA) as $val) $Q[$val] = 99999;
        $Q[$a] = 0;

        //inicio calculo
        while(!empty($Q)){
            $min = array_search(min($Q), $Q);
            if($min == $b) break;
            foreach($this->matrizA[$min] as $key=>$val) if(!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) {
                $Q[$key] = $Q[$min] + $val;
                $S[$key] = array($min, $Q[$key]);
            }
            unset($Q[$min]);
        }
        $path = array();
        $pos = $b;
        while($pos != $a){
            $path[] = $pos;
            $pos = $S[$pos][0];
        }
        $path[] = $a;
        $path = array_reverse($path);
        return $path;
    }

    public function recorridoAnchura($v) {
        $Mostrar ="";
        $Final = array();

        foreach ($this->vectorV as $id => $vertice) {
            $vertice->setVisitado(false);
        }

        if (isset($this->vectorV[$v])) {
            $c = array();
            $x = $this->vectorV[$v];
            array_unshift($c, $x);
            while (count($c) != 0) {
                $x = array_pop($c);
                if (!$x->getVisitado()) {
                    $x->setVisitado(true);
                    array_push($Final, $x);
                    $adya = $this->getAdyacentes($x->getId());
                    if (sizeof($adya) != 0) {
                        foreach ($adya as $indice => $peso) {
                            array_unshift($c, $this->vectorV[$indice]);
                        }
                    }
                }
            }

            foreach($Final as $x){
                $Mostrar .= " " .$x->getId();
            }
            return $Mostrar;

        } else {
            return null;
        }
    }

    public function recorridoProfundidad($v) {
        $Mostrar=" ";       
        $Final = array();

        foreach ($this->vectorV as $id => $vertice) {
            $vertice->setVisitado(false);
        }

        if (isset($this->vectorV[$v])) {
            $p = array();
            $x = $this->vectorV[$v];
            array_push($p, $x);
            while (count($p) != 0) {
                $x = array_pop($p);
                if (!$x->getVisitado()) {
                    $x->setVisitado(true);
                    array_push($Final, $x);
                    $adya = $this->getAdyacentes($x->getId());
                    if (sizeof($adya) != 0) {
                        foreach ($adya as $indice => $peso) {
                            array_push($p, $this->vectorV[$indice]);
                        }
                    }
                }
            }

            foreach ($Final as $x) {
                $Mostrar .= " " .$x->getId();
            }
            return $Mostrar;

        } else {
            return null;
        }
    }

    public function size($T=array()){
    $c = 0;
    for($i=0;;$i++){
        if($indice!=null){
            $c++;
        }
    }
    return $c;
    }

    public function BuscarVertice($v) {
        if (!isset($this->vectorV[$v])) {
            return false;
        } else {
            return true;
        }
    }

}
?>
