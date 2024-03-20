<?php
require_once('../functions.php');

$query="SELECT * FROM parametra order by id desc";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$cover=$row["cover"]?$row["cover"]:'default.jpg';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://unpkg.com/bootstrap@4/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="cropper.css">
  <style>
    .label {
      cursor: pointer;
    }

    .progress {
      display: none;
      margin-bottom: 1rem;
    }

    .alert {
      display: none;
    }

    .img-container img {
      max-width: 100%;
    }
  </style>
</head>
<body>
<div id="gjitha">  
    <label class="label" data-toggle="tooltip" title="Ndrysho">
      <img class="rounded" id="avatar" src="../../../media/cover/<?php echo $cover?>" alt="Cover"  width="320" height="188">
      <input type="file" class="sr-only" id="input" name="image" accept="image/*">
    </label>
    <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
    <div class="alert" role="alert"></div>
    
    
    <div class="img-container" style="display:none"><img id="image" src="" width="640"></div>
    
    <button type="button" id="submit" class="btn btn-primary vazhdo" style="display:none" >Vazhdo</button>
</div>
  <script src="https://unpkg.com/jquery@3/dist/jquery.min.js" crossorigin="anonymous"></script>
  <script src="cropper.js"></script>
  <script>
    window.addEventListener('DOMContentLoaded', function () {
      var avatar = document.getElementById('avatar');
      var image = document.getElementById('image');
      var input = document.getElementById('input');

      var cropper;

   

      input.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
          input.value = '';
          image.src = url;
          $(".img-container").show();
          $("#submit").show();
          $(".label").hide();

         cropper = new Cropper(image, {
          aspectRatio: 2.82,
          viewMode: 1,
        });
      
        
      
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
          file = files[0];

          if (URL) {
            done(URL.createObjectURL(file));
          } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
      });



      document.getElementById('submit').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        if (cropper) {
          canvas = cropper.getCroppedCanvas({
            width: 4096,
            height: 4096,
            minWidth: 4096,
            minHeight: 4096,
            maxWidth: 4096,
            maxHeight: 4096,
            fillColor: '#000',
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
          });
          initialAvatarURL = avatar.src;
          avatar.src = canvas.toDataURL();
          canvas.toBlob(function (blob) {
            var formData = new FormData();
            let r = (Math.random()*1e32).toString(36);
            formData.append('cover', blob, r + '.jpg');
            $.ajax('up.php', {
              method: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              xhr: function () {
                var xhr = new XMLHttpRequest();
                return xhr;
              },

              success: function (result) {
              },

              error: function () {
                avatar.src = initialAvatarURL;
              },

              complete: function (result) {
                          $(".img-container").hide();
                          $("#submit").hide();
                          $(".label").show();
                          cropper.destroy();
                          cropper = null;
                     
              },
            });
          },'image/jpeg',1);
        }
      });
    });
    
  </script>
</body>
</html>
