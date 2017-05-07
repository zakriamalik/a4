<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
        //identify relationship in the the model
        public function properties() {
        # one-to-many relationship between properties and scenarios.
        return $this->belongsTo('App\Property');
        }
}
