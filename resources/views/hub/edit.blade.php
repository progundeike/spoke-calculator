@extends('layout')

@section('title', 'ハブデータベース(編集)')

@section('content')

<div class="container-fluid">
    <h1>更新用</h1>
    {{ Form::open(['route' => ['hub.update', $hubData->id], 'method' => 'post', 'autocomplete' => 'off', 'method' => 'put']) }}
    {{ Form::token() }}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="my-3">
            {{ Form::label('symmetry', '左右対称のハブ') }}
            {{ Form::checkbox('symmetry', 'symmetry', false) }}
        </div>
        <div class="mb-3">
            {{ Form::label('hubModel', 'ハブの名称') }}
            {{ Form::text('hubModel', old('hubModel', $hubData->hubModel),['class' => 'form-control', 'id' => 'hubModel']) }}
        </div>
        <div class="mb-3">
            {{ Form::label('hole', 'スポークの本数') }}
            {{ Form::text('hole', old('hole', $hubData->hole),['class' => 'form-control', 'id' => 'hole']) }}
        </div>
        <div>PCD (mm)</div>
        <div class="mb-3 col-6">
            {{ Form::label('pcdL', 'ノンドライブサイド') }}
            {{ Form::text('pcdL', old('pcdL', $hubData->pcdL),['class' => 'form-control', 'id' => 'pcdL']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('pcdR', 'ドライブサイド') }}
            {{ Form::text('pcdR', old('pcdR', $hubData->pcdR),['class' => 'form-control', 'id' => 'pcdR']) }}
        </div>

        <div>センターフランジ間距離 (mm)</div>
        <div class="mb-4 col-6">
            {{ Form::label('centerFlangeL', 'ノンドライブサイド') }}
            {{ Form::text('centerFlangeL', old('centerFlangeL', $hubData->centerFlangeL),['class' => 'form-control', 'id' => 'centerFlangeL']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('centerFlangeR', 'ドライブサイド') }}
            {{ Form::text('centerFlangeR', old('centerFlangeR', $hubData->centerFlangeR),
                ['class' => 'form-control', 'id' => 'centerFlangeR']) }}
        </div>
        <div class="mb-4">
            {{ Form::label('hubMemo', 'メモ欄') }}
            {{ Form::text('hubMemo', old('hubMemo', $hubData->hubMemo), ['class' => 'form-control', 'id' => 'hubMemo']) }}
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="mx-3">
            {{ Form::submit('データを更新', ['class' => 'btn btn-primary']) }}
            {{ Form::hidden('id', $hubData->id) }}
            {{ Form::close() }}
        </div>
        <div class="mx-3">
            {{ Form::open(['route' => ['hub.destroy', $hubData->id], 'method' => 'DELETE', 'autocomplete' => 'off']) }}

            {{ Form::button('<i class="fa-solid fa-trash-can"> 削除</i>', ['class' => 'btn btn-danger', 'id' => $hubData->id, 'type' => 'submit']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
