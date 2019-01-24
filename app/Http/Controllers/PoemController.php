<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Poem;

class PoemController extends Controller
{
    public function show($id)
    {
		$json = http_get ("https://en.wikipedia.org/api/rest_v1/page/random/summary");
		
		$fullSummary = var_dump(json_decode($json));
		
		$parsedSummary = $fullSummary.length - 1;
		
      $poem = $parsedSummary;//Poem::find($id);
      return view('welcome', array('poem' => $poem));
    }
	
	/*public function show($id)
    {
      $poem = Poem::find($id);
      return view('welcome', array('poem' => $poem));
    }*/
}
