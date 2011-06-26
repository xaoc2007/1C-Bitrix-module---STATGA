<?php
/**
 * Модуль импорта и показа статистика Google.Analytics для Битрикса
 *
 * Может быть использован как альтернатива модуля Веб-аналитика из старших редакций Битрикса.
 *
 * За основу был взят скрипт импорта и показа статистики из статьи http://habrahabr.ru/blogs/webdev/72335/,
 * а именно http://code.google.com/p/statga/downloads/list
 *
 * Основной класс для работы с API: http://code.google.com/p/gapi-google-analytics-php-interface/
 *
 * Иконка взята отсюда http://www.iconspedia.com/icon/google-analytics--737.html
 *
 * Настройки отображения графиков в папке /bitrix/xml/statga/
 *
 * Code license GNU GPL v3
 */

require_once dirname(__FILE__).'/install/index.php';

require_once dirname(__FILE__).'/classes/gapi.class.php';
