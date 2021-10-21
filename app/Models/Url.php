<?php

namespace App\Models;

use App\Http\Traits\GenerateShortcode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory, GenerateShortcode;

    //allow Mass Assignment of these fields
    protected $fillable = ['original', 'nsfw'];

    protected static function booted()
    {
        //After database entry is created, we'll take the id convert to base62 generate a shortcode 
        //Uses our custom GenerateShortcode Trait
        static::created(function ($url) {

            $url->shortcode = Url::convert_int_to_base62($url->id);
            $url->save();
        });
    }

}
