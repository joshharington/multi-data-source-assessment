<?php


namespace App\Utilities\Models;


class GeneralErrorModel {

    public $error_code;
    public $message;

    public function __construct($error_code,  $message) {
        $this->error_code = $error_code;
        $this->message = $message;
    }

    public function toJson() {
        return [
            'error' => true,
            'error_code' => $this->error_code,
            'message' => $this->message,
        ];
    }
}
