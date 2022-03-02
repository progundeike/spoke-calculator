@extends('layout')

@section('title', '計算結果')

@section('content')
<div class="container-fluid">
    {{ Form::open(['url' => route('myDatabase.store'), 'method' => 'post']) }}
    {{ Form::token() }}
    <div class="mt-3 mb-3 text-center">
        <table class="table table-bordered">
            <thread>
                <tr>
                    <th scope="col">  </th>
                    <th scope="col"> ノンドライブサイド (左) </th>
                    <th scope="col"> ドライブサイド (右) </th>
                </tr>
            </thread>
            <tbody>
                <tr>
                    <th scope="row">ラジアル組</th>

                    <td>{{ Form::radio('crossL', 'one', false) }} {{ number_format($radialL, 1) }} mm</td>
                    <td>{{ Form::radio('crossR', 'one', false) }} {{ number_format($radialR, 1) }} mm</td>
                </tr>
                <tr>
                    <th scope="row">4本組</th>
                    <td>{{ Form::radio('crossL', 'two', false) }} {{ number_format($twoCrossL, 1) }} mm</td>
                    <td>{{ Form::radio('crossR', 'two', false) }} {{ number_format($twoCrossR, 1) }} mm</td>
                </tr>
                <tr>
                    <th scope="row">6本組</th>
                    <td>{{ Form::radio('crossL', 'three', true) }} {{ number_format($threeCrossL, 1) }} mm</td>
                    <td>{{ Form::radio('crossR', 'three', true) }} {{ number_format($threeCrossR, 1) }} mm</td>
                </tr>
                <tr>
                    <th scope="row">8本組</th>
                    <td>{{ Form::radio('crossL', 'four', false) }} {{ number_format($fourCrossL, 1)}} mm</td>
                    <td>{{ Form::radio('crossR', 'four', false) }} {{ number_format($fourCrossR, 1)}} mm</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card py-1 mt-3 mb-3">
        <div class="card-body">
            <div class="mb-2">
                <h5>
                    リム : {{ $rimModel }}
                    {{ Form::hidden('rimModel', $rimModel) }}
                    ({{ $hole }}H){{ Form::hidden('hole', $hole) }}
                </h5>
                ERD : {{ number_format($erd, 1) }}mm<br>
                オフセット : {{ number_format($rimOffset, 1) }}mm
            </div>
            <div class="mb-1">
                <h5>
                    ハブ : {{ $hubModel }}
                    {{ Form::hidden('hubModel', $hubModel) }}
                    ({{ $hole }}H)
                </h5>
                PCD : (左) {{ number_format($pcd['L'], 1) }}mm, (右) {{ number_format($pcd['R'], 1) }}mm <br>
                センターフランジ間距離 : (左) {{ number_format($flangeDistance['L'], 1) }}mm
                , (右) {{ number_format($flangeDistance['R'], 1) }}mm
            </div>
            <div>
                {{ Form::label('wheelMemo', 'メモ欄' ) }}
                {{ Form::text('wheelMemo', old('wheelMemo'), ['class' => "form-control", 'id'=> "wheelMemo"]) }}
            </div>
        </div>
    </div>

    <div class="text-center mb-3">
        {{ Form::submit('マイデータベースに登録', ['class' => 'btn btn-primary']) }}
        <div class="btn btn-secondary">入力を修正(未実装)</div>
    </div>
    {{ Form::hidden('radialR', $radialR) }}
    {{ Form::hidden('radialL', $radialL) }}
    {{ Form::hidden('twoCrossR', $twoCrossR) }}
    {{ Form::hidden('twoCrossL', $twoCrossL) }}
    {{ Form::hidden('threeCrossR', $threeCrossR) }}
    {{ Form::hidden('threeCrossL', $threeCrossL) }}
    {{ Form::hidden('fourCrossR', $fourCrossR) }}
    {{ Form::hidden('fourCrossL', $fourCrossL) }}
    {{ Form::close() }}
</div>
@endsection
