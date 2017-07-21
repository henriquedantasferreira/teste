<html>
    <head></head>

    <body>
        <div>
            <h1>create a new index... </h1>
            {{ Form::open(array('url' => 'addindexels'))}}
                {{Form::label('Index:')}}
                {{Form::text('el_index')}}
                {{Form::label('Type:')}}
                {{Form::text('el_type')}}
                {{Form::label('Id:')}}
                {{Form::text('el_id')}}
                {{Form::label('Body:')}}
                {{Form::text('el_body')}}
                {{Form::submit('Post')}}
            {{ Form::close() }}
        </div>

        <div>
            <h1>search my listed indexes... </h1>
            {{ Form::open(array('url' => 'searchindexls'))}}
                {{Form::label('Index to search:')}}
                {{Form::text('el_searchindex')}}
                {{Form::submit('Search')}}
            {{ Form::close() }}
        </div>

        <div>
            <h1>delete my current indexes... </h1>
            {{ Form::open(array('url' => 'deleteindexls'))}}
                {{Form::label('Index to delete:')}}
                {{Form::text('el_deleteindex')}}
                {{Form::submit('Delete')}}
            {{ Form::close() }}
        </div>
    </body>

</html>