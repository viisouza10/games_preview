<?php
/*
* Classe Controller para receber os dados da View (HTML) e transferir para classe Crud
* também recebe os dados da classe Crud e transferi para View (HTML)
* Após instância o objeto é necessário informar 2 arrays para configuração do objeto
* 1 - $arrayNullAceito informa quais os campos serão aceitos como nulos na validação da array antes do INSERT e UPDATE
* 2 - $arrayCondicaoDuplicidade informas quais os campos, condições e valores para verificação de duplicidade de registros antes do INSERT
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once "crud.class.php";
require_once "helper/helper_format.class.php";

header('Content-type: text/html; charset=utf-8'); 

class controller{

	// Atributo privado contendo instância da classe Crud
	private $crud = null;

	// Atributo privado contendo o nome da tabela
	private $tabela = null;

	// Atributo privado contém a array com os campos que podem ser nulos
	private $arrayNullAceito = null;

	// Atributo privado contém array com condição para verificação de duplicidade
	private $arrayCondicaoDuplicidade = null;

	/*
	* Método construtor da classe
	* @param $tabela - Contém o nome da tabela onde serão manipulados os dados
	*/
	public function __construct($tabela=null){
		if(!empty($tableName)) $this->tabela = $tabela;
		$this->crud = new Crud($tabela);
	}

	/*
	* Método público para setar o nome da tabela que será utizada
	* @param $tableName - String contendo o nome da tabela
	*/
	public function setTableName($tableName){
		if(!empty($tableName)):
			$this->$tabela = $tableName;
		endif;
	}

	/*
	* Método para setar a array com campos nulos aceitos
	* @param $arrayNullAceito - Array com campos nulos que poderão ser aceitos no cadastro
	*/
	public function setNullAceito(array $arrayNullAceito){
		$this->arrayNullAceito = $arrayNullAceito;
	}

	/*
	* Método para setar a array com condições para verificação de duplicidade
	* @param $arrayCondicaoDuplicidade - Array com campos e condições para cláusula WHERE 
	*/
	public function setCondicaoDuplicidade(array $arrayCondicaoDuplicidade){
		$this->arrayCondicaoDuplicidade = $arrayCondicaoDuplicidade;
	}

	/*
	* Método para validar dados de uma array
	* @param $arrayDados - Array contendo dados a serem validados
	* @param $arrayNullAceito - Array contendo os campos que podem conter valores null
	* @return Boolean - Valor booleano TRUE array válida e FALSE array inválida
	*/
	private function validaArray($arrayDados){
		$retorno = TRUE;

		// Verifica se existem campos aceitos com valor null
		if (!empty($this->arrayNullAceito)):
			foreach($this->arrayNullAceito as $valor):
				if (array_key_exists($valor, $arrayDados)):
					unset($arrayDados[$valor]);
				endif;
			endforeach;
		endif;

		// Percorre array verificando se existem elementos vazios
		foreach($arrayDados as $valor):
			$retorno = (empty($valor)) ? FALSE : TRUE;
			if ($retorno == FALSE) break;
		endforeach;

		return $retorno;
	}

	/* 
	* Método para verificar duplicidade de registros
	* @param $coluna = Colunas de retorno separadas por vírgula
	* @param $arrayCondicao = Array de dados contendo colunas e valores para condição WHERE - Exemplo array('$id='=>1)   
	* retorna a quantidade de registros encontrados
	*/
	private function verificaDuplicidade(){
		$valCondicao = "";

	   // Loop para montar a condição WHERE   
	   foreach($this->arrayCondicaoDuplicidade as $chave => $valor):   
	       $valCondicao .= $chave . '? AND ';   
	   endforeach;

	   // Retira AND do final da string   
	   $valCondicao = (substr($valCondicao, -4) == 'AND ') ? trim(substr($valCondicao, 0, (strlen($valCondicao) - 4))) : $valCondicao ;    
	    
	   $sql = "SELECT * FROM $this->tabela WHERE " . $valCondicao; 
	   $retorno = $this->crud->getSQLGeneric($sql, $this->arrayCondicaoDuplicidade, TRUE);
	   
	   // Verifica se a consulta retornou vazia, se verdadeira retorna TRUE
	   if (empty($retorno)):
	   		return FALSE;
	   else:
	   		return TRUE;
	   endif;
	}

    /* 
    * Método para validar e enviar os dados para inserção na classe Crud
    * @param $arrayDados = Array de dados contendo colunas e valor
    * @param $duplicidade = Valor booleano TRUE obriga a verificação de duplicidade antes de inserir
    */
    public function insert($arrayDados, $duplicidade=TRUE){
    	try{
	    	if ($this->validaArray($arrayDados)):
	    		if($duplicidade == TRUE && !empty($this->arrayCondicaoDuplicidade)):
		    	    if($this->verificaDuplicidade()):
		    		   return helper_format::printMsgErro('Está operação está duplicando registros!');
		    		   exit();
		    	    endif;
		    	endif;

	    		$retorno = $this->crud->insert($arrayDados);
	    		if($retorno == 1):
	    			// echo('Registro incluído com sucesso!');
	    		else:
	    			return ('<span class="erro">Houve um erro ao executar à operação!</span>');
	    		endif;
	    	else:
	    		echo('<span class="falha">Existem campos sem preenchimento!</span>');
	    		exit();
	    	endif;	
	    }catch(Exception $e){
	    	echo('Erro: ' . $e->getMessage());
	    }
    }

    /* 
    * Método para validar e enviar os dados para atualização na classe Crud
    * @param $arrayDados = Array de dados contendo colunas e valor
    * @param $arrayCondicao = Array de dados contendo colunas e valores para condição WHERE - Exemplo array('$id='=>1)   
    */
    public function update($arrayDados, $arrayCondicao){
    	try{
	    	if ($this->validaArray($arrayDados)):
	    		$retorno = $this->crud->update($arrayDados, $arrayCondicao);
	    		if($retorno == 1):
	    			echo('<span class="sucesso">Registro alterado com sucesso!</span>');
	    		else:
	    			echo('<span class="erro">Houve um erro ao executar à operação!</span>');
	    		endif;
	    	else:
	    		echo('<span class="falha">Existem campos sem preenchimento!</span>');
	    		exit();
	    	endif;
    	}catch(Exception $e){
	    	return helper_format::printMsgErro('Erro: ' . $e->getMessage());
	    }
    }

        /* 
    * Método para validar e enviar os dados para atualização na classe Crud
    * @param $arrayDados = Array de dados contendo colunas e valor
    * @param $arrayCondicao = Array de dados contendo colunas e valores para condição WHERE - Exemplo array('$id='=>1)   
    */
    public function updateVideo($arrayDados, $arrayCondicao){
    	try{
	    	if ($this->validaArray($arrayDados)):
	    		$retorno = $this->crud->update($arrayDados, $arrayCondicao);
	    		if($retorno == 1):
	    		else:

	    		endif;
	    	else:

	    		exit();
	    	endif;
    	}catch(Exception $e){
	    	return helper_format::printMsgErro('Erro: ' . $e->getMessage());
	    }
    }

    /*   
    * Método público para excluir os dados na tabela   
    * @param $arrayCondicao = Array de dados contendo colunas e valores para condição WHERE - Exemplo array('$id='=>1)   
    * @return Retorna resultado booleano da instrução SQL   
    */
    public function delete($arrayCondicao){
    	try{
	    	if ($this->validaArray($arrayCondicao)):
	    		$retorno = $this->crud->delete($arrayCondicao);
	    		if($retorno == 1):
	    			echo'Registro excluído com sucesso!';
	    		else:
	    			echo'Houve um erro ao executar operação!';
	    		endif;
	    	else:
	    		echo'Existem campos sem preenchimento!';
	    		exit();
	    	endif;
    	}catch(Exception $e){
	    	return helper_format::printMsgErro('Erro: ' . $e->getMessage());
	    }
    }

   /*  
   * Método público para executar instruções de consulta independente do nome da tabela passada no _construct  
   * @param $sql = Instrução SQL inteira contendo, nome das tabelas envolvidas, JOINS, WHERE, ORDER BY, GROUP BY e LIMIT  
   * @param $arrayParam = Array contendo somente os parâmetros necessários para clásusla WHERE  
   * @param $fetchAll  = Valor booleano com valor default TRUE indicando que serão retornadas várias linhas, FALSE retorna apenas a primeira linha  
   * @return Retorna array de dados da consulta em forma de objetos  
   */ 
   public function getDados($sql, $arrayParams=null, $fetchAll=TRUE){
   		try{
   			if(!empty($sql)):
   				$retorno = $this->crud->getSQLGeneric($sql, $arrayParams, $fetchAll);
   				return $retorno;
   			endif;
   		}catch(Exception $e){
	    	return helper_format::printMsgErro('Erro: ' . $e->getMessage());
	    }
   } 
}