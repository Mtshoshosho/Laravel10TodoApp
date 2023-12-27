@extends('layouts.app')

@section('title', 'タスク一覧')

@section('content')
    {{-- @if (count($tasks)) --}}
    <div>タスクを選択</div>
    @forelse ($tasks as $task)
        <a href="{{ route('tasks.show', ['id' => $task->id]) }}">
            <h3>{{ $task->title }}</h3>
        </a>
    @empty
        <div>There are no tasks!</div>
    @endforelse
    {{-- @endif --}}
@endsection
