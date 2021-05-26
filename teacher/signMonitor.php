<?php

require '../apis/connect.php';
require '../apis/classList.php';

session_start();
$ERRMSG = "";
$pdo->query("SET NAMES UTF8");
if(!isset($_SESSION['id'])){
    // logincheck
    header('Location: ../login/index.php');
    exit;
}else{
    $sql = "SELECT * FROM account WHERE id = '". $_SESSION['id'] ."'";
    foreach ($pdo->query($sql) as $row) {
        $account = $row['username'];
        $name = $row['name'];
        $permission = $row['permission'];
    }
}

$id = $_SESSION['id'];

$classIndex = array();
$index = array();
$dates = array();


/* 用session id從account中對比name */
$sql = "SELECT id, name FROM account WHERE id = ".$id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user == false){

    echo "Error"; //未知錯誤

}else{

    //從teacher table中找到該老師的subject
    $name = $user["name"];
    $sql_teachers = "SELECT teacher_name, subject FROM teacher WHERE teacher_name = :name";
    $stmt = $pdo->prepare($sql_teachers);
    $stmt->bindValue(":name",$name);
    $stmt->execute();
    $theTeacher = $stmt->fetch(PDO::FETCH_ASSOC);
    $subject = $theTeacher["subject"];

    //利用找到的subject 從課表中找尋classIndex(課堂編號1~40)
    foreach(classList as $key=>$value){

        if($subject == Contrast[$value]){

            array_push($classIndex, $key); // 把課堂編號存進$classIndex

        }

    }
}
foreach($classIndex as $classNumber){
    $sql_class = "SELECT * FROM class_check_io WHERE class = :class";
    $stmt = $pdo->prepare($sql_class);
    $stmt->bindValue(":class",$classNumber);
    $stmt->execute();
    $resultInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $combine = [];
    foreach($resultInfo as $row){
        array_push($combine,$row['date']."-".$row['class']);
    }
    $combine = array_unique($combine);
    foreach($combine as $rst){
        echo $rst; 
    }
}
?>
