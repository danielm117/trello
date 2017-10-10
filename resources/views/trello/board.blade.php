<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Trello Card Manager</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1> Cards </h1>
            </div>
        </div>
        <hr>
        @foreach ($cards as $card)
        <div class="row" style="margin: 10px;" >
            <form action="{{route ('card_update', ['id' => $card->shortLink])}}" method="POST">
            {{csrf_field()}}
                <div class ='{{$card->shortLink}}_Input'">
                    <input name='name' type="text" value="{{$card->name}}" size="{{strlen($card->name)}}">
                    <select class="selectpicker" name="list">
                            @foreach ($lists as $list)
                                @if ($card->idList   == $list->id)
                                <option selected value="{{$list->id}}">{{$list->name}}</option>
                                @else
                                <option value="{{$list->id}}">{{$list->name}}</option>
                                @endif
                            @endforeach
                    </select> 
                    <a href="asd">
                        <button type="submit"  id ="login" class="btn  btn-primary">Edit</button>
                    </a>    
                    <a href="{{route ('card_delete', ['id' => $card->shortLink])}}">
                        <button type="button"  id ="login" class="btn  btn-danger">Delete</button>
                    </a>
                </div>
            </form>
        </div>
        @endforeach
        <div class="row" style="margin: 10px;">
            <form action="{{route ('card_store')}}" method="POST">
            {{csrf_field()}}
                <div>
                    <input name='name' type="text" size="50">
                     <select class="selectpicker" name="list">
                            @foreach ($lists as $list)
                            <option value="{{$list->id}}">{{$list->name}}</option>
                            @endforeach
                    </select> 
                     <a href="asdasdas">
                        <button type="submit"  id ="login" class="btn btn-success">Create</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>