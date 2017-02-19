<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Packages extends Controller
{
    public function downloadPackage(){

    }
    public function getLinks()
    {



    }

    public function listJson()
    {
        $packages = [];
        foreach ($this->getLinks() as $composerName => $link) {
            $packages[$composerName] = array(
                'dev-master' => array(
                    'version' => 'dev-master',
                    'name' => $composerName,
                    'dist' => array(

                        'type' => 'zip',
                        'url' => $link
                    )
                )
            );
        }


        return response()->json([
            'packages' => $packages,
        ]);
    }
    //
}
