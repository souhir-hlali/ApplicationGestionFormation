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
   
 
</style>
<link rel="stylesheet" href="indexParticipant.css">
    </head>
   <body>
     
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>   </body>

<?php
include("adminBase.php");

$Action=isset($_GET['action'])?$_GET['action']:'1';


switch($Action){

case 1: 
        insertEtu();
       
        break;

default:
return ('erreur dans la base');

}




function insertEtu()
{
echo"
    <div id='div2'>
    <div class='text-center mb-4'></div>
    <div class='container d-flex justify-content-center'>
        <form name='f' method='GET' action='AjoutParticipant.php'  enctype='multipart/form-data' style ='width:50vw;min-width:350px'>
        Cin <input name='c' class='form-control' type='text'><br>
            Nom <input name='n' class='form-control' type='text'><br>
            Prenom <input name='p' class='form-control' type='text'><br>
            Entreprise  <input name='e' class='form-control' type='text'><br>
            Direction <input name='d' class='form-control' type='text'><br>
            Telephone <input name='t' class='form-control' type='text'><br>
            E-mail <input name='m' class='form-control' type='text'><br>
            Theme de formation <input name='tf' class='form-control' type='text'><br>
            <input type='submit' value ='Inscrire' class='btn btn-primary'>
            
           
        </form>
        </div>
        </div>
    </body>
    </html>";
}

 
?>
</body>
</html>

