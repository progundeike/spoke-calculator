@extends('layout')

@section('title', '計算結果')

@section('content')
<div class="container-fluid">
    {{ Form::open(['url' => route('wheel.store'), 'method' => 'post']) }}
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
                    <td>{{ Form::radio('crossL', 'radial', false) }} {{ number_format(session('radialL'), 1) }} mm</td>
                    <td>{{ Form::radio('crossR', 'radial', false) }} {{ number_format(session('radialR'), 1) }} mm</td>
                </tr>
                <tr>
                    <th scope="row">2本組</th>
                    @if (session('hole') >= 8)
                        <td>{{ Form::radio('crossL', 'one', false) }} {{ number_format(session('oneCrossL'), 1) }} mm</td>
                        <td>{{ Form::radio('crossR', 'one', false) }} {{ number_format(session('oneCrossR'), 1) }} mm</td>
                    @else
                        <td colspan="2">できません</td>
                    @endif
                </tr>
                <tr>
                    <th scope="row">4本組</th>
                    @if (session('hole') >= 16)
                        <td>{{ Form::radio('crossL', 'two', false) }} {{ number_format(session('twoCrossL'), 1) }} mm</td>
                        <td>{{ Form::radio('crossR', 'two', false) }} {{ number_format(session('twoCrossR'), 1) }} mm</td>
                    @else
                        <td colspan="2">できません</td>
                    @endif
                </tr>
                <tr>
                    <th scope="row">6本組</th>
                    @if (session('hole') >= 24)
                        <td>{{ Form::radio('crossL', 'three', true) }} {{ number_format(session('threeCrossL'), 1) }} mm</td>
                        <td>{{ Form::radio('crossR', 'three', true) }} {{ number_format(session('threeCrossR'), 1) }} mm</td>
                    @else
                        <td colspan="2">できません</td>
                    @endif
                </tr>
                <tr>
                    <th scope="row">8本組</th>
                    @if (session('hole') >= 32)
                        <td>{{ Form::radio('crossL', 'four', false) }} {{ number_format(session('fourCrossL'), 1)}} mm</td>
                        <td>{{ Form::radio('crossR', 'four', false) }} {{ number_format(session('fourCrossR'), 1)}} mm</td>
                    @else
                        <td colspan="2">できません</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card py-1 mt-3 mb-3">
        <div class="card-body">
            <div class="mb-2">
                <h5>
                    リム : {{ session('rimModel') }} ({{ session('hole') }}H)
                </h5>
                ERD : {{ number_format(session('erd'), 1) }}mm<br>
                オフセット : {{ number_format(session('rimOffset'), 1) }}mm
            </div>
            <div class="mb-1">
                <h5>
                    ハブ : {{ session('hubModel') }}
                    ({{ session('hole') }}H)
                </h5>
                PCD : (左) {{ number_format(session('pcdL'), 1) }}mm, (右) {{ number_format(session('pcdR'), 1) }}mm <br>
                センターフランジ間距離 : (左) {{ number_format(session('centerFlangeL'), 1) }}mm
                , (右) {{ number_format(session('centerFlangeR'), 1) }}mm

            </div>
            @auth
                <div>
                    {{ Form::label('wheelMemo', 'メモ欄' ) }}
                    {{ Form::text('wheelMemo', old('wheelMemo'), ['class' => "form-control", 'id'=> "wheelMemo"]) }}
                </div>
            @endauth
        </div>
    </div>
    @auth
        <div class="text-center mb-3">
            {{ Form::submit('マイデータベースに登録', ['class' => 'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
    @else
        <h5>ユーザー登録をすると、スポーク長の記録や、リム、ハブの情報を次回の計算に使用することができます</h5>
    @endauth
</div>
@endsection
