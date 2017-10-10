<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;


class BoardController extends Controller
{  
    private $token;
    
    private $key = "8ca1273dba5f29780127f5a0373f81df";
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request = null)
    {
        session(['token' => $request->token]);

        $client = new Client();

        $url = "https://trello.com/1/member/me/boards?key=$this->key&token=$request->token";

        $response = $client->get($url);
        $boards = json_decode(($response->getBody()->getContents()));

        return view("trello.boards", ['boards' => $boards]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("trello.token");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->token = session('token');
        
        $url = "https://api.trello.com/1/cards?".
                "idList=$request->list&".
                "name=$request->name&".
                "key=$this->key&token=$this->token";
        
        $client = new Client();
        $response = $client->post($url);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->token = session('token');

        $client = new Client();
        $url = "https://trello.com/1/boards/$id/cards?key=$this->key&token=$this->token";
        $response = $client->get($url);
        $cards = json_decode(($response->getBody()->getContents()));
        
        
        $url_lists = "https://trello.com/1/boards/$id/lists?key=$this->key&token=$this->token";
        $response = $client->get($url_lists);
        $lists = json_decode(($response->getBody()->getContents()));
        
        return view("trello.board", ['cards' => $cards, 'lists'=>$lists]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->token = session('token');

        $url = "https://api.trello.com/1/cards/$id?".
                "idList=$request->list&".
                "name=$request->name&".
                "key=$this->key&token=$this->token";
        
        $client = new Client();
        $response = $client->put($url);
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->token = session('token');

        $url = "https://api.trello.com/1/cards/$id?key=$this->key&token=$this->token";
        $client = new Client();
        $response = $client->delete($url);
        
        return back();
    }
}
