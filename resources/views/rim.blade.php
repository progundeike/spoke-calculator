@extends('layout')

@section('title', 'リムデータベース')

@section('content')

<div class="container-fluid">
    <div class="text-center">
        <a href="{{ route('myDatabase.index') }}" class="btn btn-primary mx-3">ホイールのデータベース</a>
        <a href="{{ route('hub.index') }}" class="btn btn-primary mx-3">ハブのデータベース</a>
    </div>
    @foreach($lists as $list)
    <div class="card m-3">
        <div class="card-body">
        <H5>
            リム: {{ $list->rimModel }} ({{ $list->hole }} H)
        </H5>
        <div>
            ERD : {{ $list->erd}} mm
        </div>
        <div>
            リムオフセット : {{ $list->rimOffset }} mm
        </div>
        <div class="mb-1">
            穴振り : {{ $list->nippleHoleGap }} mm
        </div>
        <div class="mb-1">
            メモ:
            @if(isset($list->rimMemo))
            {{ $list->rimMemo }}
            @endif
        </div>
        <div>更新日 {{ $list->updated_at}}</div>
    </div>
    @endforeach
    @if(count($lists) === 0)
        <div>
            まだデータが登録されていません。
        </div>
    @endif
</div>

@endsection
