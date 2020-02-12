<!-- There are 2 parts that need to be worked on, the "pointer on the map part", and the "template part". I don't know what to name them, sorry :) While working try to name your work according to the place's name like chateau_angers.php etc..-->

<!-- FILEZILA LOGIN:
address :https://mapproject.u-angers.fr/ 
port : 322
login : mapproject
password : 2df901d52c41

DATABASE LOGIN 
https://3a.u-angers.fr/phpMyAdmin/ 
login : mapproject
password : 2df901d52c41

Form : https://mapproject.u-angers.fr/Interactive_map_form.php   

Results : https://mapproject.u-angers.fr/disp_im.php
-->

<!-- The pointer part needs a .geojson file downloaded on the website https://umap.openstreetmap.fr/fr/ for more details refer to the course of Mr Godon https://moodle.univ-angers.fr/mod/resource/view.php?id=387879 -->
<!-- Then that geojson file needs to be edited, use pointeur_polytech.geojson as a template and then place it in the folder pointeurs_geojson on filezila cf login above. It's not possible to add comments under a .geojson file so if you have any question ask me (Clément) -->
<!-- Finally create a .php file and use the file pointeur_polytech.php as a template of what to do. Then your .php file needs to be included in the "pointer on the map part". Using <?php //include("NameOfYourWork.php"); ?> (remove the //)-->
<!-- Concerning the .php file and that line: iconUrl: 'point.png', //Modifier le nom de l'image du pointeur the icon has ot be uploaded in the mapproject file on Filezila. -->

<!-- Concerning the template part, once the information have been uploaded to the database through the form https://mapproject.u-angers.fr/Interactive_map_form.php you can look at the results to find out what the ID of your work is. https://mapproject.u-angers.fr/disp_im.php -->
<!-- You'll notice that the pictures and pdf files have been renamed according to the place's name -->
<!-- Once you've found out what the id of your work is you can create a .php file and use the template chateau_angers.php under the carousel folder on filezila the lines to edit should be commented-->
<!-- Finally include your work under the right categorie in the "template part" -->

<!-- To check out if everything went well: https://mapproject.u-angers.fr/index.php -->

<?php //Below is the connection to the database
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=mapproject;charset=utf8mb4', 'mapproject', '2df901d52c41', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <style>
    #mapid{
    height : 50%;
    width : 100%;
    }
  </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

/* Full height image header */
.bgimg-1 {
  background-position: center;
  background-size: cover;
  background-image: url("/w3images/mac.jpg");
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
 <body style="background-color: #dadada ">
 
 
 <div id=topimage>
    <img src="https://mapproject.u-angers.fr/image_site/fondbleu.png"border="0" style="width:100%;height:20px">
 </div>
 
  <nav class="navbar navbar-expand-sm  navbar-dark  " style="background-color: white;">
    <a class="navbar-brand" href="https://www.univ-angers.fr/fr/index.html"><img src="https://www.univ-angers.fr/_resources/Documents/DCOM/logo/HORIZONTAL/PAPIER/JPEG/ua_h_couleur.jpg?download=true" alt="ua-h-blanc-ecran-1" border="0" style="width:140px;"></a>
    <a class="navbar-brand" href=""><img src="https://mapproject.u-angers.fr/image_site/barregrise.png" alt="ua-h-blanc-ecran-1" border="0" style="width:30px;height:60px;"></a>
  <a class="navbar-brand" href="http://www.polytech-angers.fr/fr/index.html"><img src="https://mapproject.u-angers.fr/image_site/logopoly.png" alt="ua-h-blanc-ecran-1" border="0" style="width:140px;"></a>
  <ul class="navbar-nav">
    &nbsp&nbsp&nbsp&nbsp
    <li class="nav-item">
      <a class="nav-link" href="#" style="font-family : 'UAPoppinsTitre';font-weight:bold;font-size:20px;color:#009cdd">Map</a>
    </li>
  &nbsp&nbsp&nbsp&nbsp
    <li class="nav-item">
      <a class="nav-link" href="#" style="font-family : 'UAPoppinsTitre';font-weight:bold;font-size:20px;color:#009cdd">Link</a>
    </li>
  </ul>
</nav>
 
  <div id=imagesep>
    <img src="https://www.htmlcsscolor.com/preview/gallery/009CDD.png" border="0" style="width:100%;height:1px">
 </div>

 <br><br><br><br>
<div class="container"> <div id="mapid" style="border-style:solid;border-width:3px;border-color:#009cdd"></div> </div>

    <!-- Team Section -->

    <!--"POINTER ON THE MAP PART"-->
<div class="w3-container-sm" style="padding:10px 16px" id="team">
  <h3 class="w3-center">Angers</h3>
  <p class="w3-center w3-large">Top Attractions</p>
  
    </div>
     <script>
        var map = L.map('mapid').setView([47.48, -0.55], 13);
        var osmLayer = L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            attribution: '© <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        });
        map.addLayer(osmLayer);

    //This is where we include the .php files specific to each points on the map
    //There should have been a lot of code here but to keep the index manageable we are going to separate each point in .php file
    <?php include("pointeur_chateau.php"); ?> //So that's the first point 
    <?php include("pointeur_polytech.php"); ?> //Second one
    //And so on..
  </script>
  
  </div>
</div>



    <!--"POINTER ON THE MAP PART"-->
  <div id="accordion">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapseOne">
Sights & Landmarks        </a>
      </div>
      <div id="collapseOne" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <!--In this part we add the Sight & Landmarks templates-->
          <!-- It's the same system as above with the pointers, the code has been separated in smaller parts -->
          <?php include("Carousel/chateau_angers.php"); ?> <!--Here is the first template-->
          <!-- If anyone knows a way to make the template apear side by side instead of in a column that would be great-->
          <?php include("Carousel/chateau_angers.php"); ?> <!--Second one-->
          <?php include("Carousel/chateau_angers.php"); ?> <!--And so on-->

        </div>
      </div>
    </div>
  
  
  
  
  
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
        Restaurants
      </a>
      </div>
      <div id="collapseTwo" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <!--In this part we add the Restaurants templates-->
          <?php include("Carousel/chateau_angers.php"); ?><!--Exemple-->
        </div>
      </div>
    </div>
  
  
  
  
  
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
          Pubs
        </a>
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <!--In this part we add the Pubs templates-->
          <?php include("Carousel/chateau_angers.php"); ?><!--Exemple-->
        </div>
      </div>
    </div>
  </div>   
    
  
  <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
          Stores
        </a>
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <!--In this part we add the Stores templates-->
          <?php include("Carousel/chateau_angers.php"); ?><!--Exemple-->
        </div>
      </div>
    </div>
  </div>   
  
    <br><br><br>
    
    
    
    
    <footer class="w3-container w3-dark-blue" style="padding:32px">
  <a href="#" class="w3-button w3-black w3-padding-small w3-margin-bottom"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">Polytech Angers</a></p>
</footer>
    
</body>
</html>
