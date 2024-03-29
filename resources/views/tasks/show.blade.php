@extends('layouts.app')

@section('content')

    <h1>詳細画面</h1>

    <table class="table table-bordered">
        <tr>
            <th>タスク</th>
            <td>{{ $task->content }}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{ $task->status }}</td>
        </tr>
    </table>

    {!! link_to_route('tasks.edit', 'このタスクを編集', ['id' => $task->id], ['class' => 'btn btn-light']) !!}

    {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('このタスクを削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection