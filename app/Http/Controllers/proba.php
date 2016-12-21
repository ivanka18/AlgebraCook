<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recipe2;
use App\Ingredient;
use Illuminate\Auth\AuthManager;

class RecipesController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function index(Request $request)
	{
		return view ('recipes.index')->with('recipes', Recipe2::get());
	}
	
	public function view($id)
	{
		$recipes = Recipe2::find($id);
		return view('recipes.view', ['recipe'=> $recipes]);
		//return $recipes;
	}
	
	public function add()
	{
		return view('recipes.add');
	}
	
	public function edit($id) {
		return view('recipes.edit')
		->with('recipe', Recipe2::find($id));
	}
	public function update(Request $request)
	{
		$data = $request -> all();
		$recipe = Recipe2::find($data['id']);
		if($recipe->creator_id !== auth()->user()->id)
			return redirect()->action('RecipesController@index');
		foreach($recipe->ingredients as $ingrediant)
		$ingrediant->delete();
		$recipe->name = $data['name'];
		$recipe->description = $data['description'];
		
		if($recipe->save())
		{
			foreach ($data['ingredient'] as $key => $value)
			{
				$sastojak = new Ingredient;
				$sastojak->name = $value;
				$sastojak->recipe2_id = $recipe->id;
				$sastojak->save();
			}
		}
		return redirect()->action('RecipesController@index');
	}
	public function save(Request $request)
	{
		$data = $request->all();
		$noviRecept = new Recipe2;
		$noviRecept->name = $data['name'];
		$noviRecept->description = $data['description'];
		$noviRecept->creator_id = auth()->user()->id;
		
		if($noviRecept->save())
		{
			foreach ($data['ingredient'] as $key=>$value)
			{
				$sastojak = new Ingredient;
				$sastojak->name = $value;
				$sastojak->recipe2_id = $noviRecept->id;
				$sastojak->save();
			}
		}
		return redirect()->action('RecipesController@index');
	}
}
