<?php

require '../apis/connect.php';
require '../apis/classList.php';

session_start();
session_destroy();

$id = $_SESSION['id'];
$post = $_POST['li'];


$sql = "SELECT id, name FROM account WHERE id = ".$id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user == false){

    echo "Error";

}else{

    $name = $user["name"];
    $sql_teachers = "SELECT teacher_name, subject FROM teacher WHERE teacher_name = ".$name;
    $stmt = $pdo->prepare($sql_teachers);
    $stmt->execute();
    $theTeacher = $stmt->fetch(PDO::FETCH_ASSOC);
    $subject = $theTeacher["subject"];

    $subjectName = Contrast[classList[]];

    if($subject == $subjectName){

        $classNumber = $k+((int)$w-1)*8;

        /* 後處理 */
        $sql_get = "SELECT * FROM account";
        $stmt = $pdo->prepare($sql_get);
        $stmt->execute(); // run
    
        $students = $stmt->fetch(PDO::FETCH_ASSOC);

        //account (id, username, password, name, permission)
        //class_check_io (class, date, check_in, check_out, id)

        foreach($students as $stu){

            $sql_c = "SELECT * FROM class_check_io WHERE class = :classNumber AND date = :date AND id = :username";
            $stmt = $pdo->prepare($sql_c);
            $stmt->bindValue(':classNumber', $classNumber);
            $stmt->bindValue(':date', $date);
            $stmt->bindValue(':username', $stu['id']);
            $stmt->execute(); // run

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user == false){

                $sql_push = 'INSERT INTO class_check_io (class, date, id) VALUE (:classNumber, :date, :username)';
                $stmt = $pdo->prepare($sql_push);
                $stmt->bindValue(':classNumber', $classNumber);
                $stmt->bindValue(':date', $date);
                $stmt->bindValue(':username', $stu['id']);
                $stmt->execute(); // run

            }
        }

        /* ----- */

        $sql_allStudent = "SELECT * FROM class_check_io ORDER BY id WHERE class = :classNumber AND date = :date";
        $stmt = $pdo->prepare($sql_allStudent);

        $stmt->bindValue(':classNumber', );
        $stmt->bindValue(':date', );

        $stmt->execute();

        $students = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $students;

    }else{
        header('.\index.php');
    }

}




?>