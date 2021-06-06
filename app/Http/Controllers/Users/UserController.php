<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller {

    public function index() {
        return view('users.index');
    }

    public function store() {
        return view('users.store');
    }

    public function show($id) {
        return view('users.show', ['id' => $id]);
    }

    public function update($id) {
        return view('users.update', ['id' => $id]);
    }

}
