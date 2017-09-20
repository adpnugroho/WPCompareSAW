<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sync;
class TestController extends Controller
{
    public function test(){
        Sync::SyncVectorVWP();
    }
}
