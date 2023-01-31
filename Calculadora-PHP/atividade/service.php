<?php
    require "nusoap.php";
    require "functions.php";

    $server = new nusoap_server();
    $server -> configureWSDL("consulta","urn:consulta");
    $server -> register(
        "preco",
        array("nome" => "xsd:string"),
        array("return" => "xsd:float")
    );
    $server -> register(
        "teste",
        array("nome" => "xsd:integer"),
        array("return" => "xsd:string")
    );
    
    $server -> service(file_get_contents("php://input"));
?>
