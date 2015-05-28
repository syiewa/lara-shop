<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model {

    //
    protected $table = 'option_shipping';
    protected $fillable = ['ship_option_name','ship_option_value'];

}
