<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Converte Imagem em outro formato</title>

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




    <div class="file-upload">
      <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Adicionar imagem</button>
    
      <div class="image-upload-wrap">
        <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
        <div class="drag-text">
          <h3>Arraste e solte um arquivo ou selecione adicionar imagem</h3>
        </div>
      </div>
      <div class="file-upload-content">
        <img class="file-upload-image" src="#" alt="your image" />
        <div class="image-title-wrap">
          <button type="button" onclick="removeUpload()" class="remove-image">Remover <span class="image-title">Uploaded Imagem</span></button><br/>
          <select class="send-image" name="extension">
          <option value="">Extensão</option>
              <option value=".jpg">JPG</option>
              <option value=".png">PNG</option>
              <option value=".pdf">PDF</option>
              <option value=".tiff">TIFF</option>
              <option value=".jpeg">JPEG</option>
              <option value=".gif">GIF</option>
              <option value=".bmp">BMP</option>
              <option value=".svg">SVG</option>
          </select><br/>
          <select class="send-image" name="quality">
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
          </select><br/>          
          <button type="button" onclick="convertImage()" class="send-image">Enviar</button>
        </div>
      </div>
    </div>

</body>
</html>