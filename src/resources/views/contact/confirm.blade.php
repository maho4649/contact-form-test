
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        Contact Form
      </a>
    </div>
  </header>

  <main>

    <div class="confirm__content">
      <div class="confirm__heading">
        <h2>お問い合わせ内容確認</h2>
      </div>
      
      <form class="form" action=/thanks method="post">
        @csrf
        <div class="confirm-table">
          <table class="confirm-table__inner">
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text">
                {{ old('name', $contact['name'] ?? '') }}
                <input type="hidden" name="name" value="{{ old('name', $contact['name'] ?? '') }}">
              </td>
            </tr>

            <tr class="confirm-table__row">
              <th class="confirm-table__header">性別</th>
                <td class="confirm-table__text">
                {{ old('gender', $contact['gender'] ?? '') }}
                <input type="hidden" name="gender" value="{{ old('gender', $contact['gender'] ?? '') }}">
  
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text">
                <input type="text" name="email" value="{{ old('email',$contact['email'] ?? '')}}" readonly/>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
              <td class="confirm-table__text">
                
                <input type="text" name="tel" value="{{ old('tel',$contact['tel'] ?? '')}}" readonly/>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">住所</th>
              <td class="confirm-table__text">
                <input type="text" name="address" value="{{ old('address',$contact['address'] ?? '')}}" readonly/>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">建物名</th>
              <td class="confirm-table__text">
                <input type="hidden" name="building" value="{{ old('building',$contact['building'] ?? '')}}" readonly/>
                {{ old('building', $contact['building'] ?? '') }}
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">問い合わせの種類</th>
              <td class="confirm-table__text">
                <input type="hidden" name="type" value="{{ old('type',$contact['type'] )}}">
                {{ old('type_label', $contact['type_label'] ?? '') }}
              </td>
            </tr>


            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
                <input type="text" name="content" value="{{ old('content',$contact['content'] ?? '')}}" readonly/>
              </td>
            </tr>
          </table>
        </div>
        <div class="form__button" >

          <button class="form__button-submit" type="submit">送信</button>
          <a href="{{ url('/') }}" class="form-button-submit">修正</a>

        </div>
      </form>
    </div>
  </main>
</body>

</html>