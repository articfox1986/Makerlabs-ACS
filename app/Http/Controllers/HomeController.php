<?php namespace App\Http\Controllers;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $details = array();

        $variables = \App\ParticleVariable::where('device_id', '=','4')->get();
        foreach ($variables as $variable)
        {
            $reading = \App\ParticleReading::where('variable_id', '=',$variable->id)->orderBy('id','DESC')->first();
            $details[$variable->name] = $reading->value;
        }

//var_dump($details);

		return view('home')->with('details', $details);
	}

}
