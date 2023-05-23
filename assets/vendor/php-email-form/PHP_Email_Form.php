<?php
 /*
Name: mratotech
Author: mratotech>
Author URI: https://my.bio/mratotech
Copyright: mratotech
*/

class PHP_Email_Form {
    public $ajax = false;
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $message;
    
    public function add_message($content, $label, $length = 0) {
        $this->message .= $label . ': ' . $content . "\n";
        if ($length > 0) {
            $this->message .= str_repeat('-', $length) . "\n";
        }
    }
    
    public function send() {
        $headers = 'From: ' . $this->from_name . ' <' . $this->from_email . '>' . "\r\n";
        
        if ($this->ajax) {
            header('Content-Type: application/json');
            $response_array = array('message' => 'Email sent!', 'status' => 'success');
            echo json_encode($response_array);
            die();
        } else {
            return mail($this->to, $this->subject, $this->message, $headers);
        }
    }
}
?>
