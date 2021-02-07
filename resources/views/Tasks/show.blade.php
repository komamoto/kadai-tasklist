@extends('layouts.app')


@section('content')

    <h1>id={{ $task->id}}のメッセージ</h1>
    
    <table class="table table-borderred">
        <tr>
            <th>id</th>
            <td>{{ $task->id}}</td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td>{{ $task->content}}</td>
        </tr>
        <tr>
            <th>id</th>
            <td>{{ $task->status}}</td>
        </tr>
    </table>
    {!! link_to_route('tasks.edit', 'このメッセージを編集', ['task' => $task->id],['class'=>'btn btn-light']) !!} 
    {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection
