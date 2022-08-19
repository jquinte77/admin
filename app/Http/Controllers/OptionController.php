<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    private $options;
    function __construct(){
        $this->options = Option::where('bweb','1')->get();
    }

    public function index(){
        $options = $this->options;
        // return $options->first->webrutas;
        return view('dashboard',compact('options'));
    }
}
