<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
	
        return view('open-ai/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$input = $request->all();
		if(empty($input['body'])){
			return json_encode(['status' => 422,'message' => 'body field is required.']);
		}
		$body = $input['body'];
		try{
	     
			$result = OpenAI::completions()->create([
				'model' => 'text-davinci-003',
				'prompt' => $body,
				'max_tokens' => 1000,
				// 'top_p' => 1.0,
				// 'frequency_penalty' => 0.0,
				// 'presence_penalty' => 0.0,
						 
			]);
			
			return json_encode(['status' => 200,'html' => $result['choices'][0]['text'] ]);
		}catch(\Exception $e){
			return json_encode(['status' => 422,'message' => 'Server error: Please check your internet connection.']);
		}
		 
		 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
