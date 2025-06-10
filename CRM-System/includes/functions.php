<!-- các hàm chung của project -->

<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

define('_WEB_PATH_TEMPLATES', __DIR__ . '/../templates'); // Đường dẫn tương ứng với cấu trúc thư mục của bạn

function layouts($layoutName = 'header', $data = [])
{
    if (file_exists(_WEB_PATH_TEMPLATES . '/layout/' . $layoutName . '.php')) {
        require_once _WEB_PATH_TEMPLATES . '/layout/' . $layoutName . '.php';
    }
}

// Hàm gửi mail
function sendMail($to, $subject, $content)
{


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ilovebesun1996@gmail.com';                     //SMTP username
        $mail->Password   = 'iiwovvscaavymnbs';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('duynghiadev@gmail.com', 'Duy Nghia Dev');
        $mail->addAddress($to);     //Add a recipient


        //Content
        $mail->CharSet = "UTF-8";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        //PHPMailer SSL certificate verify failed
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $sendMail = $mail->send();
        if ($sendMail) {
            return $sendMail;
        }
        // echo 'Gửi thành công!!';

    } catch (Exception $e) {
        echo "Gửi mail thất bại. Mailer Error: {$mail->ErrorInfo}";
    }
}


// Kiểm tra phương thức GET
function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }
    return false;
}

// Kiểm tra phương thức POST
function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}

// Hàm Filter lọc dữ liệu
function filter()
{
    $filterArr = [];
    if (isGet()) {
        // Xử lý cái dữ liệu trước khi hiển thị ra
        // return $_GET;
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }

    if (isPost()) {

        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }

    return $filterArr;
}

//  Kiểm tra email
function isEmail($email)
{
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

// Hàm kiểm tra số nguyên INT
function isNumberInt($number)
{
    $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    return $checkNumber;
}

// Hàm kiểm tra số thực Float
function isNumberFloat($number)
{
    $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    return $checkNumber;
}

// Hàm kiểm tra số điện thoại
function isPhone($phone)
{
    // 0987657282
    $checkZero = false;

    // Điều kiện 1: ký tự đầu tiên là số 0
    if ($phone[0] == '0') {
        $checkZero = true;
        $phone = substr($phone, 1);
    }

    // Điều kiện 2: Đằng sau nó có 9 số
    $checkNumber = false;
    if (isNumberInt($phone) && (strlen($phone) == 9)) {
        $checkNumber = true;
    }

    if ($checkZero && $checkNumber) {
        return true;
    }

    return false;
}

// Thông báo lỗi
function getSmg($smg, $type = 'success')
{
    echo '<div class= "alert alert-' . $type . '">';
    echo $smg;
    echo '</div>';
}

// Hàm chuyển hướng
function redirect($path = 'index.php')
{
    header("Location: $path");
    exit;
}

// Hàm thông báo lỗi
function form_error($fileName, $beforeHtml = '', $afterHtml = '', $errors)
{
    return (!empty($errors[$fileName])) ? '<span class="error">' . reset($errors[$fileName]) . '</span>' : null;
}


// Hàm hiển thị dữ liệu cũ
function old($fileName, $oldData, $default = null)
{
    return (!empty($oldData[$fileName])) ? $oldData[$fileName] : $default;
}

// HÀm kiểm tra trạng thái đăng nhập
function isLogin()
{
    $checkLogin = false;
    if (getSession('loginToken')) {
        $tokenLogin = getSession('loginToken');

        // Kiểm tra token có giống trong database
        $queryToken = oneRaw("SELECT user_Id FROM loginToken WHERE token = '$tokenLogin' ");

        if (!empty($queryToken)) {
            $checkLogin = true;
        } else {
            removeSession('loginToken');
        }
    }

    return $checkLogin;
}
