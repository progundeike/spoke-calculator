@extends('layout')

@section('title', 'SpokeCalc')

@section('content')
<div class="container-fluid">
    {{ Form::open(['url' => '/length', 'method' => 'post']) }}
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
        <div class="mb-3">
            {{ Form::label('symmetry', '左右対称のホイール') }}
            {{ Form::checkbox('symmetry', 'symmetry', false) }}
        </div>
        <!-- リムの情報 -->
        <div class="my-3">
            {{ Form::label('rimModel', 'リムの名称') }}
            {{ Form::text('rimModel', old('rimModel'),['class' => 'form-control', 'id' => 'rimModel']) }}
            <span class="form-text">
                リムの名称を登録することで、次回の入力時にマイデータベースから引用できます。
            </span>
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

        <!-- ハブの情報 -->
        <div class="my-3">
            {{ Form::label('hubModel', 'ハブの名称') }}
            {{ Form::text('hubModel', old('hubModel'),['class' => 'form-control', 'id' => 'hubModel']) }}
            <span class="form-text">
                ハブの名称を登録することで、次回の入力時にマイデータベースから引用できます。
            </span>
        </div>
        <div>PCD (mm)</div>
        <div class="mb-3 col-6">
            {{ Form::label('pcdLeft', 'ノンドライブサイド') }}
            {{ Form::text('pcdLeft', old('pcdLeft'),['class' => 'form-control', 'id' => 'pcdLeft']) }}
        </div>
        <div class="mb-3 col-6">
            {{ Form::label('pcdRight', 'ドライブサイド') }}
            {{ Form::text('pcdRight', old('pcdRight'),['class' => 'form-control', 'id' => 'pcdRight']) }}
        </div>

        <div>センターフランジ間距離 (mm)</div>
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
        {{ Form::submit('スポーク長計算', ['class' => 'btn btn-primary ']) }}
    </div>
    {{ Form::close() }}
    </div>
</div>
@endsection
