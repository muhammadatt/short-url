<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{

    /**
     * Returns a shortened url for a given long url string
     *
     * @return \Illuminate\Http\Response
     */

    public function shorten(Request $request)
    {

        $url = new Url;
        $url->original = $request->input('url');
        $url->save();

        if ($url) {

            return response()->json(
                [
                    "original" => $url->original,
                    "short" => url("{$url->shortcode}")
                ],
                201
            );

        } else {
            return response()->json(['error' => ["message" => 'Failed to create url.']], 500);
        }
    }

    /**
     * Receives shortened hash and returns the original url
     *
     * @return \Illuminate\Http\Response
     */

    public function resolve($shortcode)
    {

        $url = Url::where('shortcode', $shortcode)->first();

        if ($url) {

            //Update view count
            $url->view_count++;
            $url->save();

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

        //Return the 100 most frequently viewed URLs
        $urls = DB::table('urls')->orderBy('view_count', 'DESC')->limit(100)->get();

        if ($urls) {

            return response()->json($urls, 200);

        } else {

            return response()->json(['error' => ["message" => 'Unable to find urls.']], 500);
        }
        
    }
}
