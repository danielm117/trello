<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Guzzle dependencie for make request
use GuzzleHttp\Client;

/**
* Controller class make init for app
*/
class StartController extends Controller
{
     /**
     * Display a init of the Trello Client.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //guzzle client
        $client = new Client();
        
        //autorize url
        $url = "https://trello.com/1/authorize?".
               "callback_method=fragment&expiration=never&".
               "name=TrelloClient&key=8ca1273dba5f29780127f5a0373f81df&".
               "return_url=http://104.198.166.173:8000/trello/token&".
               "scope=read,write&response_type=token";

        // make request
        $trello_authorize = $client->get($url);

        //view of init trello-client
        return view("trello.index", ['url' => $url]);
    }
}
