<?php
echo "    <html>
		<head>
		<title> JustAlternate's color filter </title>
		<script src='https://kit.fontawesome.com/3865f4d527.js' crossorigin='anonymous'></script>
		<link rel='stylesheet' type='text/css' href='style.css' />
		<link rel='stylesheet' type='text/css' href='gradient_background.css' />
		</head>

		<body onmouseover='change_color_1and2()' >

";

echo "
		<p class='title' > Où est la voie ? </p>


		<div class = 'cadre_debut'>

		  <div class= 'images'>
			<img src='wall1.png' class='pic'>
			<img src='filtered_wall1.png' class='pic'>
		  </div>

		  <div class= 'explication'>

		  <p> 'Où est la voie ?' est un site permettant de mettre en evidence les prises d'une même couleur d'un mur d'escalade.<br><br>
		  Pour commencer, Prenez en photo votre mur d'escalade d'interieur, assurez vous d'avoir une image bien éclairée et nette.<br><br>
		  Ensuite cliquez sur le bouton 'Selectionnez une photo' puis choisissez l'image dans votre galerie.<br><br>
		  Enfin choisissez une couleur parmis la liste donnée, puis lorsque tout est prêt, appuyez sur 'Envoyer'</p>
		
    <div class='parametrage'>";

// On regarde si on veut upload un fichier. 
if (isset($_FILES["file"])){
  $target_file = ($_FILES["file"]["name"]); //On recupere le nom du nouveau fichier a mettre
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));// On recupere le format du fichier
  $uploadOk = 0;
  // Check if file already exists
  if (file_exists("images_to_process/".htmlspecialchars(basename($_FILES["file"]["name"])))) {
    echo "<p style='color: red;'>Désolée, vous venez de faire une requete pour ajouter un fichier, mais celui çi existe déjà. </p>";
    $uploadOk = 1;
  }

  // Check file size
  if ($_FILES["file"]["size"] > 15000000) {
    echo "<p style='color: red;'>Désolée, votre fichier et trop gros, il dépasse la taille maximal definie (8 Méga octets) : ".$_FILES["file"]["size"]."</p>";
    $uploadOk = 1;
  }

  // if everything is ok, try to upload file
  if ($uploadOk == 0) {
    if (copy($_FILES["file"]["tmp_name"], "images_to_process/".htmlspecialchars(basename($_FILES["file"]["name"])))) { // On upload le fichier sur le repertoire cible
      echo "<p style='color: green;'>Le fichier : ". htmlspecialchars(basename($_FILES["file"]["name"])). " a bien été envoyée !</p>"; //message succes
      $color1 = $_POST['color_picker'];
      $intensity = $_POST['range'];

      exec("python3 wall_recognition2.py ".htmlspecialchars(basename($_FILES["file"]["name"]))." '".$color1."' ".$intensity."");

      //sleep(5);
      
      // On verifie que tout s'est bien passé puis on tente d'afficher l'image normalement généré : 
      $img = "<img class='final_img' src='images_processed/filtered_".htmlspecialchars(basename($_FILES['file']['name']))."'>";
      
    }else {
      echo "<p style='color: red;'>Désolée, il y a eu une erreur lors d'une traitement. </p>"; //Message echec
    }
  }
}

// On affiche le formulaire d'envoie de fichier 
echo " 
  <form onmouseover='change_color_1and2()' onsubmit='loader()' action='index.php' method='post' id='color_form' enctype='multipart/form-data'>
      <input type='file' name='file' id='file'> 
      <label for='favcolor'> Couleur personnalisé : </label>
      <input type='color' id='color_picker' onmouseover='change_color_1and2()' onclick='change_color_1and2()' name='color_picker' value='None'>
      <span>Sensibilite :</span> 
      <span id='f' style='font-weight:bold;color:red'> 10 </span>
      <input type='range' min='5' max='30' value='10' class='slider' id='range' name='range'>
      <input type='submit' value='Envoyer' name='submit'>
  </form>
 </div>

 
 </div></div>";

echo $img;

echo "
<div>
     <div class='wave'></div>
     <div class='wave'></div>
     <div class='wave'></div>
</div>


<div class='loader-wrapper'>
  <span class='loader'><span class='loader-inner'></span></span>
</div>
<script src='https://code.jquery.com/jquery-2.2.4.min.js' integrity='sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=' crossorigin='anonymous'></script>
<script>
function loader() {
	$('.loader-wrapper').fadeIn('slow');
}
$('.loader-wrapper').fadeOut(0);
</script>



</body>
<script src='script.js' crossorigin='anonymous'></script>

</html>

";

?>

