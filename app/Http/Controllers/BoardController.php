<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Guzzle dependencie for make request
use GuzzleHttp\Client;

/**
* This controller class make all CRUD operations
*
*/
class BoardController extends Controller
{  
    //class token for get to all opreations
    private $token;
    
    //key application provides for trello
    private $key = "8ca1273dba5f29780127f5a0373f81df";
    
    /**
     * Display a listing all trello boards.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request = null)
    {
        //save token in session
        session(['token' => $request->token]);

        //guzzle client
        $client = new Client();

        //get all borads url
        $url = "https://trello.com/1/member/me/boards?key=$this->key&token=$request->token";

        $response = $client->get($url);
        //decode to array for send to view
        $boards = json_decode(($response->getBody()->getContents()));

        //view boards
        return view("trello.boards", ['boards' => $boards]);
        
    }

    /**
     * Show the form for creating and take a token.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //on that view we manipulate a token
        return view("trello.token");
    }

    /**
     * Store a newly created new card in trello.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get session token
        $this->token = session('token');
        
        //trello url to creates a new card
        $url = "https://api.trello.com/1/cards?".
                "idList=$request->list&".
                "name=$request->name&".
                "key=$this->key&token=$this->token";
        
        $client = new Client();
        $response = $client->post($url);
        
        //after creation this method return to card list
        return back();
    }

    /**
     * Display the card list.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get session token
        $this->token = session('token');

        //get list of cards
        $client = new Client();
        $url = "https://trello.com/1/boards/$id/cards?key=$this->key&token=$this->token";
        $response = $client->get($url);
        $cards = json_decode(($response->getBody()->getContents()));
        
        //get list of list on board
        $url_lists = "https://trello.com/1/boards/$id/lists?key=$this->key&token=$this->token";
        $response = $client->get($url_lists);
        $lists = json_decode(($response->getBody()->getContents()));
        
        //send cards and list to view
        return view("trello.board", ['cards' => $cards, 'lists'=>$lists]);
    }

    /**
     * Update the specified card in trello.
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
     * Remove the specified card in trello.
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
