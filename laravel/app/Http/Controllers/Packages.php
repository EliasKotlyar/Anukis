<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Packages extends Controller
{
    public function listJson(){
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);
    }
    //
}
