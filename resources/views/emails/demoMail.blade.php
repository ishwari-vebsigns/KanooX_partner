<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Loan Sarovar</title>

<style>
  body {
    margin: 0;
    padding: 0;
    background-color: #f4f6f8;
    font-family: Arial, Helvetica, sans-serif;
  }
  table {
    border-collapse: collapse;
  }
  img {
    border: 0;
    display: block;
  }
  .wrapper {
    max-width: 600px;
    width: 100%;
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
  }
  .header {
    background: #0c0c3e;
    padding: 20px;
    text-align: center; /* logo stays centered */
  }
  .header img {
    max-width: 140px;
    margin: 0 auto;
  }
  .content {
    padding: 30px;
    text-align: left;
  }
  .title {
    font-size: 24px;
    font-weight: bold;
    color: #222;
    text-align: left;
    margin-bottom: 15px;
  }
  .greeting {
    font-size: 15px;
    color: #333;
    margin-bottom: 12px;
    text-align: left;
  }
  .message {
    font-size: 15px;
    color: #555;
    line-height: 1.6;
    text-align: left;
  }
  .cta {
    margin-top: 25px;
    text-align: left;
  }
  .cta a {
    background: #0c0c3e;
    color: #ffffff;
    text-decoration: none;
    padding: 12px 28px;
    border-radius: 4px;
    font-size: 15px;
    display: inline-block;
  }
  .footer {
    padding: 15px;
    text-align: left;
    font-size: 12px;
    color: #888;
    background: #f1f3f5;
  }

  @media screen and (max-width: 600px) {
    .content {
      padding: 20px;
    }
    .title {
      font-size: 20px;
    }
  }
</style>
</head>

<body>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center" style="padding:30px 10px;">

<table class="wrapper" cellpadding="0" cellspacing="0">

<!-- HEADER -->
<tr>
<td class="header">
  <img src="https://partner.loansarovar.com/login-images/logo.png" alt="Loan Sarovar">
</td>
</tr>

<!-- CONTENT -->
<tr>
<td class="content">

<!-- TITLE -->
<div class="title">
@if($mailData['type'] === 'welcome')
Welcome to Loan Sarovar 🎉
@elseif($mailData['type'] === 'loan_applied')
Loan Application Submitted ✅
@elseif($mailData['type'] === 'congrats')
Congratulations 🎉
@elseif($mailData['type'] === 'reject')
Application Update ❌
@endif
</div>

<!-- GREETING -->
<p class="greeting">
Dear <strong>{{ $mailData['body'] }}</strong>,
</p>

<!-- MESSAGE -->
<p class="message">
{{ $mailData['content'] }}
</p>

{{-- CTA only for required types --}}
@if(in_array($mailData['type'], ['welcome','loan_applied']))
<div class="cta">
  <a href="https://loansarovar.com/public/sign-in">
    Go to Dashboard
  </a>
</div>
@endif

</td>
</tr>

<!-- FOOTER -->
<tr>
<td class="footer">
© {{ date('Y') }} Loan Sarovar. All rights reserved.<br>
This is an automated email, please do not reply.
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>
