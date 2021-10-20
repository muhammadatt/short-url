<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;

class UrlController extends Controller
{

    /**
     * Returns a shortened url for a given long url string
     *
     * @return \Illuminate\Http\Response
     */

    public function shorten(Request $request)
    {

        $url = $request->input('url');

        //just return some sample data for now
        return response()->json(
            [
                "original" => $url,
                "short" => 'https://bit.ly/abc123'
            ],
            200
        );
    }


    /**
     * Receives shortened hash and returns the original url
     *
     * @return \Illuminate\Http\Response
     */

    public function resolve($hash)
    {
        //generate a fake url for now
        $url = Url::factory()->make();

        if ($url) {

            //Update view count
            //$url->view_count = $url->view_count + 1;
            //$url->save();

            return response()->json(["url" => $url->original], 200);
        } else {
            return response()->json(['error' => ["message" => 'Url not found.']], 404);
        }
    }

    /**
     * Returns a list of the most frequently visited urls
     *
     * @return \Illuminate\Http\Response
     */

    public function topUrls()
    {
        //generate a fake list of urls for now
        $urls = Url::factory()->count(10)->make();

        return response()->json($urls, 200);
    }
}
