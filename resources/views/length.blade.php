@extends('layout')

@section('title', '計算結果')

@section('content')
<div class="container-fluid">
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
                    <td>{{ $radial['L'] }} mm</td>
                    <td>{{ $radial['R'] }} mm</td>
                </tr>
                <tr>
                    <th scope="row">4本組</th>
                    <td>{{ $twoCross['L'] }} mm</td>
                    <td>{{ $twoCross['R'] }} mm</td>
                </tr>
                <tr>
                    <th scope="row">6本組</th>
                    <td>{{ $threeCross['L'] }} mm</td>
                    <td>{{ $threeCross['R'] }} mm</td>
                </tr>
                <tr>
                    <th scope="row">8本組</th>
                    <td>{{ $fourCross['L'] }} mm</td>
                    <td>{{ $fourCross['R'] }} mm</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card py-1 mt-3 mb-3">
        <div class="card-body">
            <div>
                <h5>リム</h5>
                モデル名 ({{ $hole }}H) <br>
                ERD: {{ $erd }}mm <br>
            </div>
            <br>
            <div>
                <h5>ハブ</h5>
                モデル名({{ $hole }}H) <br>
                PCD <br>
                (左): {{ $pcd['L'] }}mm, (右): {{ $pcd['R'] }}mm , <br>
                オフセット {{ $hubOffset }}mm <br>
            </div>
        </div>
    </div>

    <div class="text-center mb-3">
        <div class="btn btn-primary">マイデータベースに登録</div>
    </div>
</div>
@endsection
