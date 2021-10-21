<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /**
     * Displays a the form to shorten a URL
     *
     * @return \Illuminate\Http\Response
     */
    public function main(){
        return view('home/main'); 
    }

    /**
     * Displays a list of the most frequently visited urls
     *
     * @return \Illuminate\Http\Response
     */

    public function top(){

        return view('home/top'); 

    }

    /**
     * Displays a loading page and forwards to the final url
     *
     * @return \Illuminate\Http\Response
     */
    public function resolve($shortcode){

        return view('home/loader', ['shortcode' => $shortcode]); 

    }
}
