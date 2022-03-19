@extends('layout')

@section('title', 'マイデータベース')

@section('content')

<div class="container-fluid">
    <h3>ホイールのデータ一覧</h3>
    @if(count($lists) === 0)
        <div>
            まだデータが登録されていません。
        </div>
    @else
    @foreach($lists as $list)
    <div class="card m-3">
            <div class="card-body">
                <div>リム: {{ $list->rimModel }}</div>
                <div>ハブ: {{ $list->hubModel }}</div>
                スポーク長<br>
                ドライブサイド: {{ $list->lengthR }}mm、ノンドライブサイド: {{ $list->lengthL }}mm
                <div class="mb-1">
                メモ欄:
                @if(isset($list->wheelMemo))
                    {{ $list->wheelMemo }}
                @endif
            </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="mt-1">更新日:{{ date('Y/m/d', strtotime($list->updated_at))}}</div>
                    <div>
                        <a href="{{ route('wheel.edit', $list->id) }}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"> 編集</i></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif
</div>

@endsection
