<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

        // protected $appends = ['fullName'];
        // public function getFullNameAttribute() {
        // return '../scenario/update/'. $this->attributes['id'];
        // }

        //identify relationship in the the model
        public function scenarios() {
        # one-to-many relationship between properties and scenarios.
        return $this->hasMany('App\Scenario');
      }

        public function features() {
        # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Feature')->withTimestamps();
      }
}
