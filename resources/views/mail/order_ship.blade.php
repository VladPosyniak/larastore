<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Campaign Monitor Newsletter</title>
	<style>
	a:hover {
		text-decoration: underline !important;
	}
	td.promocell p { 
		color:#e1d8c1;
		font-size:16px;
		line-height:26px;
		font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
		margin-top:0;
		margin-bottom:0;
		padding-top:0;
		padding-bottom:14px;
		font-weight:normal;
	}
	td.contentblock h4 {
		color:#444444 !important;
		font-size:16px;
		line-height:24px;
		font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
		margin-top:0;
		margin-bottom:10px;
		padding-top:0;
		padding-bottom:0;
		font-weight:normal;
	}
	td.contentblock h4 a {
		color:#444444;
		text-decoration:none;
	}
	td.contentblock p { 
	  	color:#888888;
		font-size:13px;
		line-height:19px;
		font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
		margin-top:0;
		margin-bottom:12px;
		padding-top:0;
		padding-bottom:0;
		font-weight:normal;
	}
	td.contentblock p a { 
	  	color:#3ca7dd;
		text-decoration:none;
	}

	td.contentblock p.goods{
		font-size:15px;
	}

	td.contentblock p.summ{
		font-size:17px;
		font-weight: bold;
	}

	ul.goods_list li{
		color:#888888;
		font-size:15px;
		line-height:19px;
		font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
		margin-top:0;
		margin-bottom:12px;
		padding-top:0;
		padding-bottom:0;
		font-weight:normal;
	}

	ul.goods_list p.price {
		display: inline-block;
		margin:0;
		line-height:19px;
		font-weight: bold;
	}

	@media only screen and (max-device-width: 480px) {
	     div[class="header"] {
	          font-size: 16px !important;
	     }
	     table[class="table"], td[class="cell"] {
	          width: 300px !important;
	     }
		table[class="promotable"], td[class="promocell"] {
	          width: 325px !important;
	     }
		td[class="footershow"] {
	          width: 300px !important;
	     }
		table[class="hide"], img[class="hide"], td[class="hide"] {
	          display: none !important;
	     }
	     img[class="divider"] {
		      height: 1px !important;
		 }
		 td[class="logocell"] {
			padding-top: 15px !important; 
			padding-left: 15px !important;
			width: 300px !important;
		 }
	     img[id="screenshot"] {
	          width: 325px !important;
	          height: 127px !important;
	     }
		img[class="galleryimage"] {
			  width: 53px !important;
	          height: 53px !important;
		}
		p[class="reminder"] {
			font-size: 11px !important;
		}
		h4[class="secondary"] {
			line-height: 22px !important;
			margin-bottom: 15px !important;
			font-size: 18px !important;
		}
	}
	</style>
</head>
<body bgcolor="#e4e4e4" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="-webkit-font-smoothing: antialiased;width:100% !important;background:#e4e4e4;-webkit-text-size-adjust:none;">
	
