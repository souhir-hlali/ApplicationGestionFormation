<?php
session_start();

?>

<!DOCTYPE html>
<html>


   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Interface Participant</title>
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


default:
return ('erreur dans la base');

}



function AfficherInterface()
{  
        echo"<div class='text-center mb-7'><h2> Liste Des Participants </h2></div>";
    echo" <form name='f' method='GET' action=''  >"
;
    
     $sql = "SELECT * FROM participant ";
     $result = mysqli_query(OpenBase(), $sql);
      if($result){
  
        
    echo"
     <table class='table table-bordered'>
     <thead>
          <tr>
              <td > Cin </td>
              <td > Nom </td>
              <td > Prénom </td>
              <td> Entreprise </td>
              <td> Direction</td>
              <td>Telephone</td>
              <td>E-mail</td>
              <td>Théme de formation</td>
          </tr>
          </thead>";
           while($row=mysqli_fetch_assoc($result)) { 
            echo" <tbody>
            <tr>
              <td > ".$row['cin']. "</td>
              <td>".$row['nom'] ."</td>
              <td>".$row['prenom'] ."</td>
              <td> ".$row['entreprise'] ."</td>
              <td>". $row['direction'] ." </td>
              <td> ".$row['telephone'] ." </td>
              <td> ".$row['email'] ." </td>
              <td> ".$row['themeformation'] ." </td>
          </tr>
          </tbody>";
           }
        echo"  </table>";
    
          }}



 
?>
</body>
</html>

