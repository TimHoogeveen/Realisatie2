<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 </script>
<?php session_start(); ?>
<!doctype html>
<html>
    <head>
    <title>Inloggen</title>
    <link rel="icon" type="" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="" href="">
    </head>
    <body>
    <form action= "./inloggen_query.php" name="inloggen" method="post" enctype="multipart/form-data">
              Email: <br><input type="email" class="field" name="email-inlog" placeholder="E-mail adres"><br><br>
              Wachtwoord: <br><input type="password" class="field" name="password-inlog" placeholder="Wachtwoord"><br><br>
              <input type="submit" class="button" name="login" value="Inloggen"><br>
              <br>Nog geen account?<br>
              <a href="registreren.php">
                  <input type="button" class="button" name="inschrijven" value="Inschrijven">
              </a>
            </form>
        
        
    </body>