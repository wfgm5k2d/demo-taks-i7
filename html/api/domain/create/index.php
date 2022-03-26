<?php include $_SERVER['DOCUMENT_ROOT'] . '/core/index.php';

$obResult = [
    'status' => "success",
    "message" => "success"
];
$sDomain = Helper::filter($_REQUEST['domain']);
$sComment = Helper::filter($_REQUEST['comment']);
$sDescription = Helper::filter($_REQUEST['description']);
$sAutorenewal = Helper::filter($_REQUEST['autorenewal']) == 'on';
$sAutoparking = Helper::filter($_REQUEST['autoparking']) == 'on';
$sTestzone = Helper::filter($_REQUEST['testzone']) == 'on';
$sDelegate = Helper::filter($_REQUEST['delegate']) == 'on';
$sNameserver = explode(';', $_REQUEST['nameserver']);

$obDomain = new Domain();
$obResponce = $obDomain->domainCreate($sComment, $sDomain, $sDescription, $sNameserver, $sDelegate, $sTestzone, $sAutorenewal, $sAutoparking);

if($obResponce->error) {
    $obResult['status'] = "error";
    $obResult['message'] = $obResponce->error->message;
    echo json_encode($obResult);
} else {
    echo json_encode($obResult);
}