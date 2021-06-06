<?php


namespace App\Utilities\Models;


class UserModel {

    public $id;
    public $name;
    public $email;
    public $date_of_birth;

    public function __construct($id, $name, $email, $date_of_birth) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->date_of_birth = $date_of_birth;
    }

    public function toJson() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "date_of_birth" => $this->date_of_birth,
        ];
    }

}
