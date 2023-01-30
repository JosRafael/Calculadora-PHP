<?php
//C:\xampp\htdocs\ART\Classes\nusoap\samples\client1.php

//print_r($_SERVER);
// echo $_SERVER['DOCUMENT_ROOT'] ;


require_once "nusoap.php";
$resultado = '';
$url = "http://www.dneonline.com/calculator.asmx?WSDL";

$operacion = '';
if (isset($_POST["sumar"]) )	$operacion = 'Add';
if (isset($_POST["restar"]) ) 	$operacion = 'Subtract';
if (isset($_POST["multiply"]) ) $operacion = 'Multiply';
if (isset($_POST["divide"]) ) 	$operacion = 'Divide';

// echo "operacion = ".print_r($_POST);
	
if( isset($_POST["inta"]) 
and isset($_POST["intb"]) 
and $operacion != '' ){


	$intA = $_POST["inta"];	
	$intB = $_POST["intb"];	

/*------------------------------------------------------------*/
		$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
		$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
		$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
		$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
		$client = new nusoap_client('http://www.dneonline.com/calculator.asmx?WSDL', 'wsdl',
								$proxyhost, $proxyport, $proxyusername, $proxypassword);
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			return false;
		}
		// Doc/lit parameters get wrapped
		$param = array('intA' => $intA, 'intB' => $intB);
		$result = $client->call($operacion, array('parameters' => $param), '', '', false, true);
		
		if( isset($result['AddResult']) ){			$resultado = $result['AddResult'];	}
		elseif( isset($result['SubtractResult']) ){ 	$resultado = $result['SubtractResult'];	}
		elseif( isset($result['MultiplyResult']) ){ 	$resultado = $result['MultiplyResult'];	}
		elseif( isset($result['DivideResult']) ){ 	$resultado = $result['DivideResult'];	}
		else{	$resultado = "FALLO: ".print_r($result);			}

		// Check for a fault
		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
		} else {
			// Check for errors
			$err = $client->getError();
			if ($err) {
				// Display the error
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
			} else {
				// Display the result
				/*
				echo '<h2>Result</h2><pre>';
				print_r($result);
				echo '</pre>';
				*/
			}
		}

/*
		echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
		echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
		echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
*/
/*------------------------------------------------------------*/

/*
		
      <intA>int</intA>
      <intB>int</intB>
	$ch = curl_init($url);
	
	$parametros = "&op=Add&inta=$intA&intb=$intB";
	
	curl_setopt($ch, CURLOPT_POST, 1);	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);			
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$resultado = curl_exec($ch);
	curl_close($ch);
		
*/	
}
?>
<!DOCTYPE HTML>
<html>
	<head>
	</head>
	
	<body>
	<h1>Operaciones Aritmeticas: </h1>
	seleccione una operacion
	<hr>
		<form method="post" action="">
		
		<p><label style='padding:10px;' > Valor A </label><input style='padding:10px;' type="text" name="inta" value="10">
		
		<p><label style='padding:10px;' > Valor B </label><input style='padding:10px;' type="text" name="intb" value="2">
		
		<p><input style='padding:20px; width:100px;' type="submit" value="sumar" name='sumar'>
		<input style='padding:20px; width:100px;' type="submit" value="restar" name='restar'>
		<input style='padding:20px; width:100px;' type="submit" value="multiply" name='multiply'>
		<input style='padding:20px; width:100px;' type="submit" value="divide" name='divide'>
		
		<div style='position:relative; 
					float:left; 
					width:100px;
					.top:300px;
					.left:200px;
					padding:10px; 
					color:blue; 
					font-size:36px;
					border: solid 1px black;' >
			<?php 
				if(isset($_POST["inta"])) {
					echo $resultado; 
					//print_r($result);
					unset($_POST["inta"]);
					unset($_POST["intb"]);
				}
				?> 			
		</div>
		</form>
	</body>
</html>