@extends('layout')

@section('title', 'マイデータベース')

@section('content')

<div class="container-fluid">
    @foreach($lists as $list)
    <div class="card m-3">
        <div class="card-body">
        <div>リム: {{ $list->rimModel }}</div>
        <div>ハブ: {{ $list->hubModel }}</div>
        <div>
            スポーク長<br>
            ドライブサイド: {{ $list->lengthR }}mm、ノンドライブサイド: {{ $list->lengthL }}mm
        </div>
        @if(isset($list->wheelMemo))
            <div>
                メモ:{{ $list->wheelMemo }}
            </div>
        @endif
    </div>
    @endforeach
</div>

@endsection
