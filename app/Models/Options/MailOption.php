<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Model;

class MailOption extends Model {

    //
    protected $table = 'option_mail';
    protected $fillable = ['mail_key', 'mail_value'];

}
