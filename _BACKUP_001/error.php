
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" name="robots" content="none">
    <title>Ошибка - Прием платежей</title>
    <link rel="stylesheet" href="/style/bill.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
      a.paysystem {
        display: inline-block;
        width: 30%;
        cursor: pointer;
        margin: 0px 5px;
    }

    .clear {
      clear: both;
    }
  </style>
</head>
  <body>
  <div id="dev-app">
    <div class="checkout">

      <header class="checkout-header">
        <a href="http://pay2.ru/"><span class="checkout-logo"></span></a>
        <div class="checkout-guarantee">
          <div class="icon icon-security">
            <i class="fa fa-lock fa-3x"></i>
          </div>
          <span>
            Гарантируем безопасность платежа и сохранность ваших личных данных
          </span>
        </div>
      </header>

      <div data-reactid=".0.1:2">
        <section class="checkout-section">
          <div class="checkout-section-wrap">
            <div class="checkout-billing">
              <div class="alert alert-danger" style="margin: -25px -100px;"><?= (!empty($error)) ? $error : "При работе возникла ошибка! Повторите попытку позже." ?></div>
            </div>
          </div>
        </section>
        <section class="checkout-section checkout-actions">
          <div class="checkout-section-wrap">
            <a href="#" class="checkout-link" onclick="history.back()">
              <span>Вернуться назад</span>
            </a>
          </div>
        </section>
      </div>
    </div>
  </div>
  </body>
</html>