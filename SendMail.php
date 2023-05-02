 <?php
if (!isset($_GET["mailto"])) {
    $error = array("code" => "400", "data" => "必填参数缺失");
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit();
}
$mailto = $_GET["mailto"];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //服务器配置
    $mail->CharSet ="UTF-8";                     //设定邮件编码
    $mail->SMTPDebug = 0;                        // 调试模式输出
    $mail->isSMTP();                             // 使用SMTP
    $mail->Host = '';                // SMTP服务器
    $mail->SMTPAuth = true;                      // 允许 SMTP 认证
    $mail->Username = '';                // SMTP 用户名  即邮箱的用户名
    $mail->Password = '';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
    $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
    $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

    $mail->setFrom('natrium_store@internet.ru', 'NaBoost');  //发件人
    $mail->addAddress("$mailto", 'NaBoost User');  // 收件人
    //Content
    $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
    $mail->Subject = 'NaBoost - 加速IP地址';
    $mail->Body    = '
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <meta charset="utf-8" />

</head>
<body>
    <div class="qmbox qm_con_body_content qqmail_webmail_only" id="mailContentContainer" style="">
        <style type="text/css">
            .qmbox body {
                margin: 0;
                padding: 0;
                background: #fff;
                font-family: "Verdana, Arial, Helvetica, sans-serif";
                font-size: 14px;
                line-height: 24px;
            }

            .qmbox div, .qmbox p, .qmbox span, .qmbox img {
                margin: 0;
                padding: 0;
            }

            .qmbox img {
                border: none;
            }

            .qmbox .contaner {
                margin: 0 auto;
            }

            .qmbox .title {
                margin: 0 auto;
                background: url() #CCC repeat-x;
                height: 30px;
                text-align: center;
                font-weight: bold;
                padding-top: 12px;
                font-size: 16px;
            }

            .qmbox .content {
                margin: 4px;
            }

            .qmbox .biaoti {
                padding: 6px;
                color: #000;
            }

            .qmbox .xtop, .qmbox .xbottom {
                display: block;
                font-size: 1px;
            }

            .qmbox .xb1, .qmbox .xb2, .qmbox .xb3, .qmbox .xb4 {
                display: block;
                overflow: hidden;
            }

            .qmbox .xb1, .qmbox .xb2, .qmbox .xb3 {
                height: 1px;
            }

            .qmbox .xb2, .qmbox .xb3, .qmbox .xb4 {
                border-left: 1px solid #BCBCBC;
                border-right: 1px solid #BCBCBC;
            }

            .qmbox .xb1 {
                margin: 0 5px;
                background: #BCBCBC;
            }

            .qmbox .xb2 {
                margin: 0 3px;
                border-width: 0 2px;
            }

            .qmbox .xb3 {
                margin: 0 2px;
            }

            .qmbox .xb4 {
                height: 2px;
                margin: 0 1px;
            }

            .qmbox .xboxcontent {
                display: block;
                border: 0 solid #BCBCBC;
                border-width: 0 1px;
            }

            .qmbox .line {
                margin-top: 6px;
                border-top: 1px dashed #B9B9B9;
                padding: 4px;
            }

            .qmbox .neirong {
                padding: 6px;
                color: #666666;
            }

            .qmbox .foot {
                padding: 6px;
                color: #777;
            }

            .qmbox .font_darkblue {
                color: #006699;
                font-weight: bold;
            }

            .qmbox .font_lightblue {
                color: #008BD1;
                font-weight: bold;
            }

            .qmbox .font_gray {
                color: #888;
                font-size: 12px;
            }
        </style>
        <div class="contaner">
            <div class="title">Natrium Boost IP List</div>
            <div class="content">
                <p class="biaoti"><b>亲爱的钠加速用户，你好！</b></p>
                <b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
                <div class="xboxcontent">
                    <div class="neirong">
                        <p><b>Node 1 - 沪日主线:</b><span id="userName" class="font_darkblue"> iplc-jp-01.imbaiyu.cn:60002</span></p>
                        <p><b>Node 2 - 沪日备线:</b><span class="font_lightblue"><span id="yzm" data="$(captcha)" onclick="return false;" t="7" style="border-bottom: 1px dashed rgb(204, 204, 204); z-index: 1; position: static;"> backup.imbaiyu.cn</span></span></span></p>
	        <p><b>Node 3 - 深港主线:</b><span class="font_lightblue"><span id="yzm" data="$(captcha)" onclick="return false;" t="7" style="border-bottom: 1px dashed rgb(204, 204, 204); z-index: 1; position: static;"> iplc-hk.imbaiyu.cn</span></span></span></p>
                        <div class="line">如果您未购买我们服务，请忽略该邮件。该邮件为系统自动发送。</div>
                    </div>
                </div>
                <b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
                <p class="foot">如果仍有问题，请联系QQ客服: <span data="800-820-5100" onclick="return false;" t="7" style="border-bottom: 1px dashed rgb(204, 204, 204); z-index: 1; position: static;">3293574906
</span></p>
            </div>
        </div>
        <style type="text/css">
            .qmbox style, .qmbox script, .qmbox head, .qmbox link, .qmbox meta {
                display: none !important;
            }
        </style>
    </div>
</body>
</html>

    ';
    $mail->AltBody = 'Natrium Boost IP List:\n- Node 1 - 沪日主线: premium.imbaiyu.cn\n- Node 2 - 沪日备线: backup.imbaiyu.cn\n- Node 3 - 深港主线: iplc-hk.imbaiyu.cn';
    $mail->send();
    echo '邮件发送成功';
} catch (Exception $e) {
    echo '邮件发送失败: ', $mail->ErrorInfo;
}