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

# main app routes
Route::get('/', 'MortCalcController@index');
Route::get('/process', 'MortCalcController@process');
Route::get('/readme', 'MortCalcController@readme');


Route::get('/scenario', 'MortCalcController@scenarioMenu');
Route::get('/property', 'MortCalcController@propertyMenu');

Route::get('/scenario/viewAll', 'MortCalcController@viewAllScenario');
Route::get('/scenario/view', 'MortCalcController@loadScenario');
Route::get('/scenario/view/{id}', 'MortCalcController@viewScenario');

Route::get('/property/viewAll', 'MortCalcController@viewAllProperty');
Route::get('/property/view', 'MortCalcController@loadProperty');
Route::get('/property/view/{prop_id}', 'MortCalcController@viewProperty');

Route::get('/scenario/save', 'MortCalcController@addScenario');
Route::post('/scenario/save', 'MortCalcController@saveScenario');

Route::get('/property/save', 'MortCalcController@addProperty');
Route::post('/property/save', 'MortCalcController@saveProperty');

Route::get('/scenario/search', 'MortCalcController@searchScenario');
# Get route to show a form to edit an existing scenario
Route::get('/scenario/load', 'MortCalcController@loadScenario');
Route::get('/property/load', 'MortCalcController@loadProperty');

Route::get('/scenario/change', 'MortCalcController@loadScenario');
Route::get('/scenario/update/{scenario_number}', 'MortCalcController@selectScenario');
Route::post('/scenario/update', 'MortCalcController@updateScenario');

Route::get('/property/change', 'MortCalcController@loadProperty');
Route::get('/property/update/{prop_id}', 'MortCalcController@selectProperty');
Route::post('/property/update', 'MortCalcController@updateProperty');

Route::get('/scenario/delete', 'MortCalcController@loadScenario');
# Get route to confirm removal of scenario from the database
Route::get('/scenario/remove/{id}', 'MortCalcController@stageRemoval');
# Post route to actually remove the scenario
Route::post('/scenario/remove', 'MortCalcController@removeScenario');

Route::get('/property/delete', 'MortCalcController@loadProperty');
# Get route to confirm removal of scenario from the database
Route::get('/property/remove/{prop_id}', 'MortCalcController@stagePropertyRemoval');
# Post route to actually remove the scenario
Route::post('/property/remove', 'MortCalcController@removeProperty');


# conditional log viewer route based on app environment
if(config('app.env')=='local'){
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}

#Test if DB is working
Route::get('/debug', function() {

	echo '<pre>';

	echo '<h1>Environment</h1>';
	echo App::environment().'</h1>';

	echo '<h1>Debugging?</h1>';
	if(config('app.debug')) echo "Yes"; else echo "No";

	echo '<h1>Database Config</h1>';
    	echo 'DB defaultStringLength: '.Illuminate\Database\Schema\Builder::$defaultStringLength;
    	/*
	The following commented out line will print your MySQL credentials.
	Uncomment this line only if you're facing difficulties connecting to the database and you
        need to confirm your credentials.
        When you're done debugging, comment it back out so you don't accidentally leave it
        running on your production server, making your credentials public.
        */
	//print_r(config('database.connections.mysql'));

	echo '<h1>Test Database Connection</h1>';
	try {
		$results = DB::select('SHOW DATABASES;');
		echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
		echo "<br><br>Your Databases:<br><br>";
		print_r($results);
	}
	catch (Exception $e) {
		echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
	}

	echo '</pre>';

});
