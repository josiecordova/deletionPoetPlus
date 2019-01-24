<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Poem;

class PoemController extends Controller
{
    public function show($id)
    {		
      $poem = Poem::find($id);
      return view('welcome', array('poem' => $poem));
    }
	
	/*public function show($id)
    {
      $poem = Poem::find($id);
      return view('welcome', array('poem' => $poem));
    }*/
}
