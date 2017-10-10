<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class StartController extends Controller
{


/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $url = "https://trello.com/1/authorize";
        
        $params = [
            'expiration' =>  'never',
            'name' =>  'TrelloClient',
            'key' => '8ca1273dba5f29780127f5a0373f81df',
            'return_url' => 'http://soluciona.la/a.php',
            'scope' => 'read,write',
            'response_type' => 'token'
        ];

        $url = "https://trello.com/1/authorize?callback_method=fragment&expiration=never&name=TrelloClient&key=8ca1273dba5f29780127f5a0373f81df&return_url=http://127.0.0.1:8000/trello/boards&scope=read,write&response_type=token";

        // $url = "https://trello.com/1/authorize?expiration=never&name=TrelloMiguel&key=8ca1273dba5f29780127f5a0373f81df&return_url=http://google.com&scope=read,write,account&response_type=token";

        $trello_authorize = $client->get($url);

        // $trello_authorize = $client->request('GET', $url, $params);
        // $trello_authorize = $client->request('GET', 'http://www.example.com/', $params);

        // echo $res->getStatusCode(); // 200
        // echo $trello_authorize->getBody();

        return view("trello.index", ['url' => $url]);
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
        //
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
