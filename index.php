<?php
session_start();
$data_dir = 'vault_data/';
if (!file_exists($data_dir)) mkdir($data_dir, 0777, true);

// تشفير بسيط
function encrypt($data) {
    return base64_encode(openssl_encrypt($data, 'AES-128-ECB', 'digital_vault_secret_key'));
}
function decrypt($data) {
    return openssl_decrypt(base64_decode($data), 'AES-128-ECB', 'digital_vault_secret_key');
}

// تسجيل حساب جديد
if (isset($_POST['register'])) {
    $users_file = $data_dir.'users.txt';
    $user_data = $_POST['email'].'|'.password_hash($_POST['password'], PASSWORD_DEFAULT).PHP_EOL;
    file_put_contents($users_file, $user_data, FILE_APPEND);
    $msg = "تم إنشاء الحساب. سجل دخولك الآن";
}

// تسجيل دخول
if (isset($_POST['login'])) {
    $users_file = $data_dir.'users.txt';
    if (file_exists($users_file)) {
        $users = file($users_file);
        foreach ($users as $user) {
            list($email, $hash) = explode('|', trim($user));
            if ($email == $_POST['email'] && password_verify($_POST['password'], $hash)) {
                $_SESSION['user'] = $email;
                break;
            }
        }
    }
    if (!isset($_SESSION['user'])) $error = "بيانات الدخول غلط";
}

// تسجيل خروج
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
}

// حفظ وصية
if (isset($_POST['save_will']) && isset($_SESSION['user'])) {
    $will_file = $data_dir.md5($_SESSION['user']).'_will.txt';
    file_put_contents($will_file, encrypt($_POST['will_text']));
    $msg = "تم حفظ الوصية بنجاح ومشفرة";
}

// لو مسجل دخول - اعرض لوحة التحكم
if (isset($_SESSION['user'])) {
    $will_file = $data_dir.md5($_SESSION['user']).'_will.txt';
    $current_will = file_exists($will_file) ? decrypt(file_get_contents($will_file)) : '';
    echo <<<HTML
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - خزنة الميراث</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-blue-400">أهلاً {$_SESSION['user']}</h1>
            <a href="?logout=1" class="bg-red-600 px-4 py-2 rounded">تسجيل خروج</a>
        </div>
        
        <div class="bg-gray-800 p-6 rounded-lg">
            <h2 class="text-2xl mb-4 text-green-400">وصيتك الرقمية</h2>
            <form method="POST">
                <textarea name="will_text" class="w-full h-64 bg-gray-700 p-4 rounded text-white mb-4" placeholder="اكتب وصيتك هنا...">$current_will</textarea>
                <button name="save_will" class="bg-blue-600 px-6 py-3 rounded">حفظ الوصية مشفرة</button>
            </form>
            <p class="text-sm text-gray-400 mt-4">✅ البيانات بتتحفظ مشفرة في ملف على السيرفر</p>
        </div>
    </div>
</body>
</html>
HTML;
exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خزنة الميراث الرقمية</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <h1 class="text-4xl font-bold mb-8 text-center text-blue-400">خزنة الميراث الرقمية</h1>
            
            <?php if(isset($msg)) echo "<div class='bg-green-800 p-3 rounded mb-4 text-center'>$msg</div>"; ?>
            <?php if(isset($error)) echo "<div class='bg-red-800 p-3 rounded mb-4 text-center'>$error</div>"; ?>
            
            <div class="bg-gray-800 p-6 rounded-lg mb-4">
                <h2 class="text-xl mb-4">تسجيل دخول</h2>
                <form method="POST">
                    <input name="email" type="email" placeholder="الإيميل" class="w-full bg-gray-700 p-3 rounded mb-3" required>
                    <input name="password" type="password" placeholder="كلمة المرور" class="w-full bg-gray-700 p-3 rounded mb-3" required>
                    <button name="login" class="w-full bg-blue-600 p-3 rounded">دخول</button>
                </form>
            </div>

            <div class="bg-gray-800 p-6 rounded-lg">
                <h2 class="text-xl mb-4">حساب جديد</h2>
                <form method="POST">
                    <input name="email" type="email" placeholder="الإيميل" class="w-full bg-gray-700 p-3 rounded mb-3" required>
                    <input name="password" type="password" placeholder="كلمة المرور" class="w-full bg-gray-700 p-3 rounded mb-3" required>
                    <button name="register" class="w-full bg-green-600 p-3 rounded">إنشاء حساب</button>
                </form>
            </div>
            
            <p class="text-center text-xs text-gray-500 mt-6">✅ الموقع شغال فعلياً ويحفظ البيانات مشفرة</p>
        </div>
    </div>
</body>
</html>