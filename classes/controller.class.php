<?php

error_reporting(E_ERROR);
ini_set("display_errors", 1);
require_once "crud.class.php";

header('Content-type: text/html; charset=utf-8'); 

class controller{

	private $crud = null;
	private $tabela = null;

	public function __construct($tabela=null){
		if(!empty($tableName)) $this->tabela = $tabela;
		$this->crud = new Crud($tabela);
	}

	public function insert($arrayDados){
		$retorno = $this->crud->insert($arrayDados);
		if($retorno != 1){
			return ('<span class="erro">Houve um erro ao executar à operação!</span>');
		}
	}

	public function update($arrayDados, $arrayCondicao){	
		$retorno = $this->crud->update($arrayDados, $arrayCondicao);
		if($retorno == 1){
			echo('<span class="sucesso">Registro alterado com sucesso!</span>');
		}else{
			echo('<span class="erro">Houve um erro ao executar à operação!</span>');
		}
	}


    public function updateVideo($arrayDados, $arrayCondicao){
			$retorno = $this->crud->update($arrayDados, $arrayCondicao);
			if($retorno != 1){
				return ('<span class="erro">Houve um erro ao executar à operação!</span>');
			}
		}
		
    public function delete($arrayCondicao){
			$retorno = $this->crud->delete($arrayCondicao);
			if($retorno == 1){
				echo'Registro excluído com sucesso!';
			}else{
				echo'Houve um erro ao executar operação!';
			}
    }

   public function getDados($sql, $arrayParams=null, $fetchAll=TRUE){
		
			if(!empty($sql)){
				$retorno = $this->crud->getSQLGeneric($sql, $arrayParams, $fetchAll);
				return $retorno;
			}
   } 
}