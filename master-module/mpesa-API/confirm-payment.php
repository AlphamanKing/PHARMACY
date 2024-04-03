<?php
  session_start(); 

//  include('express-stk.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900');
            @import url('https://fonts.googleapis.com/css?family=Source+Code+Pro:400,200,300,500,600,700,900');
            /* CSS styles here */

.container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  flex-direction: column;
}

* {
  box-sizing: border-box;
}

html {
  background-color: #171A3D;
  font-family: 'Lato', sans-serif;
}

.price h1 {
  font-weight: 300;
  color: #18C2C0;
  letter-spacing: 2px; 
  text-align: center;
}

.card {
  margin-top: 30px;
  margin-bottom: 30px;
  width: 520px;
}

.card .row {
  width: 100%;
  padding: 1rem 0;
  border-bottom: 1.2px solid #292C58;
}

.card .row.number {
  background-color: #242852;
}

.cardholder .info, .number .info {
  position: relative;
  margin-left: 40px;
}

.cardholder .info label, .number .info label {
  display: inline-block;
  letter-spacing: 0.5px;
  color: #8F92C3;
  width: 40%;
}

.cardholder .info input, .number .info input {
  display: inline-block;
  width: 55%;
  background-color: transparent;
  font-family: 'Source Code Pro';
  border: none;
  outline: none;
  margin-left: 1%;
  color: white;
}

.cardholder .info input::placeholder, .number .info input::placeholder {
  font-family: 'Source Code Pro';
  color: #444880;
}

#cardnumber, #cardnumber::placeholder {
  letter-spacing: 2px;
  font-size: 16px;
}

.button button {
  font-size: 1.2rem;
  font-weight: 400;
  letter-spacing: 1px;
  width: 520px;
  background-color: #18C2C0;
  border: none;
  color: #fff;
  padding: 18px;
  border-radius: 5px;
  outline: none;
  cursor: pointer;
  transition: background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.button button:hover {
  background-color: #15aeac;
}

.button button:active {
  background-color: #139b99;
}

.button button i {
  font-size: 1.2rem;
  margin-right: 5px;
}

        </style>
    </head>
<body>
    <div class="container">
        <form action='transaction-logging.php' method='POST'>
            <div class="price">
                <h1>Great, that's KES <?php echo $_SESSION['total_amount']; ?> </h1> 
            </div>
            <div class="card__container"> 
                <div class="card">
                    <div class="row">
                        <img src="mpesa.png" style="width:30%;margin: 0 35%;">
                        <p style="color:#8F92C3;line-height:1.7;">3. After Receiving the MPESA confirmation message, <br> 4. Key in the <strong>Transaction Code </strong> in the below box then,<br> 5. Press 'Confirm Payment' to finish making your order.</p>
                
                        <?php if (isset($errmsg) && $errmsg != ''): ?>
                            <p style="background: #cc2a24;padding: .8rem;color: #ffffff;"><?php echo $errmsg; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="row number">
                            <div class="info">
                                <label for="cardnumber">TRANSACTION CODE</label>
                                <input id="cardnumber" type="text" name="transactionID" maxlength="10" placeholder="SCS2EZBS9A" required/>
                            </div>
                        </div>
                </div> <!-- Missing closing tag for .card -->
            </div> <!-- Missing closing tag for .card__container -->
            <div class="button">
                <button type="submit"><i class="ion-locked"></i> Confirm Payment</button> <br> <br>
                <!-- Cancel Transaction Button -->
                <button type="button" onclick="cancelTransaction()"><i class="ion-locked"></i> Cancel Transaction</button>
            </div>
        </form>
    </div>
    <script>
function cancelTransaction() {
    if (confirm('Are you sure you want to cancel the transaction?')) {
        // AJAX request to a PHP script to destroy the session
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'cancel_transaction.php', true);
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Redirect to the main folder index.php after the session is destroyed
                window.location.href = '/PHARMACY/master-module/index.php';
            }
        };
        xhr.send();
    }
}
</script>

</body>

</html>
