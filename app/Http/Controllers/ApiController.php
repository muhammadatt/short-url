<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    /**
     * Returns a shortened url for a given long url string
     * @param Object $request 
     * @return \Illuminate\Http\Response
     */

    public function shorten(Request $request)
    {

        $url = new Url;
        $url->fill($request->all());

        //Validate that provided url is a valid url format
        $validator = Validator::make(
            $request->all(),
            [
                'original' => ['required', 'url'],
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => ["message" => 'Not a valid url.']], 422);
        }

        //extract the page title from the url
        $url->title = $this->getTitle($url->original);

        if ($url->save()) {

            //Return JSON containing both the shortcode and the original url
            return response()->json($url, 201);

        } else {
            return response()->json(['error' => ["message" => 'Failed to create short url.']], 500);
        }
    }

    /**
     * Receives a shortcode and returns url object that contains the original url
     * @param String $shortcode 
     * @return \Illuminate\Http\Response
     */

    public function resolve($shortcode)
    {

        /**
         * Convert the shortcode from Base62 back to its integer value 
         * and use that to look up the correct database entry.
         */

        $primary_key = Url::convert_base62_to_integer($shortcode);
        $url = Url::find($primary_key);

        if ($url) {

            //Update view count
            $url->view_count++;
            $url->save();

            return response()->json($url, 200);
        } else {
            return response()->json(['error' => ["message" => 'Error: Unable to find the requested URL.']], 404);
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

    public function getTitle($url) {
        $title = '';
        $data = file_get_contents($url);

        //extract title tag
        if ($data) {
            $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : null;
        }
        return $title; 
    }
}
