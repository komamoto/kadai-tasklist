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
                    <td>{{ $task ->id}}</td>
                    <td>{{ $task->content}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
