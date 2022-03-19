@extends('layout')

@section('title', '新規作成(ハブ)')

@section('content')

<div class="container-fluid">
    {{ Form::open(['url' => 'hub', 'method' => 'post', 'autocomplete' => 'off']) }}
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
            {{ Form::text('hubModel', old('hubModel'),['class' => 'form-control', 'id' => 'hubModel']) }}
        </div>
        <div class="mb-3">
            {{ Form::label('hole', 'スポークの本数') }}
            {{ Form::text('hole', old('hole'),['class' => 'form-control', 'id' => 'hole']) }}
        </div>
        <div>PCD (mm)</div>
        <div class="mb-3 col-6">
            {{ Form::label('pcdL', 'ノンドライブサイド') }}
            {{ Form::text('pcdL', old('pcdL'),['class' => 'form-control', 'id' => 'pcdL']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('pcdR', 'ドライブサイド') }}
            {{ Form::text('pcdR', old('pcdR'),['class' => 'form-control', 'id' => 'pcdR']) }}
        </div>

        <div>センターフランジ間距離 (mm)</div>
        <div class="mb-4 col-6">
            {{ Form::label('centerFlangeL', 'ノンドライブサイド') }}
            {{ Form::text('centerFlangeL', old('centerFlangeL'),['class' => 'form-control', 'id' => 'centerFlangeL']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('centerFlangeR', 'ドライブサイド') }}
            {{ Form::text('centerFlangeR', old('centerFlangeR'),
                ['class' => 'form-control', 'id' => 'centerFlangeR']) }}
        </div>
        <div class="mb-4">
            {{ Form::label('hubMemo', 'メモ欄') }}
            {{ Form::text('hubMemo', old('hubMemo'), ['class' => 'form-control', 'id' => 'hubMemo']) }}
        </div>
    </div>
    <div class="text-center mb-3">
        {{ Form::submit('データを保存', ['class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}
</div>

@endsection
