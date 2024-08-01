
<?php
$servername = "localhost";
$username = "root";
$password = "";
$nomBS ="appstage";


$conn = mysqli_connect($servername, $username, $password,$nomBS);
    if (!$conn) {
        die ("erreur:".mysqli_connect_error());
    }
    $cin=$_GET["c"];
     $nom=$_GET["n"];
     $prenom=$_GET["p"];
     $entreprise=$_GET["e"];
     $direction=$_GET["d"];
     $telephone=$_GET["t"];
     $email=$_GET["m"];
     $themeformation=$_GET["tf"];
    
$sql = "INSERT INTO participant (cin,nom,prenom,entreprise,direction,telephone,email,themeformation)
VALUES ('$cin','$nom','$prenom','$entreprise','$direction','$telephone','$email','$themeformation')";

if (!mysqli_query($conn,$sql)) 
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  else
  { header('location:Home.html');
 };


?>

