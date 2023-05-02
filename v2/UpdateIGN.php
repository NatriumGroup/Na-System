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
if (isset($_GET["o_id"])&&isset($_GET['n_id'])) {
    // 获取要更新的行的ID和天数
    $o_id = $_GET["o_id"];
    $n_id = $_GET["n_id"];

    // 更新日期
    $sql = "UPDATE MinecraftPlayer SET PlayerName='$n_id' WHERE PlayerName='{$o_id}';";
    if ($conn->query($sql) === TRUE) {
        // 获取续费之后的过期时间
        $response = array("code" => "200", "data" => "更改ID成功,更改后的ID为: '{$n_id}'");
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $error = array("code" => "500", "data" => "更改ID失败!请联系管理" . $conn->error);
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
