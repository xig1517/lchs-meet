<?php
session_start();
require '../apis/connect.php';
$pdo->query('set names utf8;');
if(isset($_POST['register'])){
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
	$name = !empty($_POST['name']) ? trim($_POST['name']) : null;
	$perm = !empty($_POST['permission']) ? trim($_POST['permission']) : null;
    $sql = "SELECT COUNT(username) AS num FROM account WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['num'] > 0){
        die('此使用者名稱已存在');
	}
    
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    $sql = "INSERT INTO account (username, password, name ,permission) VALUES (:username, :password, :name, :perm )";
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);
	$stmt->bindValue(':perm', $perm);
	$stmt->bindValue(':name', $name);
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
        echo '註冊成功.';
    }
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <h1>Register</h1>
        <form action="#" method="post" id="rgs">
            <label for="username">帳號</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">密碼</label>
            <input type="password" id="password" name="password"><br>
			<label for="name">本名</label>
            <input type="text" id="name" name="name"><br>
			<input type="radio" for="permission" name="permission" value="0">管理員<br>
			<input type="radio" for="permission" name="permission" value="1">老師<br>
			<input type="radio" for="permission" name="permission" value="2" checked>學生<br>
            <input type="submit" name="register" value="register"></button>
        </form>
    </body>
</html>
