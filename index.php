<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(0);
	include("grafo.php");
	session_start();
	if (!isset($_SESSION['grafo'])) {
	  $_SESSION['grafo'] = new Grafo;
	}
	$grafo = $_SESSION['grafo'];
?>

<head>
	
	<meta charset="UTF-8">
	<title class="site-name">Proyecto de Grafos</title>
	<link rel="stylesheet" type="text/css" href="vis/dist/vis.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="icon" href="imagenes/g.ico">
	<script type="text/javascript" src = "vis/dist/vis.js"></script>

	<script type="text/javascript">
		var nodes, edges, network;

        // convenience method to stringify a JSON object
        function toJSON(obj) {
            return JSON.stringify(obj, null, 4);
        }

        function addNode() {
            try {
                nodes.add({
                    id: document.getElementById('node-id').value,
                    label: document.getElementById('node-id').value
                });
            }
            catch (err) {
                alert(err);
            }
        }

        function removeNode() {
            try {
                nodes.remove({id: document.getElementById('node-id').value});
            }
            catch (err) {
                alert(err);
            }
        }

        function addEdge() {
            try {
                edges.add({                    
                    from: document.getElementById('edge-from').value,
                    to: document.getElementById('edge-to').value,
                    label: document.getElementById('edge-id').value
                });
            }
            catch (err) {
                alert(err);
            }
        }

        function removeEdge() {
            try {
                edges.remove({from: document.getElementById('edge-from-remove').value, to: document.getElementById('edge-to-remove').value});
            }
            catch (err) {
                alert(err);
            }
        }

        function draw() {
            // create an array with nodes
            nodes = new vis.DataSet();

            // create an array with edges
            edges = new vis.DataSet();

            // create a network
            var container = document.getElementById('grafito');
            var data = {
                nodes: nodes,
                edges: edges
            };
            var options = {};
            network = new vis.Network(container, data, options);

        }

	</script>


</head>
<body onload="draw();">

	<div class="site-branding">
		<h1 class="site-title"><a href="index.php" rel="home" alt="Proyecto de Grafos">Proyecto de Grafos</a></h1>
		<h2 class="site-subtitle">By Daniel Bernal & Miguel Rico (Solo funciona con números)</h2>
	</div>

	<div>
		
		<form action="index.php" method="post" class="met2">
			<img src="imagenes/network.png"><h2>Ver Grafo</h2>
			<br>
			<div id="grafito"></div>
		</form>
		
		<form action="index.php" method="post" class="met1">
			<img src="imagenes/add.png"><h2>Agregar Vertice</h2>
			<br>
			<fieldset>
				<input class="registro" id="node-id" type="text" name="addVertice" placeholder=" ID VERTICE " style="margin-left:80%">
			</fieldset>
			<input type= "submit" name="AV" onclick="addNode()" value="Agregar Vertice" class="run">
			<br><br>
			<img src="imagenes/add.png"><h2>Agregar Arista</h2>
			<br>
			<fieldset>
				<input class="registro" id="edge-from" type="text" name="addOrigenVertice" placeholder=" VERTICE ORIGEN " style="margin-left:80%">
			</fieldset>
			<fieldset>
				<input class="registro" id="edge-to" type="text" name="addDestinoVertice" placeholder=" VERTICE DESTINO " style="margin-left:80%">
			</fieldset>
			<fieldset>
				<input class="registro" id="edge-id" type="text" name="peso" placeholder=" PESO " style="margin-left:80%">
			</fieldset>
			<input type="submit" name="AA" onclick="addEdge()" value="Agregar Arista" class="run">
		</form>
		
		<form action="index.php" method="post" class="met3">
			<img src="imagenes/window.png"><h2>Ver Vertice</h2>
			<fieldset>
				<input class="registro" type="text" name="showVertice" placeholder=" ID VERTICE " style="margin-left:80%">
			</fieldset>
			<input type="submit" name="VV" onclick="" value="Ver Vertices" class="run">
			<br><br>
			<img src="imagenes/share.png"><h2>Ver Adyacentes</h2>
			<fieldset>
				<input class="registro" type="text" name="showAdyacentes" placeholder=" ID VERTICE " style="margin-left:80%">
			</fieldset>
			<input type="submit" name="VA" onclick="" value="Ver Adyacentes" class="run">
			<br><br>
			<img src="imagenes/window.png"><h2>Ver Grado</h2>
			<fieldset>
				<input class="registro" type="text" name="showGrado" placeholder=" ID VERTICE " style="margin-left:80%">
			</fieldset>
			<input type="submit" name="VG" onclick="" value="Ver Grado" class="run">
			<br><br>
			
		</form>

		<form action="index.php" method="post" class="met4">
			<img src="imagenes/x-button.png"><h2>Eliminar Vertice</h2>
			<fieldset>
				<input class="registro" id="node-remove" type="text" name="deleteVertice" placeholder=" ID VERTICE " style="margin-left:80%">
			</fieldset>
			<input type="submit" name="EV" onclick="removeNode()" value="Eliminar Vertice" class="run">
			<br><br>
			<img src="imagenes/x-button.png"><h2>Eliminar Arista</h2>
			<fieldset>
				<input class="registro" id="edge-from-remove" type="text" name="deleteOrigenVertice" placeholder=" VERTICE ORIGEN " style="margin-left:80%">
			</fieldset>
			<fieldset>
				<input class="registro" id="edge-to-remove" type="text" name="deleteDestinoVertice" placeholder=" VERTICE DESTINO " style="margin-left:80%">
			</fieldset>
			<input type="submit" name="EA" onclick="removeEdge()" value="Eliminar Arista" class="run">
		</form>

		<form action="index.php" method="post" class="met5">
		 	<img src="imagenes/3d.png"><h2> Recorrido en anchura</h2>
		 	<fieldset>	 		
          		<input class="registro"  type="text" name="anchura" placeholder="ID Vertice" style="margin-left:80%">
            </fieldset>
        	<input type="submit" name="RA" onclick ="" value ="Ver Recorrido" class="run">
            <br><br>
            <img src="imagenes/bottom-right.png"><h2>Recorrido en Profundidad</h2>
            <fieldset>        	
            	<input class="registro" type="text" name="profundidad" placeholder="ID Vertice" style="margin-left:80%">
            </fieldset>
        	<input type="submit" name="RP" onclick="" value=" Ver Recorrido" class="run">
            <br><br>
            <img src="imagenes/two-ways.png"><h2> Camino mas Corto</h2>
            <fieldset>        	
        		<input class="registro" type="text" name="CaminoCorto" placeholder="ID Vertice origen" style="margin-left:80%">
        	</fieldset>
        	<fieldset>
        		<input class="registro" type="text" name="CaminoCorto2" placeholder="ID Vertice destino" style="margin-left:80%">
            </fieldset>
            <input type="submit" name="RC" onclick="" value="Ver Camino" class ="run">
		</form>

		<hr><br>

		<h2>Nodes</h2>
        <pre id="nodes"></pre>
	
		<br>

        <h2>Edges</h2>
        <pre id="edges"></pre>

        <br>

		<?php

			if (isset($_POST['AV'])) {
				if (isset($_POST["addVertice"])) {
					$V = new Vertice($_POST["addVertice"]);
					$_SESSION['grafo']->agregarVertice($V);
				 	echo "<PRE>";
					print_r($_SESSION['grafo']->getVectorV());
					echo "</PRE>";
				}
			 }

			echo "<hr><br>";

			if (isset($_POST['AA'])) {
				if (isset($_POST["addOrigenVertice"],$_POST["addDestinoVertice"],$_POST["peso"])) {
					if ($_SESSION['grafo']->getVertice($_POST["addOrigenVertice"])->getId() != null){
						if($_SESSION['grafo']->getVertice($_POST["addDestinoVertice"])->getId() != null) {
							$_SESSION['grafo']->agregarArista((int)$_POST["addOrigenVertice"],(int)$_POST["addDestinoVertice"],(int)$_POST["peso"]);
						} else {
							echo "Error de Existencia: <br> El vertice de destino no existe.<br><br>";
						}
					} else {
						echo "Error de Existencia: <br> El vertice de origen no existe.<br><br>";
					}
				}
			}

			if (isset($_POST['VV'])) {
				if (isset($_POST["showVertice"])) {
				if ($_SESSION['grafo']->getVertice($_POST["showVertice"])->getId() != null) {
						echo "ID: ".$_SESSION['grafo']->getVertice($_POST["showVertice"])->getId().
						"- Info.: ".$_SESSION['grafo']->getVertice($_POST["showVertice"])->getId()." ";
					} else {
						echo "Error de Existencia: <br> El vertice no existe.<br><br>";
					}
				}
			}

			if (isset($_POST['VA'])) {
				if (isset($_POST["showAdyacentes"])) {
					$array = $_SESSION['grafo']->getAdyacentes($_POST["showAdyacentes"]);
					foreach($array as $key => $val) {
					    print "Es adyacente a $key con una ponderación de $val. <br>";
					}
				}
			}

			if (isset($_POST['VG'])) {
				if (isset($_POST["showGrado"])) {
					echo "El grado del vertice es: ".$_SESSION['grafo']->grado($_POST["showGrado"]).".<br><br>";
				}
			}

			if (isset($_POST['EV'])) {
				if (isset($_POST["deleteVertice"])) {
					$N = $_SESSION['grafo']->eliminarVertice($_POST["deleteVertice"]);
					if ($N) {
						echo "Eliminación Exitosa!<br><br>";
					} else {
						echo "El vertice no existe.<br><br>";
					}
				}
			}

			if (isset($_POST['EA'])) {
				if (isset($_POST["deleteOrigenVertice"],$_POST["deleteDestinoVertice"])) {
					$N = $_SESSION['grafo']->eliminarArista($_POST["deleteOrigenVertice"],$_POST["deleteDestinoVertice"]);
					if ($N) {
						echo "Eliminación Exitosa!<br><br>";
					} else {
						echo "La Arista no existe.<br><br>";
					}
				}
			}

		  	if (isset($_POST["RA"])) {
	            $p = $_SESSION['grafo']->BuscarVertice($_POST["anchura"]);
	            if ($p == false) {
	                echo "No existe el vertice.";
	            } else {
	                $grado = $_SESSION['grafo']->recorridoAnchura($_POST["anchura"]);
	                if ($grado == null) {
	                    echo "No tiene grado.";
	                } else {
	                    print($_SESSION["grafo"]->recorridoAnchura($_POST["anchura"]));
	                }
	            }
	        }

		    if (isset($_POST["RP"])) {
		        $p = $_SESSION['grafo']->BuscarVertice($_POST["profundidad"]);
		        if ($p == false) {
		            echo "No existe el vertice.";
		        } else {
		            $grado = $_SESSION['grafo']->recorridoProfundidad($_POST["profundidad"]);
		            if ($grado == null) {
		                echo "No tiene grado";
		            } else {
		                print($_SESSION['grafo']->recorridoProfundidad($_POST["profundidad"]));
		            }
		        }
		    }

			if(isset($_POST["RC"])){
				if(isset($_POST["CaminoCorto"],$_POST["CaminoCorto2"])){
					print_r($_SESSION['grafo']->caminoMasCorto($_POST["CaminoCorto"],$_POST["CaminoCorto2"]));
				}
			}

			echo "<hr><br>";

		?>
	</div>

</body>
</html>
