<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inserir marca d'água e gerar miniaturas</title>

<!-- Jquery -->
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<!-- Block -->
<script src="js/jquery.block.js"></script> 

<!-- Main -->
<script type="text/javascript" src="js/main.js"></script>

<!-- Main -->
<link href="css/main.css" rel="stylesheet" type="text/css">

</head>

<body>


    <div class="form">

        <h1>Inserir marca d'água e gerar miniaturas</h1>

        <div class="form-wrap">

            <label class="form-label" style="margin-bottom:20px;">
                Informe o diretório de origem:<br/>
                <input type="text" class="form-input" name="dir-origin" value="E:\ORIGEM" />
            </label>
            
            <br/><br/>

            <label class="form-label">
                Informe o diretório destino:<br/>
                <input type="text" class="form-input" name="dir-destiny" value="E:\DESTINO" />
            </label>   
            
            <br/><br/>

            <label class="form-label">
                Informe a extensão:<br/>
                <select class="form-input" name="extension" style="width:100%">
                    <option value="">Selecione</option>
                    <option value=".jpg">JPG</option>
                    <option value=".png">PNG</option>
                    <option value=".pdf">PDF</option>
                    <option value=".tiff">TIFF</option>
                    <option value=".jpeg">JPEG</option>
                    <option value=".gif">GIF</option>
                    <option value=".bmp">BMP</option>
                    <option value=".svg">SVG</option>
                </select> 
            </label> 
            
            <br/><br/>
            
            <label class="form-label">
                Informe a qualidade:<br/>
                <select class="form-input" style="width:100%" name="quality">
                    <option value="100">Selecione</option>    
                    <option value="100">100%</option>
                    <option value="90">90%</option>
                    <option value="80">80%</option>
                    <option value="70">70%</option>
                    <option value="60">60%</option>
                    <option value="50">50%</option>
                    <option value="40">40%</option>
                    <option value="30">30%</option>
                    <option value="20">20%</option>
                    <option value="10">10%</option>
                </select>
            </label>

            <br/><br/>

            <label class="form-label">
                Informe o tamanho da imagem a ser gerada:<br/>
                <input type="text" class="form-input" name="file-size" />
            </label>  

            <br/><br/>             

            <button type="button" onclick="convertDir('convertDirWaterMark.php')" class="send-image" style="width:100%">Gerar miniaturas</button>

        </div>

    </div>



</body>
</html>