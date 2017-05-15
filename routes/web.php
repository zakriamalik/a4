<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
# main app route for home page
Route::get('/', 'MortCalcController@index');
# main app route for home page
Route::get('/calc', 'MortCalcController@calculator');
# get route for mortgage payment calculator
Route::get('/process', 'MortCalcController@process');
# get route for readme file
Route::get('/readme', 'MortCalcController@readme');
# get route for mortgage loan scenario landing page
Route::get('/scenario', 'MortCalcController@scenarioMenu');
# get route for real estate property landing page
Route::get('/property', 'MortCalcController@propertyMenu');

# get triple set routes for viewing mortgage loan scenarios from the database - view all or view one at a time
Route::get('/scenario/viewAll', 'MortCalcController@viewAllScenario');
Route::get('/scenario/view', 'MortCalcController@loadScenario');
Route::get('/scenario/view/{id}', 'MortCalcController@viewScenario');

# get triple set routes for viewing real estate properties from the database - view all or view one at a time
Route::get('/property/viewAll', 'MortCalcController@viewAllProperty');
Route::get('/property/view', 'MortCalcController@loadProperty');
Route::get('/property/view/{id}', 'MortCalcController@viewProperty');

# get/post couplet routes to save a mortgage loan scenario to the database with embedded recalculation feature
Route::get('/scenario/save', 'MortCalcController@addScenario');
Route::post('/scenario/save', 'MortCalcController@saveScenario');

# get/post couplet routes to save a real estate property info to the database
Route::get('/property/save', 'MortCalcController@addProperty');
Route::post('/property/save', 'MortCalcController@saveProperty');

# get route to search a mortgage loan scenario from the database
Route::get('/scenario/search', 'MortCalcController@searchScenario');

# get routes to show a list of items for view, add new, update/remoev an existing item
Route::get('/scenario/load', 'MortCalcController@loadScenario');
Route::get('/property/load', 'MortCalcController@loadProperty');
Route::get('/property/loadfeatures', 'MortCalcController@loadFeatures');

# get/post routes triple setup to update an existing mortgage loan scenario in the database
Route::get('/scenario/change', 'MortCalcController@loadScenario');
Route::get('/scenario/update/{id}', 'MortCalcController@selectScenario');
Route::post('/scenario/update', 'MortCalcController@updateScenario');

# get/post routes triple setup to update an existing real estate property listing in the database
Route::get('/property/change', 'MortCalcController@loadProperty');
Route::get('/property/update/{id}', 'MortCalcController@selectProperty');
Route::post('/property/update', 'MortCalcController@updateProperty');

# get/post routes triple setup to remove an existing mortgage loan scenario from the database
Route::get('/scenario/delete', 'MortCalcController@loadScenario');
Route::get('/scenario/remove/{id}', 'MortCalcController@stageRemoval');
Route::post('/scenario/remove', 'MortCalcController@removeScenario');

# get/post routes triple setup to remove an existing real estate property listing from the database
Route::get('/property/delete', 'MortCalcController@loadProperty');
Route::get('/property/remove/{id}', 'MortCalcController@stagePropertyRemoval');
Route::post('/property/remove', 'MortCalcController@removeProperty');

# get routes to show a features tied to an existing real estate property using join pivot table
Route::get('/property/viewfeatures', 'MortCalcController@loadFeatures');
Route::get('/property/viewfeatures/{id}', 'MortCalcController@viewFeatures');

# get/post routes add features to an existing real estate property using join pivot table
Route::get('/property/increasefeatures', 'MortCalcController@loadFeatures');
Route::get('/property/addfeatures/{id}', 'MortCalcController@addFeatures');
Route::post('/property/addfeatures', 'MortCalcController@saveFeatures');

# get/post routes remove features from an existing real estate property using join pivot table
Route::get('/property/decreasefeatures', 'MortCalcController@loadFeatures');
Route::get('/property/removefeature/{id}', 'MortCalcController@removeFeature');
Route::post('/property/removefeature', 'MortCalcController@deleteFeature');

# Reference: The routing techniques are leveraged from class lectures posted on http://dwa15.com/

# conditional log viewer route based on app environment
if(config('app.env')=='local'){
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}
