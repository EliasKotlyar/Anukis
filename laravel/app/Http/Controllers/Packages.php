<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use GrahamCampbell\Bitbucket\Facades\Bitbucket;

class Packages extends Controller
{
    public function downloadPackage()
    {


    }

    public function getLinks()
    {
        ;
        $retArray = array();
        foreach (Package::all() as $entry) {
            $retArray[$entry->composername] = $entry->url;
        }
        return $retArray;


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
