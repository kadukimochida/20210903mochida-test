@extends('layouts.parent')

<style>
  h1 {
    width: 50%;
    text-align: center;
  }
  .confirm {
    display: flex;
    width: 50%;
  }
  .ttl {
    width:30%;
    font-weight: bold;
    padding-left: 20px;
  }

  
  .content {
    width: 70%;
  }

  form,
  .btn {
    width: 50%;
    height: 100px;
  }

  form {
    display: flex;
    align-items: center;
  }

  input {
    display: block;
    width: 120px;
    height: 50px;
    background-color: black;
    color: white;
    margin: auto;
    border-radius: 5px;
  }

  button {
    display: block;
    border: none;
    background-color: white;
    margin: auto;
  }

  button:hover,
  input:hover {
    cursor: pointer;
  }
</style>

@section('content')

<h1>内容確認</h1>
<div class="confirm">
  <p class="ttl">お名前</p>
  <p class="content">{{$fullname}}</p>
</div>
<div class="confirm">
  <p class="ttl">性別</p>
  @if($gender === '1')
    <p class="content">男性</p>
  @elseif($gender === '2')
    <p class="content">女性</p>
  @endif
</div>
<div class="confirm">
  <p class="ttl">メールアドレス</p>
  <p class="content">{{$email}}</p>
</div>
<div class="confirm">
  <p class="ttl">郵便番号</p>
  <p class="content">{{$postcode}}</p>
</div>
<div class="confirm">
  <p class="ttl">住所</p>
  <p class="content">{{$address}}</p>
</div>
<div class="confirm">
  <p class="ttl">建物名</p>
  <p class="content">{{$building_name}}</p>
</div>
<div class="confirm">
  <p class="ttl">ご意見</p>
  <p class="content">{{$opinion}}</p>
</div>
<form action="/post" method="post" accept-charset="UTF-8">
@csrf
  <input type="submit" value="送信">
</form>
<div class="btn">
  <button onclick="window.history.back()">修正する</button>
</div>
@endsection