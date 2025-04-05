<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Contact</h2>
      </div>
      <form class="form" action="/contact/confirm" method="post">
        @csrf
        <div class="form__group">
          <div class="form__input--name">
           <div class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">※</span>
           </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name', session('contact.last_name')) }}">
            </div>
            <div class="form__input--text">
              <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name', session('contact.first_name')) }}">
            </div>
            <div class="form__error">
             @if ($errors->has('last_name'))
             <p class="form__error">{{ $errors->first('last_name') }}</p>
             @endif

              
              @if ($errors->has('first_name'))
            <p class="form__error">{{ $errors->first('first_name') }}</p>
            @endif
            
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">性別</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__group-content form__radio-group">
             <div class="form__input--text">
              <input type="radio" name="gender" value="male" {{ old('gender', session('contact.gender')) == 'male' ? 'checked' : '' }}>
              <label for="gender_male">男性</label>
            </div>
            <div class="form__input--text">
              <input type="radio" name="gender" value="female" {{ old('gender', session('contact.gender')) == 'female' ? 'checked' : '' }}>
              <label for="gender_female">女性</label>
            </div>
            <div class="form__input--text">
              <input type="radio" name="gender" value="other" {{ old('gender', session('contact.gender')) == 'other' ? 'checked' : '' }}>
              <label for="gender_other">その他</label>
             </div>
            </div>
            <div class="form__error">
              
             @if ($errors->has('gender'))
             <p class="form__error">{{ $errors->first('gender') }}</p>
            @endif
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email', session('contact.email')) }}">
            </div>
            <div class="form__error">
              
              @if ($errors->has('email'))
              <p class="form__error">{{ $errors->first('email') }}</p>
              @endif
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">電話番号</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
           <div class="form__input--tel">
            <div class="form__input--text">
              <input type="tel" name="area_code" placeholder="080" value="{{ old('area_code', session('contact.area_code')) }}">
            </div>
            <span class="form__hyphen">-</span>
            <div class="form__input--text">
              <input type="tel" name="exchange_code" placeholder="1234" value="{{ old('exchange_code', session('contact.exchange_code')) }}">
            </div>
            <span class="form__hyphen">-</span>
            <div class="form__input--text">
              <input type="tel" name="subscriber_code" placeholder="5678" value="{{ old('subscriber_code', session('contact.subscriber_code')) }}">
            </div>
           </div>
            <div class="form__error">
              
             @if ($errors->has('area_code') || $errors->has('exchange_code') || $errors->has('subscriber_code'))
             <p class="form__error">
              {{ $errors->first('area_code') ?: ($errors->first('exchange_code') ?: $errors->first('subscriber_code')) }}
            </p>
              @endif
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="address" placeholder="例：東京都渋谷区千代田区１−２−３">{{ old('address', session('contact.address')) }}</textarea>
            </div>
            <div class="form__error">
              
             @if ($errors->has('address'))
             <p class="form__error">{{ $errors->first('address') }}</p>
             @endif
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">建物名</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="building" placeholder="千代田区マンション">{{ old('building', session('contact.building')) }}</textarea>
            </div>
            
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせの種類</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--select">
              <select name="type" required>
                <option value="">選択してください</option>
                <option value="product_inquiry" {{ old('type', session('contact.type')) == 'product_inquiry' ? 'selected' : '' }}>製品に関するお問い合わせ</option>
                <option value="order_inquiry" {{ old('type', session('contact.type')) == 'order_inquiry' ? 'selected' : '' }}>注文に関するお問い合わせ</option>
                <option value="shipping_inquiry" {{ old('type', session('contact.type')) == 'shipping_inquiry' ? 'selected' : '' }}>配送に関するお問い合わせ</option>
                <option value="other" {{ old('type', session('contact.type')) == 'other' ? 'selected' : '' }}>その他</option>
              </select>
            </div>
            <div class="form__error">
              
           @if ($errors->has('type'))
           <p class="form__error">{{ $errors->first('type') }}</p>
           @endif
              
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせ内容</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content', session('contact.content')) }}</textarea>
            </div>
            <div class="form__error">
              
            @if ($errors->has('content'))
            <p class="form__error">{{ $errors->first('content') }}</p>
            @endif
            </div>
          </div>
        </div>

        <div class="form__button">
          <button class="form__button-submit" type="submit">確認画面</button>
        </div>
      </form>
    </div>
  </main>
</body>

</html>
