<?php

require '../apis/connect.php';
require '../apis/classList.php';

session_start();
session_destroy();

$id = $_SESSION['id'];
$post = $_POST['li'];

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
    $sql_teachers = "SELECT teacher_name, subject FROM teacher WHERE teacher_name = ".$name;
    $stmt = $pdo->prepare($sql_teachers);
    $stmt->execute();
    $theTeacher = $stmt->fetch(PDO::FETCH_ASSOC);
    $subject = $theTeacher["subject"];

    //利用找到的subject 從課表中找尋classIndex(課堂編號1~40)
    foreach(classList as $key=>$value){

        if($subject == Contrast[$value]){

            array_push($classIndex, $key); // 把課堂編號存進$classIndex

        }

    }

    //有了課堂編號 利用課堂編號尋找日期
    foreach($classIndex as $classNumber){

        $sql_class = "SELECT date FROM class_check_io ORDER BY date WHERE class = ".$classNumber;
        $stmt = $pdo->prepare($sql_class);
        $stmt->execute();

        $index = $stmt->fetch(PDO::FETCH_ASSOC);
        $ds = $index['date']; //一個充滿重複日期的陣列
        $ds = array_unique($dates); // 清除重複內容

        foreach($ds as $d){ // 將ds切分 分別裝入$dates
            if(in_array($d, $dates)){ // 是否已經裝過了?
                array_push($dates, $d);
            }
        }
    }
    echo $dates;

}


?>