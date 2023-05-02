<?php
// 获取MySQL数据库连接信息
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// 创建MySQL数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查MySQL数据库连接是否成功
if ($conn->connect_error) {
    $error = array("code" => "500", "data" => "连接数据库失败: " . $conn->connect_error);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit();
}


    // 插入数据
    $sql1 = "DELETE FROM `MinecraftPlayer` WHERE `End_at` < NOW()";
    if ($conn->query($sql1) === TRUE) {
        $response = array("code" => "200", "data" => "ok");
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $error = array("code" => "500", "data" => "reason" . $conn->error);
        echo json_encode($error,JSON_UNESCAPED_UNICODE);
        exit();
    }



// 关闭MySQL数据库连接
$conn->close();

?>