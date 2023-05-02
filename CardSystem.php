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

if (isset($_GET["Card"]) && isset($_GET["mode"])) {
    $kami = $_GET["Card"];
    $mode = $_GET["mode"];
    
    if ($mode == "add") {
        $sql = "INSERT INTO `Card`(`Card`) VALUES ('$kami')";
            if ($conn->query($sql) === TRUE) {
            $response = array("code" => "200", "data" => "已添加卡密{$kami},默认状态未使用");
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            exit();
            } else {
            $error = array("code" => "500", "data" => "添加失败!请联系管理" . $conn->error);
            echo json_encode($error,JSON_UNESCAPED_UNICODE);
            exit();
            }
    } elseif ($mode == "check") {
        $query = "SELECT `Used` FROM `Card` WHERE `Card` = '$kami';";
        $result = $conn->query($query);
        // 检查查询是否成功
        if (!$result) {
            echo "查询失败：" . $conn->error;
            exit();
            }

        // 将查询结果转换为 JSON 格式
        $row = $result->fetch_assoc();
        $json = json_encode($row);

        // 输出 JSON 格式的结果
        echo $json;
    } elseif ($mode == "change") {
        $origin = $_GET["used"];
        $change = $origin ? 1 : 0;
        $sql = "UPDATE `Card` SET `Used` = $change WHERE `Card` = '$kami';";
            if ($conn->query($sql) === TRUE) {
            $response = array("code" => "200", "data" => "已将卡密{$kami}的使用状态改为{$change}");
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            exit();
            } else {
            $error = array("code" => "500", "data" => "修改失败!请联系管理" . $conn->error);
            echo json_encode($error,JSON_UNESCAPED_UNICODE);
            exit();
            }
    } else {
        $error = array("code" => "500", "data" => "未知模式!请联系管理" . $conn->error);
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