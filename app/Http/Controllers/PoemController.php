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
	
	/**
     * Create a new poem instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate the request...

        $poem = new Poem;

        $poem->text = $request->text;

        $poem->save();
		
		return view('welcome');
    }
}
