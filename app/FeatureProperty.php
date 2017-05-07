<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureProperty extends Model
{
    //
    public function properties() {
    # one-to-many relationship between properties and feature_property.
    return $this->belongsTo('App\Property');
    }

    public function features() {
    # one-to-many relationship between features and feature_property.
    return $this->belongsTo('App\Feature');
    }

    protected $table = 'feature_property';
    #forcing model to recognise the table: https://laravel.com/docs/5.4/eloquent#eloquent-model-conventions
}
