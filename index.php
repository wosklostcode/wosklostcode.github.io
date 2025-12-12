<?php
$message = '';
$is_error = false; 

$name = trim(htmlspecialchars($_POST['name']));
$phone = trim(htmlspecialchars($_POST['phone']));
    
if (empty($name) || empty($phone)) {
    $message = 'Пожалуйста, заполните все поля.';
    $is_error = true;
} elseif (strlen($name) < 2) {
    $message = 'Имя должно содержать минимум 2 символа.';
    $is_error = true;
} elseif (strlen($phone) < 5) {
    $message = 'Номер телефона слишком короткий.';
    $is_error = true;
} else {
    $data = date("Y-m-d H:i:s") . " | Имя: $name | Телефон: $phone\n";
    
    $file = fopen("leads.txt", "a");
    
    if ($file && fwrite($file, $data)) {
        fclose($file);
        $message = 'Спасибо, ' . $name . '! Мы свяжемся с вами в течение 15 минут.';
        $is_error = false;
        
        $_POST['name'] = '';
        $_POST['phone'] = '';
    } else {
        $message = 'Произошла ошибка при сохранении заявки. Пожалуйста, попробуйте позже.';
        $is_error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArshinTech</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">    
</head>
<body>
    <header class="header">
        <div class="toprect">
            <img src="img/header_logo.png" class="logo" width="93" height="40" alt="ArshinTech логотип">
            <nav>
                <a class="graytag" href="#">Услуги</a>
                <a class="graytag" href="#">Схема работы</a>
                <a class="graytag" href="#">Контакты</a>
            </nav>
            <h2>+7 (843) 253-22-81</h2>
        </div>
    </header>
    
    <div class="widthblock">
        <div class="maincontent">
            <div class="rect1">
                <p class="tag">видеонаблюдение</p>
                <p class="tag">Казань</p>
                <h1>Установка и продажа систем видеонаблюдения</h1>
                <p class="subtitle1">Понятным языком объясняем технические термины</p>
                <img src="img/Frame_104.png" width="135" height="128" alt="Иконка">   
            </div>
            <div class="rect2">
                <h1>ARSHIN TECH</h1>
                <p>Объединение профессионалов, с большим опытом работы в сфере систем видеонаблюдения, контроля доступа и видеодомофонии.</p>
                <img src="img/Frame_103.png" width="165" height="165" alt="Иконка">
                <!-- Кнопка для прокрутки к форме заявки -->
                <button class="tabletka2" onclick="document.getElementById('contactForm').scrollIntoView({behavior: 'smooth'})">
                    <h2>Оставить заявку <img src="img/strela_52.png" width="35" height="35" alt="Стрелка"></h2>
                </button>
            </div>
            <img src="img/image_1.png" class="camera" width="460" height="608" alt="Камера видеонаблюдения">
        </div>
    </div>

    <div class="widthblock">
        <div class="maincontent">
            <div class="rect3">
                <p class="tag2">преимущества</p>
                <h1>ПОЧЕМУ НАС ВЫБИРАЮТ?</h1>
                <p class="abzac3">Наша компания проектирует, поставляет оборудование и реализует проекты любой сложности на протяжении <span class="bold">5 лет</span>.</p>
                <p class="abzac4">Мы используем только <span class="bold">современное оборудование</span> и выполняем монтаж в рамках индивидуального запроса клиента.</p>
                <button class="tabletka3">
                    <p>Смотреть презентации</p>
                </button>
            </div>
            <div class="cardgrid">
                <div class="card">
                    <img src="img/Frame_80.png" width="60" height="60" alt="Иконка">
                    <p>Подбор и монтаж системы видеонаблюдения <span class="bold">в короткие сроки</span></p>
                </div>  
                <div class="card">
                    <img src="img/Frame_81.png" width="60" height="60" alt="Иконка">
                    <p>Оборудование от <span class="bold">надёжных брендов</span> систем безопасности c <span class="bold">гарантией от 3-х лет</span></p>
                </div>
                <div class="card">
                    <img src="img/Frame_83.png" width="60" height="60" alt="Иконка">
                    <p>Обязательный выезд специалиста на объект до начала работ, <span class="bold">для точного расчёта стоимости</span></p>
                </div>
                <div class="card">
                    <img src="img/Frame_82.png" width="60" height="60" alt="Иконка">
                    <p>Чистый монтаж на объектах c готовым ремонтом! B работе <span class="bold">используем промышленные пылесосы</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="widthblock">
        <div class="maincontent">
            <div class="contact-form-section" id="contactForm">
                <div class="form-container">
                    <h2 class="form-title">Оставьте заявку</h2>
                    <p class="form-subtitle">Мы свяжемся с вами в течение 15 минут</p>
                    
                    <?php if (!empty($message)): ?>
                    <div class="form-message <?php echo $is_error ? 'error' : 'success'; ?>">
                        <?php echo $message; ?>
                    </div>
                    <?php endif; ?>
                    
                    <form action="index.php" method="POST" class="contact-form" id="applicationForm">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Ваше имя" required class="form-input" 
                                   value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required class="form-input" 
                                   value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                        </div>
                        <button type="submit" class="submit-btn">
                            <span>Отправить</span>
                            <img src="img/strela_52.png" width="25" height="25" alt="Стрелка">
                        </button>
                    </form>
                    
                    <p class="form-note">Нажимая на кнопку, вы соглашаетесь с политикой конфиденциальности</p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>