<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model {

    //
    protected $table = 'option_payment';
    protected $fillable = ['payment_type', 'payment_status','payment_description'];
    protected $appends = ['is_status'];

    public function getIsStatusAttribute() {
        if ($this->attributes['payment_status'] == 1) {
            return 'Enable';
        } return 'Disable';
    }

}
