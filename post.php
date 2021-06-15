<?php

$s_name = "localhost";
$db_name = "final_test";
$db_pw = "123";
$db_name = "final_test";

function create_succ(){
    echo "<script>alert('註冊成功!!')</script>";
}
function create_no_succ(){
    echo "<script>alert('已存在賬號!!')</script>";
}
function reload_page(){
    header("refresh:0.1 ; url = index.html");
}

try{

    $conn = new PDO("mysql:host=$s_name;dbname=$db_name", $db_name,$db_pw);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $conn->query("SELECT * FROM `final_test` WHERE name='".$_POST['iname']."'");

    if(!empty($result)){ // if input name not exsist in db
        
        $sql = "INSERT INTO `final_test` (name) VALUES ('".$_POST['iname']."')";
        $conn->exec($sql);

        switch($_POST['selected']){ // value man / girl;
            case "man":
                $sql = "UPDATE `final_test` SET sex='man' WHERE name='".$_POST['iname']."'";
                $conn->exec($sql);
                break;

            case "girl":
                $sql = "UPDATE `final_test` SET sex='girl' WHERE name='".$_POST['iname']."'";
                $conn->exec($sql);
                break;
        }
        create_succ();
        reload_page();
    }else{
        create_no_succ();
        reload_page();
    }
}catch(PDOException $e){
    echo $result ."<br>". $e->getMessage();
}


?>
