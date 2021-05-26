<?php

require '../apis/connect.php';
require '../apis/classList.php';

session_start();

$y = date('y');
$m = date('m');
$d = date('d');
$datetime = $y."-".$m."-".$d;

$id = $_SESSION['id'];
$post = $_POST['date']; // date - classNumber

$date = explode("-", $post)[0];
$classNumber = explode("-", $post)[1];


//用seesion id對應老師的本名
$sql = "SELECT id, name FROM account WHERE id = ".$id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user == false){

    echo "Error";

}else{

    $name = $user["name"];
    //用本名去對應 該老師的科目
    $sql_teachers = "SELECT teacher_name, subject FROM teacher WHERE teacher_name = ".$name;
    $stmt = $pdo->prepare($sql_teachers);
    $stmt->execute();
    $theTeacher = $stmt->fetch(PDO::FETCH_ASSOC);
    $subject = $theTeacher["subject"]; //老師的科目名稱


    $subjectName = Contrast[classList[$classNumber]]; //找到課堂編號對應的科目名稱

    if($subject == $subjectName){ //找到

        /* 後處理 */
        $sql_get = "SELECT * FROM account WHERE permission = 2"; // permission = 1 為老師
        $stmt = $pdo->prepare($sql_get);
        $stmt->execute();
    
        $students = $stmt->fetch(PDO::FETCH_ASSOC); //獲取所有帳號

        //account (id, username, password, name, permission)
        //class_check_io (class, date, check_in, check_out, id)

        foreach($students as $stu){ //將學生做個別處裡

            //用id,課堂編號,日期對應出該節課的簽到紀錄
            $sql_c = "SELECT * FROM class_check_io WHERE class = :classNumber AND date = :date AND id = :username";
            $stmt = $pdo->prepare($sql_c);
            $stmt->bindValue(':classNumber', $classNumber);
            $stmt->bindValue(':date', $date);
            $stmt->bindValue(':username', $stu['id']);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user == false){ //有人沒簽到

                $sql_push = 'INSERT INTO class_check_io (class, date, check_in, check_out, id) VALUE (:classNumber, :date, 0, 0, :username)';
                $stmt = $pdo->prepare($sql_push);
                $stmt->bindValue(':classNumber', $classNumber);
                $stmt->bindValue(':date', $date);
                $stmt->bindValue(':username', $stu['id']);
                $stmt->execute();

            }
        }

        /* ----- */

        //開始抓取資料 以日期和課堂編號作對應
        $sql_allStudent = "SELECT * FROM class_check_io ORDER BY id WHERE class = :classNumber AND date = :date";
        $stmt = $pdo->prepare($sql_allStudent);

        $stmt->bindValue(':classNumber', $classNumber);
        $stmt->bindValue(':date', $date);

        $stmt->execute();

        $students = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $students;// 全部學生資料

    }else{
        header('.\index.php');
    }

}




?>
