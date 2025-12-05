<?php
// Установка заголовков для JSON ответа
header('Content-Type: application/json');

// Включение отображения ошибок (удалить в продакшене!)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Проверка метода запроса
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
    exit;
}

// Получение и валидация данных
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';

// Проверка заполненности полей
if (empty($name)) {
    echo json_encode(['success' => false, 'message' => 'Пожалуйста, введите ваше имя']);
    exit;
}

if (empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Пожалуйста, введите номер телефона']);
    exit;
}

// Базовая валидация номера телефона (минимум 10 цифр)
$phone_digits = preg_replace('/[^\d]/', '', $phone);
if (strlen($phone_digits) < 10) {
    echo json_encode(['success' => false, 'message' => 'Номер телефона должен содержать минимум 10 цифр']);
    exit;
}

// Защита от SQL-инъекций (санитизация)
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');

// ВАРИАНТ 1: Сохранение в файл (для локального тестирования)
$log_file = 'applications.txt';
$timestamp = date('Y-m-d H:i:s');
$log_entry = "[$timestamp] Имя: $name | Телефон: $phone\n";
file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);

// ВАРИАНТ 2: Отправка на email (раскомментируйте и замените на реальный email)
/*
$to = 'your_email@example.com';
$subject = 'Новая заявка с сайта ARSHIN TECH';
$message = "Новая заявка:\n\nИмя: $name\nТелефон: $phone\nВремя: $timestamp";
$headers = "From: noreply@arshintech.ru\r\nContent-Type: text/plain; charset=UTF-8";

if (mail($to, $subject, $message, $headers)) {
    // Email отправлен успешно
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка при отправке email']);
    exit;
}
*/

// ВАРИАНТ 3: Сохранение в базу данных MySQL (раскомментируйте после конфигурации)
/*
$db_host = 'localhost';
$db_user = 'username';
$db_pass = 'password';
$db_name = 'arshin_tech';

try {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    if ($conn->connect_error) {
        throw new Exception('Ошибка подключения: ' . $conn->connect_error);
    }
    
    $stmt = $conn->prepare("INSERT INTO applications (name, phone, created_at) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $phone, $timestamp);
    
    if (!$stmt->execute()) {
        throw new Exception('Ошибка при вставке данных: ' . $stmt->error);
    }
    
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка БД: ' . $e->getMessage()]);
    exit;
}
*/

// Успешный ответ
echo json_encode([
    'success' => true,
    'message' => 'Заявка успешно отправлена'
]);
?>
