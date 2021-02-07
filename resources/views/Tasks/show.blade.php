@extends('layouts.app')


@section('contents')

    <h1>id={{ $task->id}}のメッセージ</h1>
    
    <table class="table table-borderred">
        <tr>
            <th>id</th>
            <td>{{ $task->id}}</td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td>{{ $task->content}}</td>
            <td>{{ $task->status}}</td>
        </tr>
    </table>
    {!! link_to_route('tasks.edit', 'このメッセージを編集', ['task' => $task->id], 
    {!! Form::model($task, ['route' => ['Tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection
