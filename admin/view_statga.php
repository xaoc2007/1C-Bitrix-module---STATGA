<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
<script type="text/javascript" src="/bitrix/js/statga/swfobject.js"></script>
<div id="visitors" align="center" style="padding-bottom:80px">
	<strong>Для просмотра сожержимого, установите последнюю версию Adobe Flash Player</strong>
</div>
<script type="text/javascript">
	// <![CDATA[
	var so = new SWFObject("/bitrix/swf/statga/amline.swf", "amline_chart", "630", "500", "8", "#FFFFFF");
	so.addVariable("path", "./amline/");
	so.addVariable("settings_file", escape("/bitrix/xml/statga/visitors_settings.xml?<?php echo mktime();?>"));
	so.addVariable("data_file", escape("/bitrix/cache/s1/statga/visitors.csv?<?php echo mktime();?>"));
	so.addVariable("preloader_color", "#BBBBBB");
	so.write("visitors");
	// ]]>
</script>



	<div id="visitors_3" align="center" style="padding-bottom:80px">
		<strong>Для просмотра сожержимого, установите последнюю версию Adobe Flash Player</strong>
	</div>


<script type="text/javascript">
	// <![CDATA[
	var so = new SWFObject("/bitrix/swf/statga/amline.swf", "amline_chart", "600", "400", "8", "#FFFFFF");
	so.addVariable("path", "./amline/");
	so.addVariable("settings_file", escape("/bitrix/xml/statga/visitors_3_settings.xml?<?php echo mktime();?>"));
	so.addVariable("data_file", escape("/bitrix/cache/s1/statga/visitors_3.csv?<?php echo mktime();?>"));
	so.addVariable("preloader_color", "#BBBBBB");
	so.write("visitors_3");
	// ]]>
</script>



	<div id="country" align="center" style="padding-bottom:80px">
		<strong>Для просмотра сожержимого, установите последнюю версию Adobe Flash Player</strong>
	</div>

<script type="text/javascript">
	// <![CDATA[
	var so = new SWFObject("/bitrix/swf/statga/ampie.swf", "ampie_chart", "550", "350", "8", "#FFFFFF");
	so.addVariable("path", "./ampie/");
	so.addVariable("settings_file", escape("/bitrix/xml/statga/country_settings.xml?<?php echo mktime();?>"));
	so.addVariable("data_file", escape("/bitrix/cache/s1/statga/country.csv?<?php echo mktime();?>"));
	so.addVariable("preloader_color", "#BBBBBB");
	so.write("country");
	// ]]>

</script>


	<div id="city" align="center" style="padding-bottom:80px">
		<strong>Для просмотра сожержимого, установите последнюю версию Adobe Flash Player</strong>
	</div>

<script type="text/javascript">
	// <![CDATA[
	var so = new SWFObject("/bitrix/swf/statga/ampie.swf", "ampie_chart", "550", "350", "8", "#FFFFFF");
	so.addVariable("path", "./ampie/");
	so.addVariable("settings_file", escape("/bitrix/xml/statga/country_settings.xml?<?php echo mktime();?>"));
	so.addVariable("data_file", escape("/bitrix/cache/s1/statga/city.csv?<?php echo mktime();?>"));
	so.addVariable("preloader_color", "#BBBBBB");
	so.write("city");
	// ]]>

</script>