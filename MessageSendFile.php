<?php
$body = "Ei, WT ei ole kasutaja";
$number = '5563999732840';
$fileName = "/home/acer-note/dev/whaticket/whaticket-helper/readme.md"; // caminho do arquivo


$url = "http://localhost:8080/api/messages/send"; // api url
$token = "a582643b-32b5-4936-89cd-7c9a56911697"; // api token

$fileSize = filesize($fileName);

if (!file_exists($fileName)) {
  $out['status'] = 'error';
  $out['message'] = 'File not found.';
  exit(json_encode($out));
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$finfo = finfo_file($finfo, $fileName);

$cFile = new CURLFile($fileName, $finfo, basename($fileName));
$data = [
  'number' => $number,
  'body' => $body,
  "medias" => $cFile,
  "filename" => $cFile->postname
];

$cURL = curl_init($url);

curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
curl_setopt(
  $cURL,
  CURLOPT_HTTPHEADER,
  [
    "Authorization: Bearer " . $token,
    "Content-Type: multipart/form-data",
  ]
);
curl_setopt($cURL, CURLOPT_POST, true);
curl_setopt($cURL, CURLOPT_POSTFIELDS, $data);
curl_setopt($cURL, CURLOPT_INFILESIZE, $fileSize);
curl_setopt($cURL, CURLOPT_SSL_VERIFYHOST, false);
 curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($cURL);
curl_close($cURL);

die($response);
