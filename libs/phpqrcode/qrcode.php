<?php
require_once('qrcode/qrlib.php');

$code = 'Nusansifor'.date('Ymd:His').'-NSI';

$url = getHostByName(getHostName());
$url .= '/aplikasi_absen/absen.php';


QRcode::png('http://'.$url.'?qrc='.sha1($code));
