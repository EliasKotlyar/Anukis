<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use GrahamCampbell\Bitbucket\Facades\Bitbucket;

class Packages extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */

    public function downloadPackage($id)
    {
        $package = Package::findOrFail($id);
        $url = $package->url;


        $browser = new \Buzz\Browser();
        // Add Bitbucket Credentials:
        $browser->addListener(Bitbucket::connection('main')->getClient()->getListener("basicauth"));
        $response = $browser->get($url);

        echo $response->getContent();


    }


    public function listJson()
    {
        $packages = [];
        foreach (Package::all() as $entry) {
            $composerName = $entry->composername;
            $link = action('Packages@downloadPackage', ['id' => $entry->id]);


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
