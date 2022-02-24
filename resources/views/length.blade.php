@extends('layout')

@section('title', '計算')

@section('content')
<div class="container-fluid">

    <div class="mt-3 mb-3 text-center">
        <table class="table table-bordered">
            <thread>
                <tr>
                    <th scope="col">  </th>
                    <th scope="col"> ノンドライブサイド </th>
                    <th scope="col"> ドライブサイド </th>
                </tr>
            </thread>
            <tbody>
                <tr>
                    <th scope="row">ラジアル組</th>
                    <td>{{ $radialL }} mm</td>
                    <td>{{ $radialR }} mm</td>
                </tr>
                <tr>
                    <th scope="row">4本組</th>
                    <td>{{ $twoCrossL }} mm</td>
                    <td>{{ $twoCrossR }} mm</td>
                </tr>
                <tr>
                    <th scope="row">6本組</th>
                    <td>{{ $threeCrossL }} mm</td>
                    <td>{{ $threeCrossR }} mm</td>
                </tr>
                <tr>
                    <th scope="row">8本組</th>
                    <td>{{ $fourCrossL }} mm</td>
                    <td>{{ $fourCrossR }} mm</td>
                </tr>
            </tbody>
        </table>
        <div>
            <div class="btn btn-primary">マイデータベースに登録</div>
        </div>
    </div>

</div>
@endsection
