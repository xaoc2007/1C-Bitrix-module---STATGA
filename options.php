<?php
/**
 * Module settings.
 */

/*
 * Include some standard language constants.
 */
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
IncludeModuleLangFile(__FILE__);

$tabs = array(
    array(
        "DIV"   => 'general',
        "TAB"   => GetMessage('STATGA_OPTIONS_GENERAL_TAB'),
        "ICON"  => '',
        "TITLE" => GetMessage('STATGA_OPTIONS_GENERAL_TAB_TITLE')
    )
);
$tabControl = new CAdminTabControl("statgaSettings", $tabs);
if (
    (strlen($_POST['Update'].$_POST['Apply']) > 0)
    &&
    check_bitrix_sessid()
) {

    foreach ($_POST['settings'] as $settingName => $settingValue) {
        COption::SetOptionString('statga', $settingName, $settingValue);
    }

    if (strlen($_REQUEST['Update']) && strlen($_REQUEST['back_url_settings'])) {
        LocalRedirect($_REQUEST['back_url_settings']);
    } else {
        LocalRedirect(
            $GLOBALS['APPLICATION']->GetCurPage().
            "?mid=".urlencode($mid).
            "&lang=".urlencode(LANGUAGE_ID).
            "&back_url_settings=".urlencode($_REQUEST["back_url_settings"]).
            "&".$tabControl->ActiveTabParam()
        );
    }
}

$tabControl->Begin();

?>
<form
    name="mailTransportSettingsForm"
    method="post"
    action="<?php echo $GLOBALS['APPLICATION']->GetCurPage() ?>?mid=<?php echo urlencode($mid) ?>&amp;lang=<?php echo LANGUAGE_ID ?>">
<?php $tabControl->BeginNextTab() ?>
        <tr class="heading">
            <td colspan="2"><?php echo GetMessage('STATGA_OPTIONS_CONNECTION_SECTION') ?></td>
        </tr>

        <tr class="heading">
            <td colspan="2"><?php echo GetMessage('STATGA_OPTIONS_AUTHENTICATION_SECTION') ?></td>
        </tr>
        <tr>
            <td width="50%"><?php echo GetMessage('STATGA_OPTIONS_USERNAME') ?>:</td>
            <td width="50%">
                <input
                    type="text"
                    size="30"
                    value="<?php echo COption::GetOptionString('statga', 'ga_login') ?>"
                    name="settings[ga_login]" />
            </td>
        </tr>
        <tr>
            <td width="50%"><?php echo GetMessage('STATGA_OPTIONS_PASSWORD') ?>:</td>
            <td width="50%">
                <input
                    type="password"
                    size="30"
                    name="settings[ga_password]" />
            </td>
        </tr>
        <tr>
            <td width="50%"><?php echo GetMessage('STATGA_OPTIONS_USERNAME') ?>:</td>
            <td width="50%">
                <input
                    type="text"
                    size="30"
                    value="<?php echo COption::GetOptionString('statga', 'ga_id') ?>"
                    name="settings[ga_id]" />
            </td>
        </tr>

<?php $tabControl->Buttons() ?>
    <input
        type="submit"
        name="Update"
        value="<?php echo GetMessage("MAIN_SAVE") ?>"
        title="<?php echo GetMessage("MAIN_OPT_SAVE_TITLE") ?>" />
    <input
        type="submit"
        name="Apply"
        value="<?php echo GetMessage("MAIN_OPT_APPLY") ?>"
        title="<?php echo GetMessage("MAIN_OPT_APPLY_TITLE") ?>" />
    <?php if (strlen($_REQUEST["back_url_settings"])) { ?>
        <input
            type="button"
            name="Cancel"
            value="<?php echo GetMessage("MAIN_OPT_CANCEL") ?>"
            title="<?php echo GetMessage("MAIN_OPT_CANCEL_TITLE") ?>"
            onclick="window.location='<?php echo htmlspecialchars(CUtil::addslashes($_REQUEST["back_url_settings"])) ?>'" />
        <input
            type="hidden"
            name="back_url_settings"
            value="<?php echo htmlspecialchars($_REQUEST["back_url_settings"]) ?>" />
    <?php } ?>
    <?php echo bitrix_sessid_post() ?>
<?php $tabControl->End() ?>
</form>
