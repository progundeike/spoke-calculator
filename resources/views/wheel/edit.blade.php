@extends('layout')

@section('title', '編集(ホイール)')

@section('content')

<div class="container-fluid">
    {{ Form::open(['route' => ['wheel.update', $wheel->id], 'method' => 'post', 'autocomplete' => 'off', 'method' => 'put']) }}
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
        <div class="my-1">
            リム: {{ $wheel->rimModel }}
        </div>
        <div class="my-1">
            ハブ: {{ $wheel->hubModel }}
        </div>
        <div class="my-1">
            スポーク長（右）: {{ $wheel->lengthR }} mm
        </div>
        <div class="my-1">
            スポーク長（左）: {{ $wheel->lengthL }} mm
        </div>
        <div class="my-1">
            交差（右）: {{ $wheel->crossR }}
        </div>
        <div class="my-1">
            交差（左）: {{ $wheel->crossL }}
        </div>

        <div class="mb-4 my-1">
            {{ Form::label('wheelMemo', 'メモ:') }}
            {{ Form::text('wheelMemo', old('wheelMemo', $wheel->wheelMemo), ['class' => 'form-control', 'id' => 'wheelMemo']) }}
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="mx-3">
            {{ Form::submit('データを更新', ['class' => 'btn btn-primary']) }}
            {{ Form::hidden('id', $wheel->id) }}
            {{ Form::close() }}
        </div>
        <div class="mx-3">
            {{ Form::open(['route' => ['wheel.destroy', $wheel->id], 'method' => 'DELETE']) }}
            {{ Form::button('<i class="fa-solid fa-trash-can"> 削除</i>', ['class' => 'btn btn-danger', 'id' => $wheel->id, 'type' => 'submit']) }}
            {{ Form::close() }}
        </div>
    </div>
    <div class="my-3">
        ※ホイールのデータはメモのみ編集可能です。<br>
        　ハブ、リムの編集はマイデータベースのそれぞれのリンクから編集してください。<br>
        　ホイールのデータ削除後も、ハブ、リムのデータは各データベースから閲覧できます。<br>
    </div>
</div>


@endsection
