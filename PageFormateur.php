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
       <a href="PageParticipant.php">Liste de Participant</a>
        
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
{  
    echo" <form name='f' method='GET' action=''  >
    <a type='button' class='btn btn-primary' href='PageFormateur.php?action=1 '>Ajouter Nouvelle Formateur</a> ";
    
     $sql = "SELECT * FROM formateur ";
     $result = mysqli_query(OpenBase(), $sql);
      if($result){
  
        
    echo"
     <table class='table table-bordered'>
     <thead>
          <tr>
              <td > Cin </td>
              <td > Nom_prénom </td>
              <td> Specialité </td>
              <td> Direction</td>
              <td>Telephone</td>
              <td colspan='2'>Action </td>
          </tr>
          </thead>";
           while($row=mysqli_fetch_assoc($result)) { 
            echo" <tbody>
            <tr>
              <td > ".$row['cin']. "</td>
              <td>".$row['nom_prenom'] ."</td>
              <td> ".$row['specialite'] ."</td>
              <td>". $row['direction'] ." </td>
              <td> ".$row['telephone'] ." </td>
              <td><a class='btn btn-danger'  href='PageFormateur.php?action=3 &cin=".$row['cin']. "'>Supprimer</a> </td>
              <td><a type='button' class='btn btn-primary' href='PageFormateur.php?action=2 &cin=".$row['cin']. "'>Modifier</a></td>
          
          </tr>
          </tbody>";
           }
        echo"  </table>";
    
          }}

          function insertEtu()
          {
              $conn = OpenBase();
              
              if (!$conn) {
                  die("erreur:" . mysqli_connect_error());
              }
              
              if (isset($_GET["c"])) {
                  $cin = mysqli_real_escape_string($conn, $_GET["c"]);
                  $nom_prenom = mysqli_real_escape_string($conn, $_GET["np"]);
                  $specialite = mysqli_real_escape_string($conn, $_GET["s"]);
                  $direction = mysqli_real_escape_string($conn, $_GET["d"]);
                  $telephone = mysqli_real_escape_string($conn, $_GET["t"]);
                  
                  $sql = "INSERT INTO formateur (cin, nom_prenom, specialite, direction, telephone)
                          VALUES ('$cin', '$nom_prenom', '$specialite', '$direction', '$telephone')";
                  
                  if (!mysqli_query($conn, $sql)) {
                      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  } else {
                      header('location:PageFormateur.php');
                  }
              } else {
                  echo "
                      <div id='div2'>
                          <div class='text-center mb-4'></div>
                          <div class='container d-flex justify-content-center'>
                              <form class='ajout' name='f' method='GET' action='AjoutFormateur.php'  enctype='multipart/form-data' style ='width:50vw;min-width:350px'>
                                  Cin <input name='c' class='form-control' type='text'><br>
                                  Nom_prenom <input name='np' class='form-control' type='text'><br>
                                  Specialite  <input name='s' class='form-control' type='text'><br>
                                  Direction <input name='d' class='form-control' type='text'><br>
                                  Telephone <input name='t' class='form-control' type='text'><br>
                                  <input type='submit' value ='Ajouter Formateur' class='btn btn-primary'><br>
                              </form>
                          </div>
                      </div>
                  </body>
                  </html>";
              }
              
              mysqli_close($conn);
          }
          
          

function updateEtu()
{
    if (!isset($_GET['cin'])) {
        echo "Error: 'cin' parameter is not set.";
        return;
    }
    
    $conn = OpenBase();
    $cin = $_GET['cin'];
    
    $req = mysqli_query($conn, "SELECT * FROM formateur where cin='$cin'");
    $row = mysqli_fetch_assoc($req);
    
    if (isset($_POST['submit'])) {
        $cin = mysqli_real_escape_string($conn, $_POST["c"]);
        $nom_prenom = mysqli_real_escape_string($conn, $_POST["np"]);
        $specialite = mysqli_real_escape_string($conn, $_POST["s"]);
        $direction = mysqli_real_escape_string($conn, $_POST["d"]);
        $telephone = mysqli_real_escape_string($conn, $_POST["t"]);
        
        if ($cin && $nom_prenom && $specialite && $direction && $telephone) {
            $sql = "UPDATE formateur 
                SET cin='$cin', nom_prenom='$nom_prenom', specialite='$specialite', direction='$direction', telephone='$telephone' 
                WHERE cin='" . $row['cin'] . "'";
            
            $res = mysqli_query($conn, $sql);
            
            if ($res) {
                header('location: PageFormateur.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        echo "<div class='container d-flex justify-content-center'>";
        echo "<form class='update' name='f' method='POST' action='' style='width:50vw;min-width:350px' >";
        echo " Cin  <input class='form-control' name='c' type='text' value=" . $row['cin'] . " >";
        echo " <br>Nom_prenom  <input class='form-control' name='np' type='text' value=" . $row['nom_prenom'] . " >";
        echo "<br> Specialité  <input class='form-control' name='s' type='text' value=" . $row['specialite'] . ">";
        echo " <br> Direction <input class='form-control' name='d' type='text' value=" . $row['direction'] . ">";
        echo "<br> Telephone <input class='form-control' name='t' type='text' value=" . $row['telephone'] . ">";
        echo " <br> <input type='submit' name='submit' value ='Modifier' class='btn btn-primary' >";
        echo "</form>";
    }
    
    mysqli_close($conn);
}



     
        
function DeleteEtu()

{$UserId = isset($_GET['cin'])?$_GET['cin']:'';

  $Sql = "DELETE FROM formateur WHERE cin='$UserId'";
  $DBase = OpenBase();
$Res =mysqli_query($DBase, $Sql);}
       
?>
</body>
</html>

