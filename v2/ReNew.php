<?php

// 连接数据库
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检查连接是否成功
if (mysqli_connect_errno()) {
    $error = array("code" => "500", "data" => "连接数据库失败: " . mysqli_connect_error());
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit();
}

// 判断参数是否存在
if (isset($_GET["id"]) && isset($_GET["days"])) {
    // 获取要更新的行的ID和天数
    $id = $_GET["id"];
    $days = $_GET["days"];

    // 更新日期
    $sql = "UPDATE MinecraftPlayer SET End_at = DATE_ADD(End_at, INTERVAL " . $days . " DAY) WHERE PlayerName = '{$id}'";
    if ($conn->query($sql) === TRUE) {
        // 获取续费之后的过期时间
        $sql1 = "SELECT End_at FROM MinecraftPlayer WHERE PlayerName = '{$id}'";
        $result = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_assoc($result);
        $end_at = $row['End_at'];
        $response = array("code" => "200", "data" => "续费成功,您的过期时间为: '{$end_at}'");
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $error = array("code" => "500", "data" => "续费失败!请联系管理" . $conn->error);
        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        exit();
    }
} else {
    $error = array("code" => "400", "data" => "必填参数缺失");
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit();
}

// 关闭数据库连接
mysqli_close($conn);

?>
