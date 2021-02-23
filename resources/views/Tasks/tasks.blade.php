@if (count($tasks) > 0)
    <ul class="list-unstyled">
        @foreach ($tasks as $task)
            <li class="media mb-3">
                <div class="media-body">
                    <div>
                        <span class="text-muted">posted at {{ $task->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($task->content)) !!}</p>
                        <p class="mb-0">{!! nl2br(e($task->status)) !!}</p>
                    </div>
                    <div>
                        @if(Auth::id() === $task->user_id)
                            {{--投稿削除ボタンのフオーム--}}
                            {!! Form::open(['route'=>['tasks.destroy',$task->id],'method'=>'delete']) !!}
                                {!! Form::submit('Delete',['class'=>'btn btn-danger btn sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif

