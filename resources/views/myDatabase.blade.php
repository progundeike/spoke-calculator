@extends('layout')

@section('title', 'マイデータベース')

@section('content')

<div class="container-fluid">
    <div class="text-center">
        <a href="{{ route('rim.index') }}" class="btn btn-primary mx-3">リムのデータベース</a>
        <a href="{{ route('hub.index') }}" class="btn btn-primary mx-3">ハブのデータベース</a>
    </div>
    @foreach($lists as $list)
    <div class="card m-3">
            <div class="card-body">
                <div>リム: {{ $list->rimModel }}</div>
                <div>ハブ: {{ $list->hubModel }}</div>
                スポーク長<br>
                ドライブサイド: {{ $list->lengthR }}mm、ノンドライブサイド: {{ $list->lengthL }}mm
                @if(isset($list->wheelMemo))
                    <div>
                        メモ:{{ $list->wheelMemo }}
                    </div>
                @endif
                <div class="mt-1">{{ $list->updated_at}}</div>
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
