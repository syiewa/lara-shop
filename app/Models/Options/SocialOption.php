<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Model;

class SocialOption extends Model {

    //
    protected $table = 'option_social';
    protected $fillable = ['social_key', 'social_value'];
    protected $appends = ['logo'];

    public function getLogoAttribute() {
        switch ($this->attributes['social_key']) {
            case 'facebook':
                return '<i class="fa fa-facebook"></i>';
                break;
            case 'twitter':
                return '<i class="fa fa-twitter"></i>';
                break;
            case 'instagram':
                return '<i class="fa fa-instagram"></i>';
                break;
            case 'google+':
                return '<i class="fa fa-google-plus"></i>';
                break;
        }
    }

}
