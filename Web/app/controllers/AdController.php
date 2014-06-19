<?php

class TransposedObject {

	public function __construct($array) {
		foreach ($array as $key => $value) {
			$this->$key = $value;
		}
	}
}

class AdController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$testAd = new stdClass();
		$testAd->identifier = UUID::v4();
		$testAd->title = "This is my Title";

		return View::make('AdListView', ['adList' => [$testAd]]);

	}

	public function deleteMultiple()
	{
		$doomed = Input::get('doomed', []);
		DB::transaction(function()
		{
			foreach ($doomed as $id) 
			{
				DB::table('adItems')
					->where('identifier', $id)
					->delete();
				DB::table('adItemFiles')
					->where('adItemIdentifier', $id)
					->delete();
				DB::table('adItemPlatformMaps')
					->where('adItemIdentifier', $id)
					->delete;
			}
		});

		return Redirect::action('AdController@index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$platforms = DB::table('platforms')->get();

		return View::make('AdItemEditView', 
			[
				'item' => null,
				'platforms' => $platforms,
				'files' => []
			]);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		#TODO: Validate

		$adItem = new AdItem();
		$adItem->identifier = UUID::v4();
		$adItem->title = Input::get('title');
		$adItem->storeUrl = Input::get('storeUrl');

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$thisItem = DB::table('adItems')
			->where('identifier', $id)
			->first();

		if ($thisItem==false) {
			return Response::make('Not Found', 404);
		}

		$platforms = DB::table('platforms')->get();

		$selectedPlatforms = DB::table('adItemPlatformMaps')
			->where('adItemIdentifier', $id)
			->pluck('platformIdentifier');

		$files = DB::table('adItemFiles')
			->where('adItemIdentifier', $id)
			->get();


		return View::make('AdItemEditView', 
			[
				'item' => $thisItem, 
				'platforms' => $platforms,
				'files' => $files
			]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}