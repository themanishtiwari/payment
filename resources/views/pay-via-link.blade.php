<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
  integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
  crossorigin="anonymous">
<link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>

<body>
  <div class="container">
    <div class='row'>
      <div class='col-md-4'></div>
      <div class='col-md-4'>
        <script async
          src="https://js.stripe.com/v3/buy-button.js">
        </script>

        <stripe-buy-button
          buy-button-id="buy_btn_1NyvGQSFaGHixBwz4J6ilDsO"
          publishable-key="pk_test_51NyURkSFaGHixBwzWXrwrLMZlPIeMxBp8pfmwQcAatbdTOU8OC0QEJWAwkO8ZESVlAlwNhgDZju6bFmUhKDGH1LN00nlRHYkcs"
        >
        </stripe-buy-button>
      </div>
      
      <div class='col-md-4'></div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-1.12.3.min.js"
    integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
    crossorigin="anonymous"></script>
  <script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
    integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
    crossorigin="anonymous"></script>

</body>
</html>