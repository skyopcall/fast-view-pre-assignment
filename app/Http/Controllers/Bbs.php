<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Bbs extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

}