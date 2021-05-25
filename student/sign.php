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


    if($w == 0 OR $w == 6){

        echo "假日你上三小課= =?";

    }else{

        while($k<9){
            if($h == classInTimeHour[(String)$k] AND $h <= classOutTimeHour[(String)$k]){
                if((int)((int)$k/5)){
                    if((int)$min >= 10 AND (int)$min <= 60){
                        echo $k;
						break;
                    }else if((int)$min >= 0 AND (int)$min <= 50){
						echo $k;
						break;
					}else{
						echo "下課時間";
						$k = -1;
						break;
					}
                }
            }
			$k++;
        }
		
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
            $sql = "INSERT INTO class_check_io (class, date, check_in, check_out, id) VALUES (".$k.", ".$date.",1 ,0, )";
        }
    }



?>