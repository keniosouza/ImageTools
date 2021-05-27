<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

/** Carregamento do autoload */
include_once './vendor/autoload.php';





/** Importação da classe a ser utilizada */
use \vendor\model\ImageTools;





/** Instânciamento das classes */
$ImageTools = new ImageTools();






/** Parametros de entrada */
$dirOrigin  = isset($_POST['dirOrigin'])  ? $_POST['dirOrigin']  : null;//Arquivo no formato base64
$dirDestiny = isset($_POST['dirDestiny']) ? $_POST['dirDestiny'] : null;//Arquivo no formato base64
$extension  = isset($_POST['extension'])  ? $_POST['extension']  : null;//Extensão do arquivo seleionado
$quality    = isset($_POST['quality'])    ? $_POST['quality']    : null;//Qualidade do arquivo selecionado




/** Extensão padrão */
$default = ".jpg";

/** Extensão do arquivo */
$ext = "";

/** Arquivo a ser gerado */
$file = "";


/** Novo arquivo a ser gerado no formato padrão */
$filenew = "";

/** Barra */
$bar = "\ ";


/** Arquivo a ser gerado */
$output = "output-".date('Y-d-m-H-i-s');

try{





    /** Verifica se o diretorio de origem foi informado */
    if(!empty($dirOrigin)){





        /** Verifica se o diretorio de destino foi informado */
        if(!empty($dirDestiny)){





            /** Verifica se a extensão foi informada */
            if(!empty($extension)){            

            
            



                /** Verifica se a qualidade foi informada */
                if(!empty($quality)){   


                
                    /** Lista o diretorio de origem para verificar 
                     * se todas as imagens estão no padrão default. 
                     * Caso não esteja no formato padrão, efetua a conversão das mesmas para o formato padrão*/
                    $diretorio = dir($dirOrigin);
                    while($arquivo = $diretorio -> read()){


                        if(!empty($arquivo)){

                            
                            /** Pega a extensão do arquivo */
                            $ext = strrchr($arquivo,".");

                            /** Verifica se a extensão é válida */
                            if(strlen($ext) > 2){

                                /** Verifica se a extensão informada é diferente da padrão */
                                if($ext != $default){

                                    /** Arquivo a ser convertido no formato padrão */
                                    $file = str_replace(trim($bar), trim($bar).trim($bar), $dirOrigin).trim($bar).trim($bar).$arquivo;

                                    /** Pega o nome do arquivo para separar da extensão */
                                    $str = explode(".", $arquivo);

                                    /** Novo arquivo a ser gerado no formato padrão */
                                    $filenew = str_replace(trim($bar), trim($bar).trim($bar), $dirOrigin).trim($bar).trim($bar).$str[0].$default;

                                    /** Converte a imagem */
                                    $ImageTools->convertImagem($file, $filenew, 80);                                    
                                }

                            }
                            
                        }


                    }
                    $diretorio -> close();

                    /** Define a pasta de origem e o arquivo padrão */
                    $origin = str_replace(trim($bar), trim($bar).trim($bar), $dirOrigin).trim($bar).trim($bar).'*'.$default;


                    /** Define a pasta destino e o arquivo a ser criado */
                    $destiny = str_replace(trim($bar), trim($bar).trim($bar), $dirDestiny).trim($bar).trim($bar).$output.$extension;                    


                    /** Converte as imagens de um diretório para outro */
                    $ImageTools->convertTiffMultiPage($origin, $destiny, $quality); 


                    /** Verifica se o arquivo  foi gerado */
                    if(is_file($dirDestiny.'/'.$output.$extension)){



                        /** Preparo o formulario para retorno **/
                        $result = [

                            'cod' => 1,
                            'title' => 'Atenção',
                            'message' => 'Arquivo agrupado gerado com sucesso!',

                        ];

                        /** Envio **/
                        echo json_encode($result);

                        /** Paro o procedimento **/
                        exit;



                    }else{

                        throw new InvalidArgumentException("Não foi possivel gerar o arquivo agrupado", 0);
                    }


                }else{

                    throw new InvalidArgumentException("Informe a qualidade para os arquivos convertidos", 0);
                } 

            
            }else{

                throw new InvalidArgumentException("Informe a extensão para os arquivos convertidos", 0);
            }           


        }else{

            throw new InvalidArgumentException("Informe o diretório de destino para os arquivos convertidos", 0);
        }

    }else{

        throw new InvalidArgumentException("Informe o diretório a ser convertido", 0);
    }


}catch(Exception $exception){


    /** Preparo o formulario para retorno **/
    $result = [

        'cod' => 0,
        'title' => 'Erro Interno',
        'message' => $exception->getMessage(),

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;    
}

