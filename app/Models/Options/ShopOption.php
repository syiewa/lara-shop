<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Model;

class ShopOption extends Model {

    //
    protected $table = 'option_shop';
    protected $fillable = ['shop_opt_name', 'shop_opt_value'];

}
