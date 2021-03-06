<?php
if (class_exists('statga')) {
    return;
}

class statga extends CModule
{

    public $MODULE_ID;
    public $MODULE_VERSION      = '0.11';
    public $MODULE_VERSION_DATE = '2011-06-26 12:30:10';

    public $MODULE_NAME='';
    public $MODULE_DESCRIPTION='';


    public function __construct()
    {
        IncludeModuleLangFile(__FILE__);
        $this->MODULE_ID = get_class($this);
        $this->MODULE_NAME = GetMessage(strtoupper($this->MODULE_ID).'_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage(strtoupper($this->MODULE_ID).'_MODULE_DESCRIPTION');
    }


    /*
     * Registration.
     */
    public function DoInstall()
    {
        RegisterModule($this->MODULE_ID);

        $this->InstallFiles();
    }


    /**
     * Unregistration.
     */
    public function DoUninstall()
    {
        $this->UnInstallFiles();

        UnRegisterModule($this->MODULE_ID);
    }


    function InstallFiles($arParams = array())
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/admin/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/js", $_SERVER["DOCUMENT_ROOT"]."/bitrix/js", true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/swf", $_SERVER["DOCUMENT_ROOT"]."/bitrix/swf", true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/xml", $_SERVER["DOCUMENT_ROOT"]."/bitrix/xml", true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/themes/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/", true, true);

