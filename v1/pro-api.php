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

// 检查POST请求中的参数是否存在
//if (isset($_POST["ign"]) && isset($_POST["starttime"]) && isset($_POST["endtime"]) && isset($_POST["key"])) {
if (isset($_GET["ign"]) && isset($_GET["add"])&&isset($_GET['key'])&&isset($_GET['qq'])) {
    // 获取POST请求参数
    $qq=$_GET['qq'];
    $playerName = $_GET["ign"];
    $create_at = date("Y-m-d H:i:s", time());
    $daysToAdd = intval($_GET["add"]); // Convert the value to an integer
    $key = $_GET['key'];
    if ($daysToAdd >= 0) {
        $end_at = date("Y-m-d H:i:s", strtotime("+" . $daysToAdd . " days"));
        // Call SQL statement for positive days to add
        // Example:
        // $sql = "INSERT INTO your_table_name (player_name, create_at, end_at) VALUES ('$playerName', '$create_at', '$end_at')";
    } else {
        $end_at = date("Y-m-d H:i:s", strtotime($daysToAdd . " days"));
        // Call SQL statement for negative days to add
        // Example:
        // $sql = "UPDATE your_table_name SET end_at = '$end_at' WHERE player_name = '$playerName'";
    }   

    // 检查key是否正确
    $current_date_hour = date("Y-m-d H");
    $pinjie = $current_date_hour.$_GET["ign"].$_GET["add"];
    $generated_key = md5($pinjie);
    if ($key != $generated_key) {
        $error = array("code" => "401", "data" => "无效的key");
        echo json_encode($error,JSON_UNESCAPED_UNICODE);
        exit();
    }


    // 插入数据
    $sql1 = "DELETE FROM `MinecraftPlayer` WHERE `End_at` < NOW()";
    $sql2 = "INSERT INTO MinecraftPlayer (PlayerName, Create_at, End_at, UserQQ) VALUES ('$playerName', '$create_at', '$end_at','$qq')";
    if ($conn->query($sql2) === TRUE && $conn->query($sql1) === TRUE) {
        $response = array("code" => "200", "data" => "已添加,过期时间$end_at");
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $error = array("code" => "500", "data" => "添加失败!请联系管理" . $conn->error);
        echo json_encode($error,JSON_UNESCAPED_UNICODE);
        exit();
    }
} else {
    $error = array("code" => "400", "data" => "必填参数缺失");
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit();
}

// 关闭MySQL数据库连接
$conn->close();

?>