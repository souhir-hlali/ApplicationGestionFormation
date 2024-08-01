<?php
session_start();

?>

<!DOCTYPE html>
<html>


   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Interface Admin</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <style> 
   table   { position: relative;
    top: 25px;
  border:4px solid ;}
  tr{
    border:3px solid gray  ;
  }
  #h33{
    text-align: center;
    color: blueviolet;
  }
  #div1{
    position: relative;
    left:40%;
    top: 20px;
  }
  #div2{
    position: relative;
    top:80px;
    border:2px;
  }
  .update{
    position: relative;
    top:16vh;
  }
  .ajout{
    position: relative;
    top:2vh;
  }
 
 
</style>
<link rel="stylesheet" href="indexPage.css">
    </head>
   <body>
     
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>   </body>
     <header class="header">
    <nav class="navbar">
        <a href="PageCycle.php">Cycle</a>
       <a href="PageFormateur.php">Formateur</a>
       <a href="PageParticipant.php">Liste des Participants</a>
        
    </nav>
    <a href="Home.html">Deconnexion</a>
</header>
<?php
include("adminBase.php");

$Action=isset($_GET['action'])?$_GET['action']:'0';


switch($Action){
case 0: 
     AfficherInterface();
     break;
case 1: 
        insertEtu();
       
        break;
case 2: 
        updateEtu();
      
        break;
case 3:
        DeleteEtu();
        AfficherInterface('suppression ok');
        break;
default:
return ('erreur dans la base');

}



function AfficherInterface()
{  echo"<div class='div'> ";
    echo" <form name='f' method='GET' action=''  >
    <a type='button' class='btn btn-primary' href='PageCycle.php?action=1 '>Ajouter Nouvelle Cycle</a> ";
    
     $sql = "SELECT * FROM cycle ";
     $result = mysqli_query(OpenBase(), $sql);
      if($result){
  
        
    echo"
     <table class='table table-bordered'>
     <thead>
          <tr>
            <td > Numero </td>
              <td > Entreprise </td>
              <td> Gouvernorat </td>
              <td> LieuDeroulement</td>
              <td>NumeroSalle</td>
              <td>ThemeFormation</td>
              <td>PeriodeDebut</td>
              <td>PeriodeFin</td>
              <td colspan='2'>Action </td>
          </tr>
          </thead>";
           while($row=mysqli_fetch_assoc($result)) { 
            echo" <tbody>
            <tr>
              <td > ".$row['numero']. "</td>
              <td>".$row['entreprise'] ."</td>
              <td> ".$row['gouvernorat'] ."</td>
              <td>". $row['lieuderoulement'] ." </td>
              <td> ".$row['numerosalle'] ." </td>
              <td> ".$row['themeformation'] ." </td>
              <td> ".$row['periodedebut'] ." </td>
              <td> ".$row['periodefin'] ." </td>
              <td><a class='btn btn-danger'  href='PageCycle.php?action=3 &numero=".$row['numero']. "'>Supprimer</a> </td>
              <td><a type='button' class='btn btn-primary' href='PageCycle.php?action=2 &numero=".$row['numero']. "'>Modifier</a></td>
          
          </tr>
          </tbody>";
           }
        echo"  </table>";
    
         echo"<div>"; }}


function insertEtu()
{
  $conn = OpenBase();
  if (!$conn) {
    die ("erreur:".mysqli_connect_error());

 $numero=$_GET["n"];
 $entreprise=$_GET["e"];
 $gouvernorat=$_GET["g"];
 $lieuderoulement=$_GET["ld"];
 $numerosalle=$_GET["ns"];
 $themeformation=$_GET["tf"];
 $periodedebut=$_GET["pd"];
 $periodefin=$_GET["pf"];
$sql = "INSERT INTO cycle (numero,entreprise,gouvernorat,lieuderoulement,numerosalle,themeformation,periodedebut,periodefin)
VALUES ('$numero','$entreprise','$gouvernorat','$lieuderoulement','$numerosalle','$themeformation','$periodedebut','$periodefin')";

if (!mysqli_query($conn,$sql)) {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);}
else
{ header('location:PageCycle.php');};
}
else {
echo"
    <div id='div2'>
    
    <div class='container d-flex justify-content-center'>
        <form class='ajout' name='f' method='GET' action='AjoutCycle.php'  enctype='multipart/form-data' style ='width:50vw;min-width:350px'>
           Numero <input name='n' class='form-control' type='text'><br>
            Entreprise <input name='e' class='form-control' type='text'><br>
            Gouvernorat  <input name='g' class='form-control' type='text'><br>
            LieuDéroulement <input name='ld' class='form-control' type='text'><br>
            NumSalle <input name='ns' class='form-control' type='text'><br>
            ThemeFormation <input name='tf' class='form-control' type='text'><br>
            PeriodeDebut <input name='pd' class='form-control' type='date'><br>
            PeriodeFin <input name='pf' class='form-control' type='date'><br>
           
            <input type='submit' value ='Ajouter Cycle' class='btn btn-primary'><br>
           
        </form>
        </div>
        </div>
    </body>
    </html>";
}
mysqli_close($conn);}



