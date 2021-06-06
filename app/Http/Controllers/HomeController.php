<?php

namespace App\Http\Controllers;

use App\Utilities\DataStoreHelper;
use App\Utilities\DataStoreJsonWrapper;
use App\Utilities\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return redirect()->route('users');
    }
}
