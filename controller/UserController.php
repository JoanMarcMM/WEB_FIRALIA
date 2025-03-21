<?php
session_start();


function login(){

    $is_invalid = false;
    
    if ($_SERVER['REQUEST_METHOD']=== "POST"){
    
        $mysqli = require __DIR__."/../controller/database.php";
    
        //Creo la query
    
        $sql = sprintf("SELECT * FROM users 
                WHERE user = '%s'",
                $mysqli->real_escape_string($_POST["user"]));
    
        //Ejecuto la query
    
        $result = $mysqli->query($sql);
    
        $user = $result->fetch_assoc();
    
        if($user){
        
            if(password_verify($_POST["password"],$user["PASSWORD"])){
                
                session_start();
    
                $_SESSION["user_id"] = $user["ID"];
    
                header("Location: index.php");
                exit();
                
    
            }
        
        }
    
        $is_valid = true;
    }


}

function logout(){

    }

    function register(){

        }
?>