@extends('layouts.app')

@section('contents')


    <h1>task一覧</h1>
    
    @if(count($tasks) > 0 )
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>メッセージ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{!! link_to_route('tasks.show',$task->id,['task'=>$task->id]) !!}</td>
                    <td>{{ $task->content }}</td>
                    <td>{{ $task->status }}</td>
                </tr>
                <tr>
                    <td>{{ $task ->id}}</td>
                    <td>{{ $task->content}}</td>
                    <td>{{ $task->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    {!! link_to_route('tasks.create','新規',['class'=>'btn btn primary']) !!}
    
    
@endsection
