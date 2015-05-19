<?php namespace App\Models\Widget;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model {

	//
    protected $table = 'slideshow';
    protected $fillable = ['ss_name','ss_description','ss_status','ss_url','ss_order','ss_image'];

}
