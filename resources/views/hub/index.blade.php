@extends('layout')

@section('title', 'ハブデータベース')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h3>
            ハブのデータ一覧
        </h3>
        <a class="btn btn-danger" href="{{ 'hub/create' }}" role="button">新規作成</a>
    </div>
    @foreach($lists as $list)
    <div class="card m-3">
        <div class="card-body">
            <H5>
                ハブ: {{ $list->hubModel }} {{ $list->hole }}
            </H5>
            <div>
                PCD <br>
                右: {{ $list->pcdR }} 、左: {{ $list->pcdL }}
            </div>
            <div>
                センターフランジ間距離 <br>
                右: {{ $list->centerFlangeR }} 、左: {{ $list->centerFlangeL }}
            </div>
            <div>
                メモ:
                @if(isset($list->hubMemo))
                    {{ $list->hubMemo }}
                @endif
            </div>
            <div class="d-flex justify-content-between mt-2">
                <div class="mt-1">更新日:{{ date('Y/m/d', strtotime($list->updated_at)) }}</div>
                <div>
                    <a href="" class="btn btn-success"><i class="fa-solid fa-pen-to-square"> 編集</i></a>
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
