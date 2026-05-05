<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TuControlador extends Controller
{
    public function index($id=5)
    {
        return view('test.custom',[ 'id'=>  $id]);
    }
}
