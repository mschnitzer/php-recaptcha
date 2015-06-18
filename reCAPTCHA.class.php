<?php
 class reCAPTCHA {

     private $privatekey;
     private $response;
     private $result = array();

     public function __construct($response, $privatekey) {
         $this->privatekey = $privatekey;
         $this->response = $response;
     }

     public function sendRequest() {
         $content = http_build_query(array(
             'secret' => $this->privatekey,
             'response' => $this->response,
         ), '', '&');


         $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => $content
            )
         );
         
         $context  = stream_context_create($options);
         $this->result = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context), true);
     }

     public function isSolved() {
         if (isset($this->result['success']) && intval($this->result['success']) == 1) {
             return true;
         }

         return false;
     }

     public function getResult() {
         return $this->result;
     }

 }
?>