<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#e4e4e4">
<tr>
	<td bgcolor="#e4e4e4" width="100%">

	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="table">
	<tr>
		<td width="600" class="cell">
		
	   	<table width="600" cellpadding="0" cellspacing="0" border="0" class="table">
		<tr>
			<td width="250" bgcolor="#e4e4e4" class="logocell"><img border="0" src="https://shmot.top/files/mail/spacer.gif" width="1" height="20" class="hide"><br class="hide"><img src="https://shmot.top/files/mail/logo.png" width="178" height="100" alt="Campaign Monitor" style="-ms-interpolation-mode:bicubic;"><br><img border="0" src="https://shmot.top/files/mail/spacer.gif" width="1" height="10" class="hide"><br class="hide"></td>
		</tr>
		</table>
		<img border="0" src="https://shmot.top/files/mail/spacer.gif" width="1" height="15" class="divider"><br>
	
		<repeater>
			<layout label="New feature">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td bgcolor="#fd9cf8" nowrap><img border="0" src="https://shmot.top/files/mail/spacer.gif" width="5" height="1"></td>
				<td width="100%" bgcolor="#ffffff">
			
					<table width="100%" cellpadding="20" cellspacing="0" border="0">
					<tr>
						<td bgcolor="#ffffff" class="contentblock">

							<h4 class="secondary"><strong><singleline label="Title">Заказ успешно отправлен!</singleline></strong></h4>
							<multiline label="Description">
								<p>Заказ успешно отправлен Новой почтой и имеет такой номер накладной: <a href="https://novaposhta.ua/tracking/?cargo_number={{$express}}" target="_blank" style="color:#a6a6a6;text-decoration:underline;">{{$express}}</a></p>
								<p class="goods">Товары:</p>
								<ul class="goods_list">
									@foreach($products as $product)
										@if($product['amount'] == 1)
											<li>{{$product['title']}} - <b>{{$product['price']}}грн</b> x{{$product['amount']}}</li>
										@else
											<li>{{$product['title']}} - {{$product['price']}}грн x{{$product['amount']}}= <b>{{$product['total_price']}}грн</b></li>
										@endif
									@endforeach
								</ul>
								<b>Сумма: {{$total}}грн</b>
							</multiline>

						</td>
					</tr>
					</table>
			
				</td>
			</tr>
			</table>  
			<img border="0" src="https://shmot.top/files/mail/spacer.gif" width="1" height="15" class="divider"><br>
			</layout>
			<!-- <layout label="Gallery highlights">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td bgcolor="#2588fc" nowrap><img border="0" src="https://shmot.top/files/mail/spacer.gif" width="5" height="1"></td>
				<td width="100%" bgcolor="#ffffff">

					<table width="100%" cellpadding="20" cellspacing="0" border="0">
					<tr>
						<td bgcolor="#ffffff" class="contentblock">

							<h4 class="secondary"><strong><singleline label="Gallery title">Title of gallery summary</singleline></strong></h4>
							<multiline label="Gallery description"><p>Description of this month's gallery entries</p></multiline>

						</td>
					</tr>
					</table>

				</td>
			</tr>
			</table>

			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td bgcolor="#2588fc" nowrap><img border="0" src="https://shmot.top/files/mail/spacer.gif" width="5" height="1"></td>
				<td bgcolor="#ffffff" nowrap><img border="0" src="https://shmot.top/files/mail/spacer.gif" width="5" height="1"></td> 
				<td width="100%" bgcolor="#ffffff">

					<table cellpadding="5" cellspacing="0" border="0">
					<tr>
						<td><a href="https://shmot.top"><img border="0" src="https://shmot.top/files/mail/gallery.png" width="107" height="107" editable="true" class="galleryimage" label="Image 1"></a></td>
						<td><a href="https://shmot.top"><img border="0" src="https://shmot.top/files/mail/gallery.png" width="107" height="107" editable="true" class="galleryimage" label="Image 1"></a></td>
						<td><a href="https://shmot.top"><img border="0" src="https://shmot.top/files/mail/gallery.png" width="107" height="107" editable="true" class="galleryimage" label="Image 1"></a></td>
						<td><a href="https://shmot.top"><img border="0" src="https://shmot.top/files/mail/gallery.png" width="107" height="107" editable="true" class="galleryimage" label="Image 1"></a></td>
						<td><a href="https://shmot.top"><img border="0" src="https://shmot.top/files/mail/gallery.png" width="107" height="107" editable="true" class="galleryimage" label="Image 1"></a></td>
					</tr>
					<tr>
						<td><a href="https://shmot.top"><img border="0" src="https://shmot.top/files/mail/gallery.png" width="107" height="107" editable="true" class="galleryimage" label="Image 1"></a></td>
						<td><a href="https://shmot.top"><img border="0" src="https://shmot.top/files/mail/gallery.png" width="107" height="107" editable="true" class="galleryimage" label="Image 1"></a></td>
						<td><a href="https://shmot.top"><img border="0" src="https://shmot.top/files/mail/gallery.png" width="107" height="107" editable="true" class="galleryimage" label="Image 1"></a></td>
						<td><a href="https://shmot.top"><img border="0" src="https://shmot.top/files/mail/gallery.png" width="107" height="107" editable="true" class="galleryimage" label="Image 1"></a></td>
						<td><a href="https://shmot.top"><img border="0" src="https://shmot.top/files/mail/gallery.png" width="107" height="107" editable="true" class="galleryimage" label="Image 1"></a></td>
					</tr>
					</table>

					<img border="0" src="https://shmot.top/files/mail/spacer.gif" width="1" height="5"><br>

				</td>
			</tr>
			</table>  
			</layout> -->
		</repeater>           
		
		</td>
	</tr>
	</table>

	<img border="0" src="https://shmot.top/files/mail/spacer.gif" width="1" height="25" class="divider"><br>

	<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f2f2f2">
	<tr>
		<td>
		
			<img border="0" src="https://shmot.top/files/mail/spacer.gif" width="1" height="30"><br>
		
			<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="table">
			<tr>
				<td width="600" nowrap bgcolor="#f2f2f2" class="cell">
				
					<table width="600" cellpadding="0" cellspacing="0" border="0" class="table">
					<tr>
						<td width="380" valign="top" class="footershow">
						
							<img border="0" src="https://shmot.top/files/mail/spacer.gif" width="1" height="8"><br>  
						
							<p style="color:#a6a6a6;font-size:12px;font-family:Helvetica,Arial,sans-serif;margin-top:0;margin-bottom:15px;padding-top:0;padding-bottom:0;line-height:18px;" class="reminder">Сообщение является частью обязательного оповещения пользователя о статусе заказа на <a href="https://shmot.top" style="color:#a6a6a6;text-decoration:underline;">нашем сайте</a>.</p>
							<!-- <p style="color:#c9c9c9;font-size:12px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;"><preferences style="color:#3ca7dd;text-decoration:none;"><strong>Edit your subscription</strong></preferences>&nbsp;&nbsp;|&nbsp;&nbsp;<unsubscribe style="color:#3ca7dd;text-decoration:none;"><strong>Unsubscribe instantly</strong></unsubscribe></p> -->
						
						</td>
						<td align="right" width="220" style="color:#a6a6a6;font-size:12px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;text-shadow: 0 1px 0 #ffffff;" valign="top" class="hide">
						
							<br><a href="https://shmot.top" style="color:#b3b3b3;font-size:11px;line-height:15px;font-family:Helvetica,Arial,sans-serif;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;font-weight:bold;">www.shmot.top</a></td>
					</tr>
					</table>
				
				</td>
			</tr>	
	   		</table>

			<img border="0" src="https://shmot.top/files/mail/spacer.gif" width="1" height="25"><br>
		
	   </td>
	</tr>
	</table>
	
	</td>
</tr>
</table>  	   			     	 

</body>
</html>
