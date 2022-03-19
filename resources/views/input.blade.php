@extends('layout')

@section('title', config('app.name'))

@section('content')
<div class="container-fluid">
    {{ Form::open(['url' => '/length', 'method' => 'post', 'autocomplete' => 'off']) }}
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
            <span class="form-text">
                リムの名称を登録することで、次回の入力時にマイデータベースから引用できます。
            </span>
        </div>

        <!-- リムの情報 -->
        @auth
            <div class="mb-3">
                <div>
                    {{ Form::select('selectRim', App\Http\Controllers\RimController::getMyList(), old('selectRim'), ['class' => 'form-select form-select', 'id' => 'selectRim', 'placeholder' => 'マイデータベースから引用'])}}
                </div>
            </div>
        @endauth

        <div class="mb-3 col-6">
            {{ Form::label('hole', 'スポークの本数') }}
            {{ Form::number('hole', old('hole'),['class' => 'form-control', 'id' => 'hole']) }}
        </div>

        <div class="mb-3 col-6">
            {{ Form::label('erd', 'ERD (mm)') }}
            {{ Form::text('erd', old('erd'),['class' => 'form-control', 'id' => 'erd']) }}
        </div>

        <div class="mb-3 col-6">
            {{ Form::label('rimOffset', 'リムオフセット (mm)') }}
            {{ Form::text('rimOffset', old('rimOffset', 0),['class' => 'form-control', 'id' => 'rimOffset']) }}
        </div>

        <div class="mb-3 col-6">
            {{ Form::label('nippleHoleGap', 'リムの穴振り (mm)') }}
            {{ Form::text('nippleHoleGap', old('nippleHoleGap', 0),['class' => 'form-control', 'id' => 'nippleHoleGap']) }}
        </div>

        <!-- ハブの情報 -->
        <div class="my-3">
            {{ Form::label('hubModel', 'ハブの名称') }}
            {{ Form::text('hubModel', old('hubModel'),['class' => 'form-control', 'id' => 'hubModel']) }}
            <span class="form-text">
                ハブの名称を登録することで、次回の入力時にマイデータベースから引用できます。
            </span>
        </div>
        @auth
            <div class="mb-3">
                <div>
                    {{ Form::select('selectedHub', App\Http\Controllers\HubController::getMyList(), old('selectedHub'), ['class' => 'form-select form-select', 'id' => 'selectedHub', 'placeholder' => 'マイデータベースから引用'])}}
                </div>
            </div>
        @endauth

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
            {{ Form::text('centerFlangeR', old('centerFlangeR'),['class' => 'form-control', 'id' => 'centerFlangeR']) }}
        </div>
    </div>
    <div class="text-center mb-3">
        {{ Form::submit('スポーク長計算', ['class' => 'btn btn-primary ']) }}
    </div>
    {{ Form::close() }}
    </div>
</div>
<!-- <script src="{{ mix('js/autoFormInput.js') }}"></script> -->
<script>
//autoFormInput
$('#selectRim').change(function() {
    var selectedRim = $(this).val();
    $.ajax({
        type: "POST",
        url: "{{ route('rim.input') }}",
        data: {
            "selectedRim" : selectedRim,
            "_token":"{{ csrf_token() }}"
        },
        dataType: "json"
    }).done(function(data) {
        //成功の処理
        $('#hole').val(data.hole);
        $('#erd').val(data.erd);
        $('#rimOffset').val(data.rimOffset);
        $('#nippleHoleGap').val(data.nippleHoleGap);
    }).fail(function(){
        //エラーの処理
        alert('データベースに不具合が発生しました。手動での入力をお願い致します。')
    });
});

$('#selectedHub').change(function() {
    var selectedHub = $(this).val();
    $.ajax({
        type: "POST",
        url: "{{ route('hub.input') }}",
        data: {
            "selectedHub" : selectedHub,
            "_token":"{{ csrf_token() }}"
        },
        dataType: "json"
    }).done(function(data) {
        //成功の処理
        $('#centerFlangeR').val(data.centerFlangeR);
        $('#centerFlangeL').val(data.centerFlangeL);
        $('#pcdR').val(data.pcdR);
        $('#pcdL').val(data.pcdL);
    }).fail(function(){
        //エラーの処理
        alert('データベースに不具合が発生しました。手動での入力をお願い致します。')
    });
});

</script>
@endsection
