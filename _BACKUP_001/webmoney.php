<?php 
  $shopid = getShopByPaymentID($id);
  $shopinfo = getShopByID($shopid);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" name="robots" content="none">
    <title>Оплата при помощи WebMoney - Прием платежей</title>
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
        <a href="https://pay2.ru/"><span class="checkout-logo"></span></a>
        <div class="checkout-guarantee">
          <div class="icon icon-security">
          <a href="#"><i class="fa fa-lock fa-3x"></i></a>
          </div>
          <span>
            Гарантируем безопасность платежа и сохранность ваших личных данных
          </span>
        </div>
      </header>

      <div data-reactid=".0.1:2">
        <section class="checkout-section">
          <div class="checkout-section-wrap">
            <div class="checkout-carrier-info">
              <div class="checkout-carrier">
                <h1 class="checkout-carrier-title"><?=$shopinfo['shop_name']?></h1>
                <?if(!empty($_GET['desc'])):?>
                      <p class="checkout-carrier-text"><?=$_GET['desc']?></p>
                    <?endif?>

                <div class="checkout-carrier-amount">
                  <span class="checkout-currency">
                    <span><?=(float) $payment['log_payments_sum']?></span>
                    <span></span>
                    <i class="fa fa-rub"></i>
                  </span>
                </div>
              </div>
            </div>

            <div class="checkout-sep"></div>

            <div class="checkout-billing">
              <?if($success):?>
              <div class="alert alert-success">Платеж успешно оплачен!</div>
              <?else:?>
              <div class="checkout-billing-header">
                Для пополнения счета переведите указанную сумму на указанный кошелек. При переводе укажите нужное примечание указанное ниже, 
                оно служит для распознавания вашего платежа.
              </div>
              <?if($error):?>
              <div class="alert alert-danger">Платеж не найден! Переведите деньги и повторите попытку!</div>
              <?endif?>
              <?if($sumerror):?>
              <div class="alert alert-danger">Сумма которую вы перевели не совпадает с запрашиваемой! Платеж отклонен!</div>
              <?endif?>
              <?if($servererror):?>
              <div class="alert alert-danger">Возникла проблема при проверке платежей, повторите попытку позже!</div>
              <?endif?>
              <div class="checkout-hr"></div>
              <div class="checkout-billing-content">
                <div class="checkout-billing-content-field checkout-billing-content-total">
                  <div class="checkout-billing-content-title">
                    <span>Сумма к оплате</span>
                  </div>
                  <div class="checkout-billing-content-amount">
                    <span class="checkout-currency">
                      <span><?=(float) $payment['log_payments_sum']?></span>
                      <span> </span>
                      <i class="fa fa-rub"></i>
                    </span>
                  </div>
                </div>
                <div class="checkout-billing-content-field checkout-billing-content-total">
                  <div class="checkout-billing-content-title">
                    <span>Кошелек</span>
                  </div>
                  <div class="checkout-billing-content-amount">
                    <span class="checkout-currency">
                      <input type="text" class="input-text" style="margin-right: 50px;" disabled value="R267788654712">
                    </span>
                  </div>
                </div>
                <div class="checkout-billing-content-field checkout-billing-content-total">
                  <div class="checkout-billing-content-title">
                    <span>Примечание</span>
                  </div>
                  <div class="checkout-billing-content-amount">
                    <span class="checkout-currency">
                      <input type="text" class="input-text" style="margin-right: 50px;" disabled value="<?=$hash?>">
                    </span>
                  </div>
                </div>
              </div>
              <?endif?>
            </div>
          </div>
        </section>
        <?if($success):?>
        <section class="checkout-section checkout-actions">
          <div class="checkout-section-wrap">
            <a href="/success?account=<?=$id?>" class="checkout-link">
              <span>Вернуться на сайт продавца</span>
            </a>
          </div>
        </section>
        <?else:?>
        <section class="checkout-section checkout-continue">
          <div class="checkout-section-wrap">
            <button id="processPayment" class="btn" onclick="location.href = '/bill?check=pay&<?=http_build_query($_GET)?>'">
              <span>Оплатить</span>
            </button>
          </div>
        </section>

        <section class="checkout-section checkout-actions">
          <div class="checkout-section-wrap">
            <a href="#" class="checkout-link" onclick="history.back()">
              <span>Изменить способ оплаты</span>
            </a>
          </div>
        </section>
        <?endif?>
      </div>
    </div>
  </div>
  </body>
</html>