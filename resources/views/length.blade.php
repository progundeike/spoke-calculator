@extends('layout')

@section('title', '計算結果')

@section('content')
<div class="container-fluid">
    {{ Form::open(['url' => route('wheel.store'), 'method' => 'post', 'id' => 'radio']) }}
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
                    <td>{{ Form::radio('crossL', 'ラジアル組', true) }} {{ number_format(session('radialL'), 1) }} mm</td>
                    <td>{{ Form::radio('crossR', 'ラジアル組', true) }} {{ number_format(session('radialR'), 1) }} mm</td>
                </tr>
                <tr>
                    <th scope="row">2本組</th>
                    @if (session('hole') >= 8)
                        <td>{{ Form::radio('crossL', '2本組', false) }} {{ number_format(session('oneCrossL'), 1) }} mm</td>
                        <td>{{ Form::radio('crossR', '2本組', false) }} {{ number_format(session('oneCrossR'), 1) }} mm</td>
                    @else
                        <td colspan="2">できません</td>
                    @endif
                </tr>
                <tr>
                    <th scope="row">4本組</th>
                    @if (session('hole') >= 16)
                        <td>{{ Form::radio('crossL', '4本組', false) }} {{ number_format(session('twoCrossL'), 1) }} mm</td>
                        <td>{{ Form::radio('crossR', '4本組', false) }} {{ number_format(session('twoCrossR'), 1) }} mm</td>
                    @else
                        <td colspan="2">できません</td>
                    @endif
                </tr>
                <tr>
                    <th scope="row">6本組</th>
                    @if (session('hole') >= 24)
                        <td>{{ Form::radio('crossL', '6本組', false) }} {{ number_format(session('threeCrossL'), 1) }} mm</td>
                        <td>{{ Form::radio('crossR', '6本組', false) }} {{ number_format(session('threeCrossR'), 1) }} mm</td>
                    @else
                        <td colspan="2">できません</td>
                    @endif
                </tr>
                <tr>
                    <th scope="row">8本組</th>
                    @if (session('hole') >= 32)
                        <td>{{ Form::radio('crossL', '8本組', false) }} {{ number_format(session('fourCrossL'), 1)}} mm</td>
                        <td>{{ Form::radio('crossR', '8本組', false) }} {{ number_format(session('fourCrossR'), 1)}} mm</td>
                    @else
                        <td colspan="2">できません</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="card-body">
            <div>
                <h3>スポークテンションの左右差</h3>
                <div>
                    ノンドライブサイド(<span id="left">ラジアル組</span>)のスポークテンションは<br>
                    ドライブサイド(<span id="right">ラジアル組</span>)の
                    <span class="h4 font-weight-bold text-danger" id="tensionDiff"></span>
                    <span class="h4 font-weight-bold text-danger">%</span>
                    です。
                </div>
            </div>
        </div>
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
<script>
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$("#radio").change(function() {
    var leftCross = $('input:radio[name="crossL"]:checked').val();
    var rightCross = $('input:radio[name="crossR"]:checked').val();
    $('#left').text(leftCross);
    $('#right').text(rightCross);

    $.ajax({
        type: "POST",
        url: "/tensionDiff",
        data: {
                "leftCross" : leftCross,
                "rightCross" : rightCross,
                },
        dataType: "json"
    }).done(function(data) {
        //成功の処理
        $('#tensionDiff').text(data);
    }).fail(function(){
        //エラーの処理
        alert('error');
    });
});

$(function() {
    var leftCross = $('input:radio[name="crossL"]:checked').val();
    var rightCross = $('input:radio[name="crossR"]:checked').val();
    $('#left').text(leftCross);
    $('#right').text(rightCross);

    $.ajax({
        type: "POST",
        url: "/tensionDiff",
        data: {
                "leftCross" : leftCross,
                "rightCross" : rightCross,
                },
        dataType: "json"
    }).done(function(data) {
        //成功の処理
        $('#tensionDiff').text(data);
    }).fail(function(){
        //エラーの処理
        alert('error');
    });
});
</script>
@endsection
