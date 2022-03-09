@extends('layout')

@section('title', '新規作成(ハブ)')

@section('content')

<div class="container-fluid">
    {{ Form::open(['url' => 'rim', 'method' => 'post']) }}
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
            {{ Form::label('rimModel', 'リムの名称') }}
            {{ Form::text('rimModel', old('rimModel'),['class' => 'form-control', 'id' => 'rimModel']) }}
        </div>
        <div class="mb-3">
            {{ Form::label('hole', 'スポークの本数') }}
            {{ Form::number('hole', old('hole'),['class' => 'form-control', 'id' => 'hole']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('erd', 'ERD (mm)') }}
            {{ Form::text('erd', old('erd'),['class' => 'form-control', 'id' => 'erd']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('rimOffset', 'リムオフセット (mm)') }}
            {{ Form::text('rimOffset', 0,['class' => 'form-control', 'id' => 'RimOffset']) }}
        </div>
        <div class="mb-4">
            {{ Form::label('rimMemo', 'メモ欄') }}
            {{ Form::text('rimMemo', old('rimMemo'), ['class' => 'form-control', 'id' => 'rimMemo']) }}
        </div>
    </div>
    <div class="text-center mb-3">
        {{ Form::submit('データを登録', ['class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}
</div>

@endsection
