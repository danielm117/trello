<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;


class BoardController extends Controller
{
private $token = "a5da84e9ff815e4e828c40e825a5eb0a0c2ef3d00fae53c3fbd9cf2eebdfac0e";
   
    private $key = "8ca1273dba5f29780127f5a0373f81df";
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request = null)
    {
        // dd(session()->all());
        // dd($request);
        // $this->getTokenFromUrl();

        $client = new Client();

        $url = "https://trello.com/1/member/me/boards?key=$this->key&token=$this->token";

        $response = $client->get($url);
        // $response = $boards->send();
        $boards = json_decode(($response->getBody()->getContents()));
        // echo "<pre>";
        // print_r($boards);
        // echo "</pre>";

        return view("trello.boards", ['boards' => $boards]);
  

        
    }

    private function getTokenFromUrl(){
        // echo "token";
        // $actual_link = $_SERVER["REQUEST_URI"];
        // print_r($actual_link);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // dd($request->list);
        $url = "https://api.trello.com/1/cards?".
                "idList=$request->list&".
                "name=$request->name&".
                "key=$this->key&token=$this->token";
        // dd($rul);
        $client = new Client();
        $response = $client->post($url);
        return back();
        // dd($request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new Client();
        $url = "https://trello.com/1/boards/$id/cards?key=$this->key&token=$this->token";
        $response = $client->get($url);
        $cards = json_decode(($response->getBody()->getContents()));
        
        
        $url_lists = "https://trello.com/1/boards/$id/lists?key=$this->key&token=$this->token";
        $response = $client->get($url_lists);
        $lists = json_decode(($response->getBody()->getContents()));
        
        return view("trello.board", ['cards' => $cards, 'lists'=>$lists]);

        // dd($id);

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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $url = "https://api.trello.com/1/cards/$id?".
                "idList=$request->list&".
                "name=$request->name&".
                "key=$this->key&token=$this->token";
        // dd($rul);
        $client = new Client();
        $response = $client->put($url);
        return back();

        // dd($id);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $url = "https://api.trello.com/1/cards/$id?key=$this->key&token=$this->token";
        // dd($rul);
        $client = new Client();
        $response = $client->delete($url);
        return back();
        //
    }
}
