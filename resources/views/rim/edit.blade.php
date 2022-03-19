@extends('layout')

@section('title', '編集(リム)')

@section('content')

<div class="container-fluid">
    <h1>更新用</h1>
    {{ Form::open(['route' => ['rim.update', $rimData->id], 'method' => 'post', 'autocomplete' => 'off', 'method' => 'put']) }}
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
            {{ Form::text('rimModel', old('rimModel', $rimData->rimModel),['class' => 'form-control', 'id' => 'rimModel']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('hole', 'スポークの本数') }}
            {{ Form::number('hole', old('hole', $rimData->hole),['class' => 'form-control', 'id' => 'hole']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('erd', 'ERD (mm)') }}
            {{ Form::text('erd', old('erd', $rimData->erd),['class' => 'form-control', 'id' => 'erd']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('rimOffset', 'リムオフセット (mm)') }}
            {{ Form::text('rimOffset', old('rimOffset', $rimData->rimOffset),['class' => 'form-control', 'id' => 'RimOffset']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('nippleHoleGap', 'リムの穴振り (mm)') }}
            {{ Form::text('nippleHoleGap', old('nippleHoleGap', 0),['class' => 'form-control', 'id' => 'nippleHoleGap']) }}
        </div>
        <div class="mb-4">
            {{ Form::label('rimMemo', 'メモ欄') }}
            {{ Form::text('rimMemo', old('rimMemo', $rimData->rimMemo), ['class' => 'form-control', 'id' => 'rimMemo']) }}
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="mx-3">
            {{ Form::submit('データを更新', ['class' => 'btn btn-primary']) }}
            {{ Form::hidden('id', $rimData->id) }}
            {{ Form::close() }}
        </div>
        <div class="mx-3">
            {{ Form::open(['route' => ['rim.destroy', $rimData->id], 'method' => 'DELETE', 'autocomplete' => 'off']) }}

            {{ Form::button('<i class="fa-solid fa-trash-can"> 削除</i>', ['class' => 'btn btn-danger', 'id' => $rimData->id, 'type' => 'submit']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection
