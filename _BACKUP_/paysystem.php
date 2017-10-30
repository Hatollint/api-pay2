<?php 
	$a = explode("-", $_GET['public_key']); 
	$shopinfo = getShopByID($a[1]);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" name="robots" content="none">
    <title>Прием платежей</title>
    <link rel="stylesheet" href="/style/bill.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
	    a.paysystem {
		    display: inline-block;
		    width: 30%;
		    cursor: pointer;
		    margin: 0px 5px;
		}

		a.item-paysystem {
		        display: inline-block;
			    width: auto;
			    cursor: pointer;
			    margin: 0px 5px;
			    outline: 1px solid #DFDFDF;
			    border-radius: 15px;
			    margin-bottom: 15px;
		}

		.checkout-billing-header{ margin: 0 -20px; }
		.checkout-billing{ padding: 0 0px }

		.clear {
			clear: both;
		}
	</style>
</head>
	<body>
	<div id="dev-app">
		<div class="checkout">

      <header class="checkout-header">
        <a href="http://localpay.ru/"><span class="checkout-logo"></span></a>
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
							        <p class="checkout-carrier-text"><?=htmlspecialchars($_GET['desc'])?></p>
						      	<?endif?>

								<div class="checkout-carrier-amount">
									<span class="checkout-currency">
										<span><?=htmlspecialchars($_GET['sum'])?></span>
										<span></span>
										<i class="fa fa-rub"></i>
									</span>
								</div>
							</div>
						</div>

						<div class="checkout-sep"></div>

						<div class="checkout-billing">
							<div class="checkout-billing-header">
								<?php array_shift($_GET) ?>
								<?if($shopinfo["shop_webmoney"] == 1):?>
								<a href="/pay?paySystem=webmoney&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/webmoney.png"></a>
								<?endif?>
								<?if($shopinfo["shop_yandex"]):?>
								<a href="/pay?paySystem=yandex&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/yandex.png"></a>
								<?endif?>
								<?if($shopinfo["shop_qiwi"]):?>
								<a href="/pay?paySystem=qiwi&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/qiwi.png"></a>
								<?endif?>
								<?if($shopinfo["shop_visa"]):?>
								<a href="/pay?paySystem=visa&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/visa.png"></a>
								<?endif?>
								<?if($shopinfo["shop_master_card"]):?>
								<a href="/pay?paySystem=master-card&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/master-card.png"></a>
								<?endif?>
								<?if($shopinfo["shop_robokassa"]):?>
								<a href="/pay?paySystem=robokassa&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/robokassa.png"></a>
								<?endif?>
								<?if($shopinfo["shop_ooopay"]):?>
								<a href="/pay?paySystem=ooopay&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/oopay.png"></a>
								<?endif?>
								<?if($shopinfo["shop_tinkoff"]):?>
								<a href="/pay?paySystem=tinkoff&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/tinkoff.png"></a>
								<?endif?>
								<?if($shopinfo["shop_w1"]):?>
								<a href="/pay?paySystem=w1&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/w1.png"></a>
								<?endif?>
								<?if($shopinfo["shop_payeer"]):?>
								<a href="/pay?paySystem=payeer&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/payeer.png"></a>
								<?endif?>
								<?if($shopinfo["shop_okpay"]):?>
								<a href="/pay?paySystem=okpay&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/okpay.png"></a>
								<?endif?>
								<?if($shopinfo["shop_zpayment"]):?>
								<a href="/pay?paySystem=zpayment&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/zpayment.png"></a>
								<?endif?>
								<?if($shopinfo["shop_alpha_bank"]):?>
								<a href="/pay?paySystem=alpha-bank&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/alpha-bank.png"></a>
								<?endif?>
								<?if($shopinfo["shop_sberbank"]):?>
								<a href="/pay?paySystem=sberbank&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/sberbank.png"></a>
								<?endif?>
								<?if($shopinfo["shop_vtb"]):?>
								<a href="/pay?paySystem=vtb&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/vtb.png"></a>
								<?endif?>
								<?if($shopinfo["shop_promsvyazbank"]):?>
								<a href="/pay?paySystem=promsvyazbank&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/promsvyazbank.png"></a>
								<?endif?>
								<?if($shopinfo["shop_rus_standart"]):?>
								<a href="/pay?paySystem=rus-standart&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/rus-standart.png"></a>
								<?endif?>
								<?if($shopinfo["shop_mts"]):?>
								<a href="/pay?paySystem=mts&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/mts.png"></a>
								<?endif?>
								<?if($shopinfo["shop_tele2"]):?>
								<a href="/pay?paySystem=tele2&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/tele2.png"></a>
								<?endif?>
								<?if($shopinfo["shop_beline"]):?>
								<a href="/pay?paySystem=beline&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/beline.png"></a>
								<?endif?>
								<?if($shopinfo["shop_terminal_ru"]):?>
								<a href="/pay?paySystem=terminal-ru&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/terminal-ru.png"></a>
								<?endif?>
								<?if($shopinfo["shop_terminal_ua"]):?>
								<a href="/pay?paySystem=terminal-ua&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/terminal-ua.png"></a>
								<?endif?>
								<?if($shopinfo["shop_mykassa"]):?>
								<a href="/pay?paySystem=mykassa&<?=http_build_query($_GET)?>" class="item-paysystem"><img src="/systems/mykassa.png"></a>
								<?endif?>
							</div>

							<div class="checkout-hr"></div>
							<div class="checkout-billing-content">
								<div class="checkout-billing-content-field checkout-billing-content-total">
									<div class="checkout-billing-content-title">
										<span>Сумма к оплате</span>
									</div>
									<div class="checkout-billing-content-amount">
										<span class="checkout-currency">
											<span><?=htmlspecialchars($_GET['sum'])?></span>
											<span> </span>
											<i class="fa fa-rub"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- <section class="checkout-section checkout-continue">
					<div class="checkout-section-wrap">
						<button id="processPayment" class="btn">
						<span>Оплатить</span>
						</button>
					</div>
				</section> -->
				<!-- <section class="checkout-section checkout-actions">
					<div class="checkout-section-wrap">
						<a href="#" class="checkout-link">
							<span>Изменить способ оплаты</span>
						</a>
					</div>
				</section> -->
			</div>
		</div>
	</div>
	</body>
</html>