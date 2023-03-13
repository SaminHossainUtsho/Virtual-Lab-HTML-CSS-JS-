<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/design.css">
    <title>Document</title>
</head>
<style>
    body {
        background-color: cadetblue;
    }

    .container {
        background-color: white;
        height: 100px;
        width: 200px;
        text-align: center;
        margin-left: 400px;
        margin-top: 150px;
        animation: zoomit;
        box-shadow: 6px 6px 10px black;
        
    }

    .box {
        color: brown;
        text-align: center;

    }

    .box p {
        color: black;
        font-size: small;
        text-align: justify;
    }

    .container:hover {
        transform: scale(3);
    }
    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: black !important;
  opacity: 1; /* Firefox */
}
</style>
<script>
    /*

    RECEIVE FILES IN GOOGLE DRIVE
    - - - - - - - - - - - - - - - 
      
*/

function doGet(e) {
  return HtmlService.createHtmlOutputFromFile('forms.html').setTitle("Google File Upload by CTRLQ.org");
}


function uploadFileToGoogleDrive(data, file, name, email) {
  
  try {
    
    var dropbox = "Received Files";
    var folder, folders = DriveApp.getFoldersByName(dropbox);
    
    if (folders.hasNext()) {
      folder = folders.next();
    } else {
      folder = DriveApp.createFolder(dropbox);
    }
    
    var contentType = data.substring(5,data.indexOf(';')),
        bytes = Utilities.base64Decode(data.substr(data.indexOf('base64,')+7)),
        blob = Utilities.newBlob(bytes, contentType, file),
        file = folder.createFolder([name, email].join(" ")).createFile(blob);
    
    return "OK";
    
  } catch (f) {
    return f.toString();
  }
  
}
</script>
<body>
    <nav class="navbar background">
        <ul class="navlist">
            <div class="logo"><img src="logo.jpg"></div>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">Submit</a></li>
            <li><a href="Quiz.html">Quiz</a></li>
            <li><a href="Sign Up.html">SignUp</a></li>
            <li><a href="Log in.html">Login</a></li>
        </ul>
        

    </nav>
    


    <html>
  <head>
    <base target="_blank">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Google File Upload by CTRLQ.org</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <style>
      .disclaimer{width: 480px; color:#646464;margin:20px auto;padding:0 16px;text-align:center;font:400 12px Roboto,Helvetica,Arial,sans-serif}.disclaimer a{color:#009688}#credit{display:none}
    </style>
  </head>
  <body>

    <!-- Written by Amit Agarwal amit@labnol.org --> 

    <form class="main" method="post" enctype="multipart/form-data" id="form" novalidate="novalidate" style="max-width: 480px;margin: 40px auto;">
      <div id="forminner">
        <div class="row">
         
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="name" type="text" name="Name" class="validate" required="" aria-required="true">
            <label for="name">Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="email" type="email" name="Email" class="validate" required="" aria-required="true">
            <label for="email">Email Address</label>
          </div>
        </div>

        <div class="row">
          <div class="file-field input-field col s12">
            <div class="btn">
              <span>File</span>
              <input id="files" type="file" name="file" accept="*">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" placeholder="Select a file on your computer">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <button name="submit" class="waves-effect waves-light btn submit-btn" type="submit">Submit</button>
          </div>   
        <!-- </div>
        <div class="row">
          <div class="input-field col s12" id = "progress">
          </div>
        </div>
      </div>
      <div id="success" style="display:none">
        <h5 class="left-align teal-text">File Uploaded</h5>
        <p>Your file has been successfully uploaded.</p>
        <p>The <a href="http://www.labnol.org/internet/file-upload-google-forms/29170/">pro version</a> (see <a href="http://j.mp/GoogleFormsDemo">demo form</a>) includes a visual drag-n-drop form builder, CAPTCHAs, the form responses are saved in a Google Spreadsheet and respondents can upload multiple files of any size.</p>    
        <p class="center-align"><a  class="btn btn-large" href="https://gum.co/GA14?wanted=true" target="_blank">Upgrade to Pro</a></p>
      </div> -->
    </form>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<!--     <script src="https://gumroad.com/js/gumroad.js"></script> -->

    <script>

      var file, 
          reader = new FileReader();

      reader.onloadend = function(e) {
        if (e.target.error != null) {
          showError("File " + file.name + " could not be read.");
          return;
        } else {
          google.script.run
            .withSuccessHandler(showSuccess)
            .uploadFileToGoogleDrive(e.target.result, file.name, $('input#name').val(), $('input#email').val());
        }
      };

      function showSuccess(e) {
        if (e === "OK") { 
          $('#forminner').hide();
          $('#success').show();
        } else {
          showError(e);
        }
      }

      function submitForm() {

        var files = $('#files')[0].files;

        if (files.length === 0) {
          showError("Please select a file to upload");
          return;
        }

        file = files[0];

        if (file.size > 1024 * 1024 * 5) {
          showError("The file size should be < 5 MB. Please <a href='http://www.labnol.org/internet/file-upload-google-forms/29170/' target='_blank'>upgrade to premium</a> for receiving larger files in Google Drive");
          return;
        }

        showMessage("Uploading file..");

        reader.readAsDataURL(file);

      }

      function showError(e) {
        $('#progress').addClass('red-text').html(e);
      }

      function showMessage(e) {
        $('#progress').removeClass('red-text').html(e);
      }


    </script>

  </body>

</html>

    <script src="search.js"></script>
</body>

</html>
<?php
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
}
?>