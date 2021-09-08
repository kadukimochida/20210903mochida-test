@extends('layouts.parent')

<style>

  h1 {
    text-align: center;
  }

  .search {
    border: solid 1px black;
    margin: 30px;
  }

  .search p {
    display: inline-block;
  }

  .name-gender {
    display: flex;
  }

  .name-gender,
  .created-at,
  .email {
    padding: 20px;
  }

  .ttl {
    font-weight: bold;
    width: 150px;
  }

  .gender .ttl {
    margin-left: 20px;
  }

  .text {
    height: 40px;
    width: 200px;
    border: solid 1px #c0c0c0;
    border-radius: 5px;
  }

  .reset,
  .submit {
    display: inline-block;
    margin: auto;
  }

  .submit {
    width: 100px;
    height: 30px;
    color: white;
    background-color: black;
    border: none;
    border-radius: 5px;
  }


  .button {
    display: flex;
    flex-direction: column;
  }

  svg.w-5.h-5 {  
    width: 30px;
    height: 30px;
  }

  table {
    margin: 20px 5%;
    width: 90%;
    border-collapse: collapse;
  }

  tr {
    height: 40px;
  }

  .results {
    position: relative;
  }
  .results-ttl {
    border-bottom: solid 1px black;
  }

  td p {
    text-align: center;
    margin: 0;
    padding: 10px 0;
  }

  .opinion {
    text-align: left;
    width: 445px;  
    white-space: nowrap;  
    overflow: hidden;
    text-overflow: ellipsis; 
  }
  .opinion:hover {
    white-space: normal;
  }

  .ttl-id {
    width: 30px;
  }

  .ttl-name {
    width: 170px;
  }

  .ttl-gender {
    width: 50px;
  }

  .ttl-email {
    width: 280px;
  }

  .ttl-opinion {
    width: 445px;
    text-align: left;
  }

  .ttl-delete {
    width: 100px;
  }

  td form {
    margin: 0;
  }
  .delete {
    display: inline-block;
    width: 60px;
    margin: 0 20px;
    border: none;
    color: white;
    background-color: black;
    border-radius: 5px;
  }

  .data-number {
    display: inline-block;
    margin-left: 80px;
  }
</style>

@section('content')
<h1>管理システム</h1>
<div class="search">
  <form action="/search" method="get">
  @csrf
    <div class="name-gender">
      <div class="name">
        <p class="ttl">お名前</p>
        <input class="text" type="text" name="name" value="{{$input['_name']}}">
      </div>
      <div class="gender">
        <p class="ttl">性別</p>
        <input type="radio" name="gender" value="" checked>
        <p>全て</p>
        <input type="radio" name="gender" value="1">
        <p>男性</p>
        <input type="radio" name="gender" value="2">
        <p>女性</p>
      </div>
    </div>
    <div class="created-at">
      <p class="ttl">登録日</p>
      <input class="text" type="date" name="start" value="{{$input['_start']}}" pattern="\d{4}-\d{2}-\d{2}">
      <p>〜</p>
      <input class="text" type="date" name="end" value="{{$input['_end']}}" pattern="\d{4}-\d{2}-\d{2}">
    </div>
    <div class="email">
      <p class="ttl">メールアドレス</p>
      <input class="text" type="email" name="email" value="{{$input['_email']}}">
    </div>
    <div class="button">
      <input class="submit" type="submit" value="検索">
      <a class="reset" href="{{url('/find')}}">リセット</a>
    </div>
  </form>
</div>



<div class="results">
@if(@isset($data) && count($data) > 0)
<p class="data-number">全{{$data->total()}}件中
  {{ ($data->currentPage() -1) * $data->perPage() +1}} ~
  {{ (($data->currentPage() -1) * $data->perPage() +1) + (count($data) -1) }}件
</p>
@endif
  <table>
    <tr class="results-ttl">
      <th class="ttl-id">ID</th>
      <th class="ttl-name">お名前</th>
      <th class="ttl-gender">性別</th>
      <th class="ttl-email">メールアドレス</th>
      <th class="ttl-opinion">ご意見</th>
      <th class="ttl-delete"></th>
    </tr>
    @if(@isset($data))
    @foreach($data as $item)
    <tr>
      <td><p>{{$item->id}}</p></td>
      <td><p>{{$item->fullname}}</p></td>
      @unless($item->gender !== 1)
      <td><p>男性</p></td>
      @else
      <td><p>女性</p></td>
      @endunless
      <td><p>{{$item->email}}</p></td>
      <td><p class="opinion">{{$item->opinion}}</p></td>
      <td>
        <form action="/delete/{{$item->id}}" method="post">
        @csrf
        <input type="submit" class="delete" value="削除">
      </td>
    </tr>
    @endforeach
    {{$data->appends(request()->query())->links()}}
    @endif
  </table>
</div>


@endsection