function updateEtu()
{
    if (!isset($_GET['numero'])) {
        echo "Error: 'numero' parameter is not set.";
        return;
    }

    $conn = OpenBase();
    $numero = $_GET['numero'];

    $req = mysqli_query($conn, "SELECT * FROM cycle where numero='$numero'");
    $row = mysqli_fetch_assoc($req);

    if (isset($_POST['submit'])) {
        $numero = mysqli_real_escape_string($conn, $_POST["n"]);
        $entreprise = mysqli_real_escape_string($conn, $_POST["e"]);
        $gouvernorat = mysqli_real_escape_string($conn, $_POST["g"]);
        $lieuderoulement = mysqli_real_escape_string($conn, $_POST["ld"]);
        $numerosalle = mysqli_real_escape_string($conn, $_POST["ns"]);
        $themeformation = mysqli_real_escape_string($conn, $_POST["tf"]);
        $periodedebut = mysqli_real_escape_string($conn, $_POST["pd"]);
        $periodefin = mysqli_real_escape_string($conn, $_POST["pf"]);

        if ($numero && $entreprise && $gouvernorat && $lieuderoulement && $numerosalle && $themeformation && $periodedebut && $periodefin) {
            $sql = "UPDATE cycle SET 
                numero='$numero', 
                entreprise='$entreprise',
                gouvernorat='$gouvernorat',
                lieuderoulement='$lieuderoulement',
                numerosalle='$numerosalle',
                themeformation='$themeformation',
                periodedebut='$periodedebut',
                periodefin='$periodefin' 
                WHERE numero='" . $row['numero'] . "'";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                header('location: PageCycle.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {

        echo "<div class='container d-flex justify-content-center'>";
        echo "<form class='update' name='f' method='POST' action='' style='width:50vw;min-width:350px' >";
        echo " Numero  <input class='form-control' name='n' type='text' value=" . $row['numero'] . " >";
        echo " <br>Entreprise  <input class='form-control' name='e' type='text' value=" . $row['entreprise'] . " >";
        echo "<br> Gouvernorat  <input class='form-control' name='g' type='text' value=" . $row['gouvernorat'] . ">";
        echo " <br> LieuDeroulement <input class='form-control' name='ld' type='text' value=" . $row['lieuderoulement'] . ">";
        echo "<br> NumeroSalle <input class='form-control' name='ns' type='text' value=" . $row['numerosalle'] . ">";
        echo "<br> ThemeFormation <input class='form-control' name='tf' type='text' value=" . $row['themeformation'] . ">";
        echo "<br> PeriodeDebut <input class='form-control' name='pd' type='date' value=" . $row['periodedebut'] . ">";
        echo "<br> PeriodeFin <input class='form-control' name='pf' type='date' value=" . $row['periodefin'] . ">";

        echo " <br> <input type='submit' name='submit' value ='Modifier' class='btn btn-primary' >";
        echo "</form>";
    }
    mysqli_close($conn);
}


     
        
function DeleteEtu()

{$UserId = isset($_GET['numero'])?$_GET['numero']:'';

  $Sql = "DELETE FROM cycle WHERE numero='$UserId'";
  $DBase = OpenBase();
$Res =mysqli_query($DBase, $Sql);}
       
?>
</body>
</html>

