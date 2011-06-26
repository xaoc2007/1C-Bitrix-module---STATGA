<?php
$MESS['STATGA_MODULE_NAME']        = 'Статистика Google.Analitics';
$MESS['STATGA_MODULE_DESCRIPTION'] = 'Отображает графики посещения сайта';

$MESS['STATGA_OPTIONS_GENERAL_TAB']          = 'Настройки';
$MESS['STATGA_OPTIONS_GENERAL_TAB_TITLE']    = 'Настройки подключения';
$MESS['STATGA_OPTIONS_AUTHENTICATION_SECTION']    = 'Параметры доступа к счетчику';

$MESS['STATGA_OPTIONS_USERNAME']    = 'Аккаунт GA(логин или email)';
$MESS['STATGA_OPTIONS_PASSWORD']    = 'Пароль (не показывается)';
$MESS['STATGA_ANALYTICS_ID']    = 'Идентификатор счетчика(из урла)';

$MESS['STATGA_ANALYTICS_ID_DESCR']    = 'Идентификатор счетчика можно узнать из урла при переходе на главную страницу с отчетами: <br/>https://www.google.com/analytics/reporting/?reset=1&id=xxxxxxx';

$MESS['STATGA_DESCR']    = 'Внимание! Чтобы импорт статистики не влиял на скорость сайта, необходимо назначить запуск импорта статистики на Crone: а именно настроить на сервере запуск файла /bitrix/modules/statga/import.php раз в сутки';