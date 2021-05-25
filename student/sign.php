<?php

date_default_timezone_set('Asia/Taipei');

require '../apis/connect.php';
require '../apis/class_time.php';

session_start();
session_destroy();

$y = date('y');
$m = date('m');
$d = date('d');
$date = $y.$m.$d;

$w = date('w');

$h = date('G');
$min = date('i');

$k = 1;

if(isset($_POST['SIGNIN'])){

    if($w == 0 OR $w == 6){

        echo "假日你上三小課= =?";

    }else{

        while($k<9){
            if($h == classInTimeHour[(String)$k] AND $h <= classOutTimeHour[(String)$k]){
                if((int)($k/5)){
                    if((int)$min >= 10 AND (int)$min <= 60){
                        echo $k;
                        break;
                    }else if((int)$min >= 0 AND (int)$min <= 50){
                        echo $k;
                        break;
                    }else{
                        $k = -1;
                        echo "下課時間";
                        break;
                    }
                }
            }
            $k ++;
        }
        if($k == -1){

            echo "下課時間不能簽到呦^w^";

        }else{

            $id = $_SESSION['id'];

            $searchStuNameSQL = "SELECT * FROM account WHERE id = ".$id;
            $stmt = $pdo->prepare($searchStuNameSQL);
            $stmt->execute(); // run
    
            $accDetail = $stmt->fetch(PDO::FETCH_ASSOC);
            $username = $accDetail['username'];
    
    
            $classNumber = $k+((int)$w-1)*8;
    
            $sql_get = "SELECT * FROM class_check_io WHERE date = ".$date." AND class = ".$classNumber."id = ".$username;
            $stmt = $pdo->prepare($sql_get);
            $stmt->execute(); // run
    
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user == false){

                //class_check_io (class, date, check_in, check_out, id)
                $sql_push = "INSERT INTO class_check_io (class, date, check_in, id) VALUES (:classNumber, :date, 1 , :username)";
                $stmt = $pdo->prepare($sql_push);
                $stmt->bindValue(':classNumber', $classNumber);
                $stmt->bindValue(':date', $date);
                $stmt->bindValue(':username', $username);
                $stmt->execute(); // run

            }else{
                $sql_push = "INSERT INTO class_check_io (check_in) VALUES (1)";
                $stmt = $pdo->prepare($sql_push);
                $stmt->execute(); // run
            }
            echo "簽到成功! 你獲得了經驗值 0 點.";

        }

    }

}



?>
