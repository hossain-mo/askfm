<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous"
          rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<h1>{{$user .'  '}}profile</h1>
<form action="{{URL::to('/AskQ')}}" method="post">
    <div class="form-group ">
        <label >Ask Question</label>
        <input class="form-control" type="text" name="content" id="email" value="let a question" >
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="username" value="{{$user}}">
    <button type="submit" class="btn btn-primary">Ask</button>
</form>

@if(count($questions)>0)
    @foreach($questions as $question)
        <div>
            <p>{{$question->content}}</p>
            <p>
            @if ($question->replay)
                {{$question->replay}}
            @endif
            @if(!$question->replay && Auth::id())
                <form action="{{URL::to('/replay')}}" method="post">
                    <input type="text" name="content" id="email" value="replay" >
                    <input type="hidden" name="id" value="{{$question->id}}">
                    <input type="hidden" name="username" value="{{$user}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary">publish</button>
                </form>
                @endif
                </p>
        </div>
    @endforeach
@endif
@if(count($people)>0 && Auth::id())
     <h1>people you may know</h1>
     @foreach($people as $person)
        <form method="POST" action="{{ URL::to('addFriend') }}" >
            @csrf
                <lable for="name">{{ $person->username }}</lable>
                    <input  type="hidden" name="id" value="{{$person->id}}" >
                   <button type="submit" class="btn btn-primary">{{ __('addFriend') }}</button>
                  <br>
                  <br>

        </form>
     @endforeach
@endif
@if(count($people)==0)
    <h1>No people you may know Yet</h1>
@endif
</body>
</html>
