<?php
include_once 'bitrix.php';
include_once 'common.php';

$next_url = '/index.html';
{
$name = $_POST['name'];
$tel = $_POST['tel'];
$form = $_POST['form'];
$email = $_POST['email'];
// формирую поля для почты
    
    $desired_area_data = $_POST['desired_area']; // Выберите район на карте:
    $questone = implode(",", $desired_area_data);
    
    $desired_ending_date_data = $_POST['desired_ending_date']; // Срок сдачи:
      $questtwo = implode(",", $desired_ending_date_data);
    
    $desired_apartment_sizes_data = $_POST['desired_apartment_sizes']; // Количество комнат:
        $questthree = implode(",", $desired_apartment_sizes_data);
    
    $desired_finishing_data = $_POST['desired_finishing']; // Отделка:
         $questtfour = implode(",", $desired_finishing_data);
    
    $desired_prices_data = $_POST['desired_prices']; // Стоимость, руб.:
        $questfive = implode(",", $desired_prices_data);
    
    $desired_buy_method_data = $_POST['desired_buy_method']; //Как будете покупать?
        $questsix = implode(",", $desired_buy_method_data);
    
    $communication_method = $_POST['communication_method']; //Выберите предпочтительный способ связи:
        
        // Формирование заголовка письма
$subject  = "Заявка Стороны Света Телефон: $tel"; 
// Формирование тела письма
$msg .= "Телефон: " . $tel . "\r\n";
$msg .= "E-mail: " . $email . "\r\n";
$msg .= "Форма: " . $form . "\r\n";


if ($_POST['name'] != "") {
    $msg .= "ФИО - " . $name . "\r\n";
}

{
    if ($_POST['desired_area'] != "") {
        $msg .= "Выберите район на карте: " . $questone . "\r\n";
        }
    }
{
    if ($_POST['desired_ending_date'] != "") {
        $msg .= "Срок сдачи: " . $questtwo . "\r\n";
        }
    }
{
    if ($_POST['desired_apartment_sizes'] != "") {
        $msg .= "Количество комнат: " . $questthree . "\r\n";
        }
    }
{
    if ($_POST['desired_finishing'] != "") {
        $msg .= "Отделка: " . $questtfour . "\r\n";
        }
    }
{
    if ($_POST['desired_prices'] != "") {
        $msg .= "Стоимость, руб.: " . $questfive . "\r\n";
        }
    }

{
if ($_POST['desired_buy_method']) { 
    $msg .= "Как будете покупать?" . $questsix. "\r\n";
    }
}

if ($_POST['communication_method'] != "") {
    $msg .= "Выберите предпочтительный способ связи: " . $communication_method . "\r\n";
}


$headers .= "From: Заявка Стороны Света";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/plain; charset = utf-8\r\n";

// отправка сообщения
$verify = mail("M2saleBOT@gmail.com", $subject, $msg, $headers);

};





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $config = include('.config.php');

    function get_user_choice($select_name) {
        $user_choice = 'Не определились';
        if (!empty($_POST[$select_name]) && is_array($_POST[$select_name])) {
            $user_choice = implode(', ', $_POST[$select_name]);
        }

        return array($user_choice);
    }

    session_start();

    $name = $_POST['name'];
    $tel_data = array(array(
        "VALUE" => $_POST['tel'],
        "VALUE_TYPE" => "WORK",
    ));
    $email_data = array(array(
        "VALUE" => $_POST['email'],
        "VALUE_TYPE" => "WORK",
    ));

    $desired_area_data = get_user_choice('desired_area');
    $desired_ending_date_data = get_user_choice('desired_ending_date');
    $desired_apartment_sizes_data = get_user_choice('desired_apartment_sizes');
    $desired_finishing_data = get_user_choice('desired_finishing');
    $desired_prices_data = get_user_choice('desired_prices');
    $desired_buy_method_data = get_user_choice('desired_buy_method');
    $desired_communication_method = $_POST['communication_method'];
    // передаем в битрикс
    $fields = array(
        'TITLE' => $config['bitrix_title'],
        'SOURCE_ID' => $config['bitrix_source_id'],
        'NAME' => $name,
        'PHONE' => $tel_data,
        'EMAIL' => $email_data,
        'UF_CRM_1607117457' => $desired_area_data,
        'UF_CRM_1607118198' => $desired_ending_date_data,
        'UF_CRM_1607118230' => $desired_apartment_sizes_data,
        'UF_CRM_1607118252' => $desired_finishing_data,
        'UF_CRM_1607118266' => $desired_prices_data,
        'UF_CRM_1607118295' => $desired_buy_method_data,
        'UF_CRM_1606999324' => $desired_communication_method,
        'UTM_SOURCE' => $_POST['utm_source'],
        'UTM_MEDIUM' => $_POST['utm_medium'],
        'UTM_CAMPAIGN' => $_POST['utm_campaign'],
        'UTM_CONTENT' => $_POST['utm_content'],
        'UTM_TERM' => $_POST['utm_term'],
    );

    $query_data = array(
        'fields' => $fields,
        'params' => array("REGISTER_SONET_EVENT" => "Y"),
    );

    $result = make_bitrix_request('crm.lead.add', $query_data);

    if (array_key_exists('error', $result)) {
        log_to_file("Ошибка при сохранении лида: " . $result['error_description']);
    };
        
    $next_url = '/quiz-thanks.html';
}

header('Location: ' . $next_url);
die();
?>
