function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

/** Envia a imagem para converter */
function convertImage(){

    var buffer = $('.file-upload-image').attr('src');
    var extension = $('select[name="extension"]').val();
    var quality = $('select[name="quality"]').val();

    if(buffer) {//Verifica se o arquivo foi selecionado

        if(extension){//Verifica se a extensão foi selecionada

            if(quality){//Verifica se a qualidade foi selecionada

                $.blockUI({ 
                    message: 'Aguarde',
                    css: {
                        border: 'none',
                        padding: '5px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                        } 
                });


                $.ajax({

                    /** Dados para envio */
                    url : 'convert.php',
                    type : 'post',
                    dataType : 'json',
                    data : 'file='+buffer+'&extension='+extension+'&quality='+quality,
            
                    /** Caso tenha sucesso */
                    success: function(response) {
            
                        /** Cancelo o loading */
                        $.unblockUI();
            
                        switch (parseInt(response.cod)) {
            
                            case 1:

                                /** Informa o erro */
                                $.blockUI({ 
                                    message: response.message,
                                    css: {
                                        border: 'none',
                                        padding: '5px',
                                        backgroundColor: '#000',
                                        '-webkit-border-radius': '10px',
                                        '-moz-border-radius': '10px',
                                        opacity: .5,
                                        color: '#fff'
                                    } 
                                }); 
                                
                                /** Fecha a mensagem de erro após 5 segundos */
                                setTimeout($.unblockUI, 5000);                 
            
                                break;                 
            
                            default:
            
            
                                /** Informa o erro */
                                $.blockUI({ 
                                    message: response.message,
                                    css: {
                                        border: 'none',
                                        padding: '5px',
                                        backgroundColor: '#000',
                                        '-webkit-border-radius': '10px',
                                        '-moz-border-radius': '10px',
                                        opacity: .5,
                                        color: '#fff'
                                    } 
                                }); 
            
                                /** Grava o log */
                                console.log(response.log);
                                
                                /** Fecha a mensagem de erro após 5 segundos */
                                setTimeout($.unblockUI, 5000);  
                                
                                break;                      
            
                        }
                    
            
                    },
            
                    /** Caso tenha falha */
                    error: function (xhr, ajaxOptions, thrownError) {
            
                        /** Cancelo o loading */
                        $.unblockUI();            

                        /** Informa o erro */
                        $.blockUI({ 
                            message: 'Error :: '+thrownError,
                            css: {
                                border: 'none',
                                padding: '5px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .5,
                                color: '#fff'
                                } 
                        }); 
                        
                        /** Fecha a mensagem de erro após 5 segundos */
                        setTimeout($.unblockUI, 5000);  
                
                    }
            
                });
            }
        }

    }
}




/** Converte um diretório selecionado */
function convertDir(){

    var dirOrigin  = $('input[name="dir-origin"]').val();
    var dirDestiny = $('input[name="dir-destiny"]').val();
    var extension  = $('select[name="extension"]').val();
    var quality    = $('select[name="quality"]').val();    

    if(dirOrigin) {//Verifica se o diretório de origem foi informado

        if(dirDestiny) {//Verifica se o diretório de destino foi informado

            if(extension){//Verifica se a extensão foi selecionada

                if(quality){//Verifica se a qualidade foi selecionada

                    $.blockUI({ 
                        message: 'Aguarde',
                        css: {
                            border: 'none',
                            padding: '5px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                            } 
                    });


                    $.ajax({

                        /** Dados para envio */
                        url : 'convertDir.php',
                        type : 'post',
                        dataType : 'json',
                        data : 'dirOrigin='+dirOrigin+'&dirDestiny='+dirDestiny+'&extension='+extension+'&quality='+quality,
                
                        /** Caso tenha sucesso */
                        success: function(response) {
                
                            /** Cancelo o loading */
                            $.unblockUI();
                
                            switch (parseInt(response.cod)) {
                
                                case 1:

                                    /** Informa o erro */
                                    $.blockUI({ 
                                        message: response.message,
                                        css: {
                                            border: 'none',
                                            padding: '5px',
                                            backgroundColor: '#000',
                                            '-webkit-border-radius': '10px',
                                            '-moz-border-radius': '10px',
                                            opacity: .5,
                                            color: '#fff'
                                        } 
                                    }); 
                                    
                                    /** Fecha a mensagem de erro após 5 segundos */
                                    setTimeout($.unblockUI, 5000);                 
                
                                    break;                 
                
                                default:
                
                
                                    /** Informa o erro */
                                    $.blockUI({ 
                                        message: response.message,
                                        css: {
                                            border: 'none',
                                            padding: '5px',
                                            backgroundColor: '#000',
                                            '-webkit-border-radius': '10px',
                                            '-moz-border-radius': '10px',
                                            opacity: .5,
                                            color: '#fff'
                                        } 
                                    }); 
                
                                    /** Grava o log */
                                    console.log(response.log);
                                    
                                    /** Fecha a mensagem de erro após 5 segundos */
                                    setTimeout($.unblockUI, 5000);  
                                    
                                    break;                      
                
                            }
                        
                
                        },
                
                        /** Caso tenha falha */
                        error: function (xhr, ajaxOptions, thrownError) {
                
                            /** Cancelo o loading */
                            $.unblockUI();            

                            /** Informa o erro */
                            $.blockUI({ 
                                message: 'Error :: '+thrownError,
                                css: {
                                    border: 'none',
                                    padding: '5px',
                                    backgroundColor: '#000',
                                    '-webkit-border-radius': '10px',
                                    '-moz-border-radius': '10px',
                                    opacity: .5,
                                    color: '#fff'
                                    } 
                            }); 
                            
                            /** Fecha a mensagem de erro após 5 segundos */
                            setTimeout($.unblockUI, 5000);  
                    
                        }
                
                    });
                }
            }

        }
    }
}
