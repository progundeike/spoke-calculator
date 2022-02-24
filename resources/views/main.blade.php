@extends('layout')

@section('title', '計算')

@section('content')
<div class="container-fluid">

    {{Form::token()}}
    {{ Form::open(['url' => '/length', 'method' => 'post']) }}

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        {{ Form::label('erd', 'ERD') }}
        {{ Form::text('erd', old('erd'),['class' => 'form-control', 'id' => 'erd']) }}
    </div>

    <div class="mb-3">
        {{ Form::label('numberOfSpoke', 'スポークの本数') }}
        {{ Form::number('numberOfSpoke', old('numberOfSpoke'),['class' => 'form-control', 'id' => 'NumberOfSpoke']) }}
    </div>

    <div class="mb-3">
        {{ Form::label('rimOffset', 'リムオフセット') }}
        {{ Form::text('rimOffset', 0,['class' => 'form-control', 'id' => 'RimOffset']) }}
    </div>

    <div class="row">
        <div>PCD</div>
        <div class="mb-3 col-sm-6">
            {{ Form::label('pcdLeft', 'ノンドライブサイド') }}
            {{ Form::text('pcdLeft', old('pcdLeft'),['class' => 'form-control', 'id' => 'pcdLeft']) }}
        </div>
        <div class="mb-3 col-sm-6">
            {{ Form::label('pcdRight', 'ドライブサイド') }}
            {{ Form::text('pcdRight', old('pcdRight'),['class' => 'form-control', 'id' => 'pcdRight']) }}
        </div>
    </div>

    <div class="row">
        <div>センターフランジ間距離</div>
        <div class="mb-3 col-sm-6">
            {{ Form::label('centerFlangeLeft', 'ノンドライブサイド') }}
            {{ Form::text('centerFlangeLeft', old('centerFlangeLeft'),['class' => 'form-control', 'id' => 'centerFlangeLeft']) }}
        </div>
        <div class="mb-3 col-sm-6">
            {{ Form::label('centerFlangeRight', 'ドライブサイド') }}
            {{ Form::text('centerFlangeRight', old('centerFlangeRight'),['class' => 'form-control', 'id' => 'centerFlangeRight']) }}
        </div>
    </div>
    <div class="text-center">
        {{ Form::submit('計算', ['class' => 'btn btn-primary ']) }}
    </div>
    {{ Form::close() }}
</div>
@endsection
