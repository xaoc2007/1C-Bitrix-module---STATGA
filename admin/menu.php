<?
IncludeModuleLangFile(__FILE__); // в menu.php точно так же можно использовать языковые файлы

if($APPLICATION->GetGroupRight("statga")>"D") // проверка уровня доступа к модулю веб-форм
{
  // сформируем верхний пункт меню
  $aMenu = array(
    "parent_menu" => "global_menu_services", // поместим в раздел "Сервис"
    "sort"        => 300,                    // вес пункта меню
    "url"         => "view_statga.php?lang=".LANGUAGE_ID,  // ссылка на пункте меню
    "text"        => GetMessage("STATGA_MENU_MAIN"),       // текст пункта меню
    "title"       => GetMessage("STATGA_MENU_MAIN_TITLE"), // текст всплывающей подсказки
    "icon"        => "statga_menu_icon", // малая иконка
    "page_icon"   => "statga_page_icon", // большая иконка
    "items_id"    => "menu_statga",  // идентификатор ветви
    "items"       => array(),          // остальные уровни меню сформируем ниже.
  );

  // если нам нужно добавить ещё пункты - точно так же добавляем элементы в массив $aMenu["items"]
  // ............

  // вернем полученный список
  return $aMenu;
}
// если нет доступа, вернем false
return false;
?>