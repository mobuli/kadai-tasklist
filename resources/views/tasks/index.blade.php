@extends('layouts.app')

@section('content')

    <h1>タスク一覧</h1>

    @if (count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>タスク</th>
                    <th>ステータス</th>
                    <th>作成日</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->content }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td><a href="{{ route('tasks.show', ['id' => $task->id]) }}">表示</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif


    {!! link_to_route('tasks.create', 'タスク登録ページへ', [], ['class' => 'btn btn-primary']) !!}
<div class="mt-2">{{ $tasks->links('pagination::bootstrap-4') }}</div>

@endsection