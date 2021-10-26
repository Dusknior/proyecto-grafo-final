<?php 
include("grafo.php");
session_start();
if (!isset($_SESSION['grafoPrueba'])) {
	$_SESSION['grafoPrueba'] = new Grafo();
}

$grafo = $_SESSION['grafoPrueba'];
#$grafo -> agregarVertice(new Vertice("2"));
#$grafo -> agregarVertice(new Vertice("3"));
#$grafo -> agregarVertice(new Vertice("4"));
$grafo -> agregarArista(2,3,0);
$grafo -> agregarArista(2,4,3);
echo (sizeof($grafo->getVectorV())."<br>");
echo (implode($grafo->getAllDatos(),",")."<br>");
echo (implode($grafo->getMatrizA(),","));
?>

<script type="text/javascript">
var users = <?php echo json_encode($grafo->getMatrizA()); ?>;	
console.log(users);
for (i=0;i<Object.keys(users).length;i++) {
	vector = users[(Object.keys(users))[i]];
	console.log(vector);
	if (Array.isArray(vector)) {
	console.log(Object.keys(vector));
	}
}
</script>