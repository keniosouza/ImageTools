<?php
/**
* Classe ImageTools.class.php
* @filesource
* @autor		Kenio de Souza
* @copyright	Copyright 2021 - Souza Consultoria Tecnológica 
* @package		model
* @subpackage	model.class
* @version		1.0
*/

/** Defino o local onde esta a classe */
namespace vendor\model;

class ImageTools{

    /** Declaro as variaveis da classe */
    private $origem = null;
    private $destino = null;
    private $command = null;
    
    /** Caminho absoluto do imageMagick */
    private $imageMagick = "cmd /c C:\\ImageMagick\\magick.exe";


	/** Construtor da classe */
	function __construct(){}    


    /** Converte a imagem no formato informado */
    public function convertImagem(string $origem, string $destino, string $qualidade)
    {
        /** Parametros de entrada */
        $this->origem = $origem;
        $this->destino = $destino;
        $this->qualidade = !empty($qualidade) ? "-resize ".$qualidade."%" : "";

        //Informa os comandos para efetuar a conversão
        $this->command = "{$this->imageMagick} {$this->origem} {$this->qualidade} {$this->destino}";

        /** Executa o comando de converter o arquivo */
        exec($this->command);

    }

    /** Converte um diretório inteiro para um tiff multipage */
    public function convertTiffMultiPage(string $origem, string $destino, string $qualidade){

        /** Parametros de entrada */
        $this->origem = $origem;
        $this->destino = $destino;
        $this->qualidade = !empty($qualidade) ? "-resize ".$qualidade."%" : "";

        //Informa os comandos para efetuar a conversão
        $this->command = "{$this->imageMagick} {$this->origem} {$this->qualidade} -compress lzw {$this->destino}";

        /** Executa o comando de converter o arquivo */
        exec($this->command);
        
        /** Comando utilizado */
        //magick convert *.jpg -resize 80% -compress lzw output.tif        
    }



    /** Comando para converte TIFF para PDF 
     * magick mogrify -format pdf *.tiff
    */

    /** Destrutor da classe */
	function __destruct(){}   

}