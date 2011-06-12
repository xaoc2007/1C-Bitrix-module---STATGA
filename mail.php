<?php
function mailSend($from, $to, $subject='no subject', $message='no message', $encoding="utf-8", $debug=false)
{
    //CModule::IncludeModule("iblock");
    //$to = "etrinchuk@pigeon.office.liga.net";
    //$from = "dom-info@pigeon.office.liga.net";
    //$subject = "test";
    //$message = "Test message! - 1";
    //$additionalHeaders = 'From: ' . $from . "\r\n";
    $additionalHeaders = 'MIME-Version: 1.0' . "\r\n";
    $additionalHeaders .= 'Content-Type: text/html; charset='.$encoding.'; format=flowed' . "\r\n";
    $additionalHeaders .= 'Content-Transfer-Encoding: 8Bit' . "\r\n";
    $additionalHeaders .= 'From: '.$from."";
    custom_mail($to, $subject, $message, $additionalHeaders, true);
}
