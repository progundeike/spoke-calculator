@extends('layout')

@section('title', 'ハブデータベース')

@section('content')

<div class="container-fluid">
    <div class="text-center">
        <a href="{{ route('myDatabase.index') }}" class="btn btn-primary mx-3">ホイールのデータベース</a>
        <a href="{{ route('rim.index') }}" class="btn btn-primary mx-3">リムのデータベース</a>
    </div>
    @foreach($lists as $list)
    <div class="card m-3">
        <div class="card-body">
            <H5>
                ハブ: {{ $list->hubModel }} {{ $list->hole }}
            </H5>
            <div>
                PCD <br>
                右: {{ $list->pcdRight }} 、左: {{ $list->pcdLeft }}
            </div>
            <div>
                センターフランジ間距離 <br>
                右: {{ $list->centerFlangeRight }} 、左: {{ $list->centerFlangeLeft }}
            </div>
            <div>
                メモ:
                @if(isset($list->hubMemo))
                    {{ $list->hubMemo }}
                @endif
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
