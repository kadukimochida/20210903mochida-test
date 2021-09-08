@extends('layouts.parent')
<style>
  html,
  body {
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

.content {
  width: 30%;
}

p {
  text-align: center;
}
button {
  display: inline-block;
  width: 150px;
  height: 40px;
  background-color: black;
  color: white;
  margin: 0 115px;
  border-radius:10px;
  font-weight: bold;
  border: none;
}

button:hover {
  cursor: pointer;
}
</style>

@section('content')
<div class="content">
  <p>ご意見いただきありがとうございました。</p>
  <button>トップページへ</button>
</div>

@endsection