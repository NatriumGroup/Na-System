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
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit();
}

// 检查GET请求中的参数是否存在
if (!isset($_GET["qq"])) {
    $error = array("code" => "400", "data" => "必填参数缺失");
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit();
}

// 获取GET请求参数
$QQ = $_GET["qq"];
$param = $conn->real_escape_string($_GET["qq"]); // 使用$conn替换原先的$mysqli，防止 SQL 注入攻击

// 执行 SQL 查询
$sql = "SELECT * FROM MinecraftPlayer WHERE UserQQ = '$param'";
$result = $conn->query($sql);

// 检查查询结果是否存在数据
if (!($result->num_rows > 0)) {
    $noinfo = array("code" => "500", "data" => "您的QQ未绑定加速IP服务");
    echo json_encode($noinfo, JSON_UNESCAPED_UNICODE);
    exit();
} else {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }

        $success = array("code" => "200", "data" => "已在数据库中查询到您的加速IP信息，IP将以邮件形式发送至您的QQ邮箱");
        echo json_encode($success, JSON_UNESCAPED_UNICODE);

}

$conn->close();
?>