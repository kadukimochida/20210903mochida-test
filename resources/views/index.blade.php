@extends('layouts.parent')
<style>
  
  h1 {
    width: 50%;
    text-align: center;
  }

  p,
  input {
    display: inline-block;
  }

  /*入力フォームの見出し */

  .form-title {
    display: inline-block;
    width: 30%;
    padding-left: 20px;
  }

  .form-title span {
    color: red;
  }

  .form-title p {
    font-weight: bold;
  }

  .form-content {
    width: 50%;
    
    display: flex;
  }

  /*「お名前」入力フォーム */
  .name {
    width: 35%;
    display: inline-block;
    margin: 0 10px;
  }

  .name input {
    width: 100%;
    height: 40px;
  }

  /*メールアドレス、郵便番号、住所、建物名、ご意見入力フォーム */
  .text,
  .content,
  .postcode-content{
    width: 70%;
  }

  .content input {
    width: 90%;
    height: 40px;
  }

  input,
  textarea {
    border: solid 1px #c0c0c0;
    border-radius: 5px;
  }

  /*[〒] */
  .post {
    display: inline-block;
  }

  .postcode {
    width: 85%;
    height: 40px;
  }

  /*「ご意見」フォーム */
  .form-text {
    width: 50%;
    display: flex;
  }

  textarea {
    width: 90%;
  }



  /*バリデーションエラー文 */
  .error {
    color: red;
  }

  /*　例） */
  #lastname-example,
  #firstname-example,
  #email-example,
  #postcode-example,
  #address-example,
  .example {
    color: #c0c0c0;
  }

  /*確認ボタン */
  .confirm {
    width: 50%;
    height: 100px;
    display: flex;
    align-items: center;
  }
  .confirm input {
    display: block;
    width: 120px;
    height: 50px;
    background-color: black;
    color: white;
    margin: auto;
  }

  .confirm input:hover {
    cursor: pointer;
  }

  /*性別ラジオボタン */
  .gender {
    width: 150px;
  }
  input[type=radio] {
    display: none;
  }
  .radio {
    box-sizing: border-box;
    cursor: pointer;
    display: inline-block;
    padding-left: 50px;
    position: relative;
    width: auto;
    margin-top: 10px;
  }

  .radio::before {
    background: #fff;
    border: 1px solid #231815;
    border-radius: 50%;
    content: '';
    display: block;
    height: 40px;
    left: 5px;
    margin-top: -8px;
    position: absolute;
    top: ;
    width: 40px;
  }
  
  .radio::after {
    background: black;
    border-radius: 50%;
    content: '';
    display: block;
    height: 12px;
    left: 20px;
    margin-top: -4px;
    opacity: 0;
    position: absolute;
    top: 40%;
    width: 12px;
  }

  input[type=radio]:checked + .radio::after {
    opacity: 1;
  }

  
</style>

@section('content')

<h1>お問い合わせ</h1>
<form id="form" action="/confirm" method="post" novalidate>
@csrf
<!--name-->
  <div class="form-content">
    <div class="form-title">
      <p>お名前</p>
      <span>※</span>
    </div>
    <!--lastname-->
    <div class="name">
      <input type="text" name="lastname" value="{{old('lastname')}}" required>
      @error('lastname')
      <p class="error lastname-validation">{{$message}}</p>
      @enderror
      <p id="lastname" class="error"></p><span id="lastname-example">例）山田</span>
    </div>
    <!--firstname-->
    <div class="name">
      <input type="text" name="firstname" value="{{old('firstname')}}" required>
      @error('firstname')
      <p class="error firstname-validation">{{$message}}</p>
      @enderror
      <p id="firstname" class="error"></p>
      <span id="firstname-example">例）太郎</span>
    </div>
  </div>
  <!--gender-->
  <div class="form-content">
    <div class="form-title">
      <p>性別</p>
      <span>※</span>
    </div>
    <!--men-->
    <div class="gender">
      <input type="radio" id="men" name="gender" value="1" checked>
      <label for="men" class="radio">男性</label>
    </div>
    <!--women-->
    <div class="gender">
      <input type="radio" id="women" name="gender" value="2">
      <label for="women" class="radio">女性</label>
    </div>
  </div>
  <!--email-->
  <div class="form-content">
    <div class="form-title">
      <p>メールアドレス</p>
      <span>※</span>
    </div>
    <div class="content">
      <input type="email" name="email" value="{{old('email')}}" required>
      @error('email')
      <p class="error email-validation">{{$message}}</p>
      @enderror
      <p id="email" class="error"></p>
      <p id="email-example">例）test.@example.com</p>
    </div>
  </div>
  <!--postcode-->
  <div class="form-content">
    <div class="form-title">
      <p>郵便番号</p>
      <span>※</span>
    </div>
    <div class="postcode-content">
      <p class="post">〒</p>
      <input class="postcode" type="text" name="postcode" value="{{old('postcode')}}" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');" oninput="value = value.replace(/[０-９]/g,s => String.fromCharCode(s.charCodeAt(0) - 65248)).replace(/[ー−]/g,'-');" required >
      @error('postcode')
      <p class="error postcode-validation">{{$message}}</p>
      @enderror
      <p id="postcode" class="error"></p>
      <p id="postcode-example">例）123-4567</p>
    </div>
  </div>
  <!--address-->
  <div class="form-content">
    <div class="form-title">
      <p>住所</p>
      <span>※</span>
    </div>
    <div class="content">
      <input type="text" name="address" value="{{old('address')}}"　required>
      @error('address')
      <p class="error address-validation">{{$message}}</p>
      @enderror
      <p id="address" class="error"></p>
      <p id="address-example">例）東京都渋谷区千駄ヶ谷1-2-3</p>
    </div>
  </div>
  <!--building-->
  <div class="form-content">
    <div class="form-title">
      <p>建物名</p>
    </div>
    <div class="content">
      <input type="text" name="building_name" value="{{old('building_name')}}">
      <p class="example">例）千駄ヶ谷マンション101</p>
    </div>
  </div>
  <!--opinion-->
  <div class="form-text">
    <div class="form-title">
      <p>ご意見</p>
      <span>※</span>
    </div>
    <div class="text">
      <textarea name="opinion" cols="30" rows="5" maxlength="120" required>{{old('opinion')}}</textarea>
      @error('opinion')
      <p class="error opinion-validation">{{$message}}</p>
      @enderror
      <p id="opinion" class="error"></p>
    </div>
  </div>
  <!--confirm-->
  <div class="confirm">
    <input type="submit" value="確認">
  </div>
</form>

<script>

const $form = document.getElementById('form');
$form.addEventListener('change',update);
$form.addEventListener('input',update);


function update(e) {
  let type = e.target.name;
  let validationMessage = e.target.validationMessage;
  const $error = document.getElementById(type);
  let example = type + '-example';
  const idName = document.getElementById(example);
  const validationName = type + '-validation';
  const validation = document.getElementsByClassName(validationName);
  for(var i = 0;i < validation.length; i++) {
    validation[i].style.display = 'none';
  }

  if(validationMessage) {
    $error.innerHTML=validationMessage;
    idName.style.display = 'none';
  } else {
    $error.innerHTML="";
    idName.style.display = 'inline-block';
  }
}






</script>
@endsection