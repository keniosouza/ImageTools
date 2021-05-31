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
    private $font = null;
    private $nameFile = null;
    private $width = null;
    private $height = null;
    private $guidance = null;
    private $fileSize = null;
    
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
           
    }

    /** Gera miniaturas e insere a marca d'água em imagens em um determinado diretório */
    public function convertWaterMark(string $origem, string $destino, string $qualidade, string $nameFile, int $width, int $height, int $fileSize)
    {
        /** Parametros de entrada */
        $this->origem = $origem;
        $this->destino = $destino;
        $this->qualidade = !empty($qualidade) ? "-resize ".$qualidade."%" : "";
        $this->nameFile = $nameFile;
        $this->font = "Arial";     
        $this->width = $width;
        $this->height = $height; 
        $this->fileSize = $fileSize; 
        $this->watermark = "img/watermark.png";


        //Redimensiona a imagem e gera na pasta de destino       
        $this->command = "{$this->imageMagick} {$this->origem} {$this->qualidade} -resize {$this->fileSize}x{$this->fileSize} -background Khaki label:{$this->nameFile} -gravity center -append {$this->destino}";

        /** Executa o comando de converter o arquivo */
        exec($this->command);

        //Coloca a marca d' água
        $this->command = "{$this->imageMagick} convert {$this->destino} {$this->watermark} -gravity center -composite {$this->destino}";

        /** Executa o comando de converter o arquivo */
        exec($this->command);        

    }

    /** Destrutor da classe */
	function __destruct(){}   

}