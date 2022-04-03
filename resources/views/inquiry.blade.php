@extends('layout')

@section('title', 'お問合せ')

@section('content')

<div class="container-fluid">
    <div>
        <h3 class="text-center m-3">このサイトについて</h3>
        <p>これまで、多くのホイールを組んできました。スポーク長の計算や、ハブ、リムの情報管理にエクセルやスプレッドシートを使用しておりましたが、
        これらの管理を煩雑に感じ、一元管理できないものかと、このサイトを作成しました。</p>

        <p>スポーク長の計算だけであれば、ユーザー登録は必要ありません。ユーザー登録をすることで、過去に計算したハブ、リム、スポーク長や備考欄といったデータにアクセスできます。利用料は掛かりません。このサイトがホイール組の手助けになれば幸いです。</p>

        <p>また、スポーク長は、使用するスポークやニップルのブランド、実際のスポークテンションによって変わりますし、どこまでをERDとするかは組み手の考え方によっても変わります。スポーク長の計算結果を保証するものではありませんので、あらかじめご了承ください。</p>

        <p>機能は、順次アップデート中です。不具合、ご要望などございましたら下記のお問合せフォームよりご連絡ください。</p>
        <p>最終更新日:2022 4/4</p>
    </div>

    @if (Session::has('sentMessage'))
        <h3 class='text-center mb-3'>
            {{ session('sentMessage') }}
        </h3>
    @endif
    <div class="card mb-3">
        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-header">お問合せ</div>
        <div class="card-body">
        {{ Form::open(['url' => '/inquiry', 'method' => 'post', 'autocomplete' => 'off']) }}
        {{ Form::token() }}
        {{ Form::label('inquiryName', 'お名前') }}
        {{ Form::text('inquiryName', old('inquiryName'), ['class' => 'form-control mt-1 mb-3', 'id' => 'inquiryName']) }}
        {{ Form::label('email', 'メールアドレス') }}
        {{ Form::email('email', old('email'), ['class' => 'form-control mt-1 mb-3', 'id' => 'email']) }}
        {{ Form::label('inquiryContent', 'お問合せ内容') }}
        {{ Form::textarea('inquiryContent', old('inquiryContent'), ['class' => 'form-control mt-1 mb-3', 'id' => 'inquiryContent', 'rows' => '3']) }}
        <div class="text-center">
            {{ Form::button('送信 <i class="fas fa-paper-plane"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
        </div>
        {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
