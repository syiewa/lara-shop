<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Model;

class GeneralOption extends Model {

    //
    protected $table = 'option_general';
    protected $fillable = ['gen_store_name', 'gen_store_value'];

}
