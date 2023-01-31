<?php
    require "nusoap.php";

    $clientCalc = new nusoap_client("http://www.dneonline.com/calculator.asmx?WSDL", "wsdl");

    
    $n1 = $_POST['numero1'];
    $n2 = $_POST['numero2'];
    $operacao = $_POST['operacao'];
  
    if($operacao == "+"){
        $resultado = $clientCalc -> call("Add", array("intA" => "$n1", "intB" => "$n2"));
    }

	else if($operacao == "-"){
        $resultado = $clientCalc -> call("Subtract", array("intA" => "$n1", "intB" => "$n2"));
    }

	else if($operacao == "÷"){
        $resultado = $clientCalc -> call("Divide", array("intA" => "$n1", "intB" => "$n2"));
    }

	else{
        $resultado = $clientCalc -> call("Multiply", array("intA" => "$n1", "intB" => "$n2"));
    }
?>

<!-- Linkando o css -->
<link rel='stylesheet' type='text/css' href='calculadora.css'>
<div class='caixa'>
    <form class="form" method="POST" action="">
        <h2>CALCULADORA</h2>
        <input type="text" placeholder="digite um número" name="numero1">
        <input type="text" placeholder="digite um número" name="numero2">

        <h3>OPERAÇÃO</h3>
        <section class="operacoes">
            <input type="submit" value="+" class="button" name="operacao">
            <input type="submit" value="-" class="button" name="operacao">
            <input type="submit" value="÷" class="button" name="operacao">
            <input type="submit" value="x" class="button" name="operacao">
        </section>
    </form>

	<?php
        if($operacao == "+"){
            echo"<h1> Soma = ".$resultado["AddResult"]."</h1>"; 
        }
		
		else if($operacao == "-"){
            echo"<h1> Subtração = ".$resultado["SubtractResult"]."</h1>"; 
        }
		
		else if($operacao == "÷"){
            echo"<h1> Divisão = ".$resultado["DivideResult"]."</h1>";
        }
		
		else if($operacao == "x"){
            echo"<h1> Multiplicação = ".$resultado["MultiplyResult"]."</h1>";
        }
    ?>

</div>