<?php
set_time_limit(0);

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
$fileSize   = isset($_POST['fileSize'])   ? $_POST['fileSize']   : null;//Qualidade do arquivo selecionado



/** Barra */
$bar = "\ ";



try{





    /** Verifica se o diretorio de origem foi informado */
    if(!empty($dirOrigin)){





        /** Verifica se o diretorio de destino foi informado */
        if(!empty($dirDestiny)){





            /** Verifica se a extensão foi informada */
            if(!empty($extension)){            

            
            



                /** Verifica se a qualidade foi informada */
                if(!empty($quality)){   






                    /** Verifica se a qualidade foi informada */
                    if(!empty($fileSize)){  





                
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

                                    
                                    
                                    
                                    /** Pega informações das dimensões do arquivos */
                                    $size = getimagesize($dirOrigin.trim($bar).$arquivo);






                                    /** Separa as informações da imagem */
                                    $wh = explode(" ", $size[3]);





                                    /** Pega a largura da imagem */
                                    $width = (int)str_replace(array('width=', '"'), "", $wh[0]);





                                    /** Pega a altura da imagem */
                                    $height = (int)str_replace(array('height=', '"'), "", $wh[1]);   
      



                                    /** Arquivo a ser convertido no formato padrão */
                                    $file = str_replace(trim($bar), trim($bar).trim($bar), $dirOrigin).trim($bar).trim($bar).$arquivo;





                                    /** Pega o nome do arquivo para separar da extensão */
                                    $str = explode(".", $arquivo);





                                    /** Novo arquivo a ser gerado com a marca d'água */
                                    $filenew = str_replace(trim($bar), trim($bar).trim($bar), $dirDestiny).trim($bar).trim($bar).$str[0].$extension;






                                    /** Converte a imagem, coloca a marca d'água e escreve o nome do arquivo na imagem*/
                                    $ImageTools->convertWaterMark($file, $filenew, $quality, $str[0], $width, $height, $fileSize);          
                                    
                                    

                            

                                }
                                
                            }


                        }
                        $diretorio -> close();



                        /** Preparo o formulario para retorno **/
                        $result = [

                            'cod' => 1,
                            'title' => 'Atenção',
                            'message' => 'Arquivo(s) processado(s) com sucesso!',

                        ];

                        /** Envio **/
                        echo json_encode($result);

                        /** Paro o procedimento **/
                        exit;

                    }else{

                        throw new InvalidArgumentException("Informe o tamanho da imagem", 0);
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
        'message' => '<h3>Atenção</h3>'.$exception->getMessage(),

    ];

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;    
}

