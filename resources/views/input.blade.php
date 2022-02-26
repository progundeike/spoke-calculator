@extends('layout')

@section('title', 'SpokeCalc')

@section('content')
<div class="container-fluid">

    {{ Form::open(['url' => '/length', 'method' => 'post']) }}
    @csrf
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
        <div class="mb-3">
            {{ Form::label('numberOfSpoke', 'スポークの本数') }}
            {{ Form::number('numberOfSpoke', old('numberOfSpoke'),['class' => 'form-control', 'id' => 'NumberOfSpoke']) }}
        </div>

        <div class="mb-3 col-6">
            {{ Form::label('erd', 'ERD') }}
            {{ Form::text('erd', old('erd'),['class' => 'form-control', 'id' => 'erd']) }}
        </div>

        <div class="mb-3 col-6">
            {{ Form::label('rimOffset', 'リムオフセット') }}
            {{ Form::text('rimOffset', 0,['class' => 'form-control', 'id' => 'RimOffset']) }}
        </div>

        <div>PCD</div>
        <div class="mb-3 col-6">
            {{ Form::label('pcdLeft', 'ノンドライブサイド') }}
            {{ Form::text('pcdLeft', old('pcdLeft'),['class' => 'form-control', 'id' => 'pcdLeft']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('pcdRight', 'ドライブサイド') }}
            {{ Form::text('pcdRight', old('pcdRight'),['class' => 'form-control', 'id' => 'pcdRight']) }}
        </div>

        <div>センターフランジ間距離</div>
        <div class="mb-4 col-6">
            {{ Form::label('centerFlangeLeft', 'ノンドライブサイド') }}
            {{ Form::text('centerFlangeLeft', old('centerFlangeLeft'),['class' => 'form-control', 'id' => 'centerFlangeLeft']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('centerFlangeRight', 'ドライブサイド') }}
            {{ Form::text('centerFlangeRight', old('centerFlangeRight'),['class' => 'form-control', 'id' => 'centerFlangeRight']) }}
        </div>
    </div>
    <div class="text-center mb-3">
        {{ Form::submit('計算', ['class' => 'btn btn-primary ']) }}
    </div>
    {{ Form::close() }}
    </div>
</div>
@endsection
