<?php
// ini_set('display_errors', 0 );
$origem = "5563999364840";
## RETORNA FONE TRATADO
$whatsapp = "5563999732840";

## INICIA INTEGRAÇÃO WHATICKET
## AQUI INSERE A URL DA API
$url = 'http://localhost:8080/api/messages/send';
$data = array(
    "number" => $whatsapp,
    "body" => "Tô com saudades de você. Te amo",
    "whatsappId" => 3
  );
  $postdata = json_encode($data);

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json",
            "Authorization: Bearer a582643b-32b5-4936-89cd-7c9a56911697",
            "Content-Type: application/json",));
  $result = curl_exec($ch);
  curl_close($ch);
  print_r ($result);
  ?>
