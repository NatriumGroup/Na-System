<?php
// 获取MySQL数据库连接信息
$servername = "localhost";
$username = "gongyi";
$password = "";
$dbname = "gongyi";

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
if (isset($_GET["ign"])  && isset($_GET["qq"])) {
    // 获取POST请求参数
    $playerName = $_GET["ign"];
    $create_at = date("Y-m-d H:i:s", "1680660696");
    $end_at = date("Y-m-d H:i:s", "1712283085");
    $qq = $_GET["qq"];

    // 检查key是否正确
    //$current_date_hour = date("Y-m-d H");
    //$generated_key = md5($current_date_hour);
    //if ($key != $generated_key) {
        //$error = array("code" => "401", "data" => "无效的key");
        //echo json_encode($error,JSON_UNESCAPED_UNICODE);
        //exit();
    

    // 插入数据
    $sql1 = "DELETE FROM `minecraftplayer` WHERE `UserQQ` = $qq";
    $sql = "INSERT INTO minecraftplayer (PlayerName, Create_at, End_at, UserQQ) VALUES ('$playerName', '$create_at', '$end_at', '$qq')";
    if ($conn->query($sql1) === TRUE && $conn->query($sql) === TRUE) {
        $response = array("code" => "200", "msg" => "添加白名单成功!", "Player" => "{$playerName}");
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $error = array("code" => "500", "data" => "插入数据失败: " . $conn->error);
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