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
        

        $url = "https://trello.com/1/authorize?".
               "callback_method=fragment&expiration=never&".
               "name=TrelloClient&key=8ca1273dba5f29780127f5a0373f81df&".
               "return_url=http://104.198.166.173:8000/trello/token&".
               "scope=read,write&response_type=token";


        $trello_authorize = $client->get($url);

        return view("trello.index", ['url' => $url]);
    }
}
