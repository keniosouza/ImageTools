<?php

/** Carregamento do autoload */
include_once './vendor/autoload.php';





/** Importação da classe a ser utilizada */
use \vendor\model\ImageTools;





/** Instânciamento das classes */
$ImageTools = new ImageTools();






/** Parametros de entrada */
$file      = isset($_POST['file'])      ? $_POST['file']      : null;//Arquivo no formato base64
$extension = isset($_POST['extension']) ? $_POST['extension'] : null;//Extensão do arquivo seleionado
$quality   = isset($_POST['quality'])   ? $_POST['quality']   : null;//Qualidade do arquivo selecionado






/** Pasta a ser gerado o arquivo temporário a ser convertido*/
$origem = "temp";






/** Pasta a ser gerado o novo arquivo */
$destino = "converted";






/** Nome do arquivo a ser gerado */
$namefile = date('Y-m-d-H-i-s');





try{





    /** Verifica se o arquivo foi informado */
    if(!empty($file)){






        if(!empty($extension)){

            
            

            
            /** Pego os dados do arquivo enviado */
            $data = explode(";", $file);





            /* Pega a extensão do arquivo enviado*/
            $ext = str_replace("/", ".", strtolower(strrchr($data[0],"/")));  





                    
            /** Pega o conteúdo do arquivo */
            $contents = base64_decode(str_replace(" ", "+", substr(strrchr($data[1],","), 1)));






            /** Gera o arquivo na pasta temporária para ser convertido */
            if(file_put_contents($origem.'/'.$namefile.$ext, $contents)){
            

                
                
                /** Verifica se o arquivo foi gerado */
                if(is_file($origem.'/'.$namefile.$ext)){

                    

                    
                    /** Origem da imagem */
                    $temp = __DIR__.'\\'.$origem.'\\'.$namefile.$ext;





                    /** Destino da imagem */
                    $converted = __DIR__.'\\'.$destino.'\\'.$namefile.$extension;





                    /** Converte a imagem */
                    $ImageTools->convertImagem($temp, $converted, $quality);






                    /** Verifica se gerou o arquivo convertido */
                    if(is_file($destino.'/'.$namefile.$extension)){

                       
                       
                       
                       
                        /** Preparo o formulario para retorno **/
                        $result = [

                            'cod' => 1,
                            'title' => 'Atenção',
                            'message' => 'Arquivo convertido com sucesso!',

                        ];

                        /** Envio **/
                        echo json_encode($result);

                        /** Paro o procedimento **/
                        exit;

                        


                    }else{

                        throw new InvalidArgumentException("Não foi possível converter <br/>o arquivo informado", 0);
                    } 
                    
                }else{

                    throw new InvalidArgumentException("Não foi possível gerar <br/>o arquivo na pasta", 0);
                }
                
            }else{

                throw new InvalidArgumentException("Não foi possível gerar <br/>o arquivo informado", 0);
            }

        }else{

            throw new InvalidArgumentException("Informe a extensão do arquivo a ser convertido", 0);
        }

    }else{

        throw new InvalidArgumentException("Informe o arquivo a ser convertido", 0);
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

