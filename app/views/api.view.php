<?php


 class  Apiview {

    public function response($data, $status) {
    header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
    echo json_encode($data);
    }
    private function requestStatus($code) {
    $statuses = array(
      200 => "OK",
      404 => "Not Found",
      500 => "Internal Server Error"
    );
    return (isset($statuses[$code])) ? $statuses[$code] : $statuses[500];
    }
 }