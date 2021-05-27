<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

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

        <h1>Informe o diretório a ser convertido</h1>

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
                <select class="form-input" name="extension" style="width:100%">
                    <option value="">Extensão</option>
                    <option value=".pdf">PDF</option>
                    <option value=".tiff">TIFF</option>
                </select> 
            </label> 
            
            <br/><br/>
            
            <label class="form-label">
                <select class="form-input" style="width:100%" name="quality">
                    <option value="100">Qualidade</option>    
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

            <button type="button" onclick="convertDir()" class="send-image" style="width:100%">Converter Imagens</button>

        </div>

    </div>



</body>
</html>