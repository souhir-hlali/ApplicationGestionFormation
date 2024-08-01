<?php
function OpenBase()
{
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $nomBS ="appstage";
    
    
    $conn = mysqli_connect($servername, $username, $password,$nomBS);
        if (!$conn) {
            die ("erreur:".mysqli_connect_error());
        }
        return $conn;
}

?>