        return true;
    }


    function UnInstallFiles()
    {
        DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/admin/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");
        DeleteDirFilesEx("/bitrix/js/".$this->MODULE_ID."/");
        DeleteDirFilesEx("/bitrix/swf/".$this->MODULE_ID."/");
        DeleteDirFilesEx("/bitrix/xml/".$this->MODULE_ID."/");
        DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/themes/.default/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default");
		DeleteDirFilesEx("/bitrix/themes/.default/icons/".$this->MODULE_ID."/");

        return true;
    }


    function Get_StatGA() {

        $u = COption::GetOptionString('statga', 'ga_login');
        $p = COption::GetOptionString('statga', 'ga_password');
        $id = COption::GetOptionString('statga', 'ga_id');

        //дата, начиная с которой необходимо получить данные из GA для отчета. Формат YYYY-MM-DD
        //берем дату год назад
        $datestart = mktime(0,0,0,date("m"),date("d"),date("Y")-1);
        //текущая дата
        $currentdate=date("Ymd");
        //дата, заканчивая которой
        //$datefinish="";
        //или вычисляем дату - конец предыдущего месяца
        $currentday=date("d");
        $currentmonth=date("m");
        $currentyear=date("Y");

        $datefinish=date("Y-m-d");

        //дата 3 месяца назад
        $date3MonthStart=date("Y-m-d",mktime(0,0,0,$currentmonth-3,$currentday-1,$currentyear));
        $date3MonthFinish=date("Y-m-d",mktime(0,0,0,$currentmonth,$currentday-1,$currentyear));

        //дата месяц назад
        $date1MonthStart=date("Y-m-d",mktime(0,0,0,$currentmonth-1,$currentday-1,$currentyear));
        $date1MonthFinish=date("Y-m-d",mktime(0,0,0,$currentmonth,$currentday-1,$currentyear));

        //количество стран
        $countryRows=3;
        //количество городов
        $cityRows=10;

        //csv-файл для отчета Посетители
        $visitorsCSV="visitors.csv";
        //csv-файл для отчета Посетители за посл. 3 месяца
        $visitors3CSV="visitors_3.csv";
        //csv-файл для отчета География по странам
        $countryCSV="country.csv";
        //csv-файл для отчета География по городам
        $cityCSV="city.csv";

        //полный пусть к директории со скриптом (слэш в конце обязателен!)
        $path= dirname(__FILE__)."/../../../cache/".SITE_ID."/statga/";

        try {
            $ga = new gapi($u,$p);

            //получаем пользователи/просмотры за все время
            $ga->requestReportData($id,array('month','year'),array('visitors','pageviews'),'year',null,$datestart, $datefinish,1,1000);

            //получаем и обрабатываем результаты
            foreach($ga->getResults() as $result) {
                $m=$result; //месяц год
                $visitors=$result->getVisitors(); //посетители
                $pageviews=$result->getPageviews(); //просмотры

                //приводим дату к удобочитаемому виду ,мменяем пробелы на точки
                $m=str_replace(" ",".",$m);

                //формируем строку
                $output.=$m.";".$visitors.";".$pageviews."\n";
            }

            //пишем в файл
            self::writeToFile($path.$visitorsCSV,$output);

            //получаем пользователи/просмотры/посещения за последние 3 месяца
            $ga->requestReportData($id,array('day','month','year'),array('visitors','visits','pageviews'),array('year','month'),null,$date3MonthStart, $date3MonthFinish,1,1000);

            //переменная для записи резалта
            $output="";

            //получаем и обрабатываем результаты
            foreach($ga->getResults() as $result) {
                $d=$result; //день
                $visitors=$result->getVisitors(); //посетители
                $pageviews=$result->getPageviews(); //просмотры
                $visits=$result->getVisits(); //посещения

                //приводим дату к удобочитаемому виду ,мменяем пробелы на точки
                $d=str_replace(" ",".",$d);

                //формируем строку
                $output.=$d.";".$visitors.";".$pageviews.";".$visits."\n";
            }

            //пишем в файл
            self::writeToFile($path.$visitors3CSV,$output);

            //получаем географию посещений за последний месяц
            $ga->requestReportData($id,array('country'),array('visits'),'-visits',null,$date1MonthStart, $date1MonthFinish,1,$countryRows);

            //переменная для записи резалта
            $output="";

            //получаем общее число посещений для всех стран
            $total_visits=$ga->getVisits();

            //получаем и обрабатываем результаты
            foreach($ga->getResults() as $result) {
                $country=$result->getCountry(); //страна
                $visits=$result->getVisits(); //кол-во посещений

                //нот сет переводим на русский
                $country=str_replace("(not set)","не определено",$country);

                //формируем строку
                $output.=$country.";".$visits."\n";
            }

            //пишем в файл
            self::writeToFile($path.$countryCSV,$output);

            //////получаем ГОРОДА за последний месяц
            $ga->requestReportData($id,array('city'),array('visits'),'-visits',null,$date1MonthStart, $date1MonthFinish,1,$cityRows);

            //переменная для записи резалта
            $output="";

            //получаем общее число посещений для всех стран
            $total_visits = $ga->getVisits();

            //получаем и обрабатываем результаты
            foreach($ga->getResults() as $result) {
                $city=$result->getCity(); //страна
                $visits=$result->getVisits(); //кол-во посещений

                //нот сет переводим на русский
                $city=str_replace("(not set)","не определено",$city);

                //формируем строку
                $output.=$city.";".$visits."\n";
            }

            //пишем в файл
            self::writeToFile($path.$cityCSV,$output);

        } catch (Exception $e) {
            $SEVERITY       = "WARNING";
            $ERROR_TYPE     = "STATGA_ERROR";
            $MODULE_ID      = "statga";
            $ITEM_ID        = "Get_StatGA";
            $DESCRIPTION    = $e->getMessage();
            CEventLog::Add(array(
                "SEVERITY"          => $SEVERITY,
                "AUDIT_TYPE_ID"     => $ERROR_TYPE,
                "MODULE_ID"         => $MODULE_ID,
                "ITEM_ID"           => $ITEM_ID,
                "DESCRIPTION"       => $DESCRIPTION,
            ));
        }

        return "statga::Get_StatGA();";
    }


    static function writeToFile($file_path, $content, $fmode='w') {
        $dir_is_writable = (file_exists(dirname($file_path)) && is_writable(dirname($file_path)));
        $file_is_writable = (is_file($file_path) && is_writable($file_path));
        if($dir_is_writable && $file_is_writable) {
            if($fp = fopen($file_path, $fmode)) {
                fputs($fp,trim($content));
                fclose($fp);
            }
        }
    }
}