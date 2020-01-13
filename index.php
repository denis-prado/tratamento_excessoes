<?php

/*
* Todo o código dentro do 'try' é tratado e o 'catch'
* é responsável por tratar o erro.
*/

try{

$a = 10;
$b = 10;

$result = ($b / $a) * 10;

echo $result . '<br>';

get_i();

}

catch (\Error $e){
	echo "Ocorreu um problema: ". $e->getMessage();
}


/*************Lidando com valores nulo**************/

// Declaração da funcão
function calcula($valor){
	if($valor == null){ // Valida o valor recebido.
		throw new \InvalidArgumentException("Valor nulo");
	} 
		echo "Operação realizada";
}

try{
	calcula(null); //Passando valor null para função
}
catch (InvalidArgumentException $e){
	echo "Ocorreu um problema: ".$e->getMessage();
}


/************Lidando multiplas exceções**************/

function calcula($valor, $b){
	if($valor == null){ // Valida o valor recebido.
		throw new \InvalidArgumentException("Valor nulo");
	} 

	if ($b = 5) {
		throw new \LogicException("Favor informar um número maior que 5");
	}
}

try{
	calcula(2, 4); //Passando segundo valor diferente de 5
}
//O Invalid... é superior ao Logic na Hierarquia
catch (InvalidArgumentException $e){
	echo "Ocorreu um problema: ".$e->getMessage();
}
catch(LogicException $e){
	echo "Erro: ".$e->getMessage();
}


/**************Personalizando exceções***************/

//Extrutura padrão
class TesteException extends \LogicException
{
	private $codigo;
	
	public function __construct($codigo = 0, $message, Exception $previus = null)
	{
		$this->codigo = $codigo;
		parent::__construct($message, $codigo, $previus);
	}

	public function getCodigo(){
		return $this->codigo;
	}
}

// Declaração da funcão
function calcula($valor){
	if($valor == null){ // Valida o valor recebido.
		throw new TesteException(500, "Valor nulo");
	} 
		echo "Operação realizada";
}
try{
	calcula(null); //Passando valor null para função
}
catch (TesteException $e){
	echo "Ocorreu um problema: ".$e->getMessage()." - Código: ".$e->getCodigo();
}
//Independente de ter dado erro, o finally sempre será executado, ele pode ser utilizado para gerar um log ou encerrar uma conexão com o BD.
finally{
	echo "<br/> Processamento encerrado";
}








