<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Dirbuster</title>
     <link rel="icon" href="images/kali_linux._logo.jpg">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <!-- Main css -->
     <link rel="stylesheet" href="css/style.css">
     <link href="https://fonts.googleapis.com/css?family=Lora|Merriweather:300,400" rel="stylesheet">
</head>

<body>
     <section id="home" class="main-home parallax-section">
          <div class="overlay"></div>
          <div id="particles-js"></div>
          <div class="container">
               <div class="row">
                    <div class="col-md-12 col-sm-12">
                         <h1>Dirbuster Tool</h1>
                         <form class="deneme" action=" " method="post" enctype="multipart/form-data">
                              <label for="url" style="color: white;">URL:</label>
                              <input type="text" id="url" name="url" required>
                              <label for="wordlist" style="color: white;">Wordlist:</label>
                              <input class="wordlist" type="file" id="wordlist" name="wordlist" accept=".txt" required style="display: inline;">
                              <select name="curlinfo" id="curlinfo">
                                   <option value="404">404</option>
                                   <option value="200">200</option>
                                   <option value="">Hepsi</option>
                              </select>
                              <br>
                              <input type="submit" value="Gönder">
                         </form>
                         <?php
                         if ($_SERVER["REQUEST_METHOD"] == "POST") {
                              $url = $_POST["url"];
                              $wordlist = $_FILES["wordlist"]["tmp_name"];
                              if (substr($url, -1) != "/") {
                                   $url .= "/";
                              }

                              $lines = file($wordlist, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                              foreach ($lines as $line) {
                                   $full_url = $url . $line;
                                   $handle = curl_init($full_url);
                                   curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
                                   $response = curl_exec($handle);
                                   $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                                   curl_close($handle);

                                   if (curl_getinfo($handle, CURLINFO_HTTP_CODE) == $_POST["curlinfo"]) {
                                        echo $full_url . " - " . $httpCode . "<br>";
                                   }
                                   if ($_POST["curlinfo"] == "") {
                                        echo $full_url . " - " . $httpCode . "<br>";
                                   }
                                  
                              }
                         }
                         ?>
                    </div>
               </div>
          </div>
     </section>
     <a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/particles.min.js"></script>
     <script src="js/app.js"></script>
     <script src="js/jquery.parallax.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>
</body>

</html>