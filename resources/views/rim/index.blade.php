@extends('layout')

@section('title', 'リムデータベース')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h3>
            リムのデータ一覧
        </h3>
        <a class="btn btn-danger" href="{{ 'rim/create' }}" role="button">新規作成</a>
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
            <div class="d-flex justify-content-between mt-2">
                <div class="mt-1">更新日:{{ date('Y/m/d', strtotime($list->updated_at))}}</div>
                <div>
                    <a href="{{ route('rim.edit', $list->id) }}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"> 編集</i></a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @if(count($lists) === 0)
        <div>
            まだデータが登録されていません。
        </div>
    @endif
</div>

@endsection
