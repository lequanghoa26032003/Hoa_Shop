<?php
include 'inc/header.php';
$id = Session::get('id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-order'])) {
    $order = $cart->Orders($_POST);
    if ($order) {
        echo '<script>
                setTimeout(function(){
                    window.location.href = "shop.php"; 
                }, 1000);
              </script>';
    }
}
?>

<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Trang chủ</i></a>
                    <a href="shop.php">Cửa hàng</a>
                    <span>Thủ tục thanh toán</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End-->
<!-- -->

<!-- Shopping Cart Section Begin -->
<div class="checkout-section spad">
    <div class="container">
        <form action="check-out.php" method="post" class="checkout-form">
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout-content">
                        <a href="user_profile.php" class="content-btn">Hồ sơ cá nhân</a>
                    </div>
                    <h4>Biiling Details</h4>
                    <div class="row">
                        <?php $list = $cart->get_product_cart();
                        $tongphu = 0;
                        $tong = 0;
                        if ($list) {
                            while ($result = $list->fetch_assoc()) {
                                $productList[] = [
                                    'id' => $result['prod_id'],
                                    'quantity' => $result['prod_qty']
                                ];
                                ?>
                                <?php                                     
                                  if($result['sale']=='1'){
                                      $tong += $result['selling_price'] * $result['prod_qty'];
                                    }else{
                                      $tong += $result['original_price'] * $result['prod_qty'];
                                    }
                            }
                        } ?>
                        <?php $ttuser=$us->get_user($id);
                         if($ttuser){
                            while($runtt=$ttuser->fetch_assoc()){
                            ?>
                            <div class="col-lg-6">
                                <label for="name">Tên <span>*</span></label>
                                <input value="<?=$runtt['name']?>" type="text" name="name" id="name" placeholder="Họ và tên">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Số điện thoại<span>*</span></label>
                                <input value="<?=$runtt['phone']?>" type="text" name="phone" id="phone" placeholder="Số điện thoại">
                            </div>
                            <div class="col-lg-12">
                                <label for="email">Email<span>*</span></label>
                                <input value="<?=$runtt['email']?>" type="text" name="email" id="email" placeholder="Địa chỉ email">
                            </div>

                            <div class="col-lg-12">
                                <label for="street">Địa chỉ<span>*</span></label>
                                <input value="<?=$runtt['address']?>" type="text" name="address" id="street" class="street-first"
                                    placeholder="Tỉnh/Thành phố, Quận/Huyện, Phường/Xã, Tên đường, Tòa nhà, Số nhà">
                            </div>
                        <?php } } else{ ?>
                            <div class="col-lg-6">
                            <label for="name">Tên <span>*</span></label>
                            <input type="text" name="name" id="name" placeholder="Họ và tên">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Số điện thoại<span>*</span></label>
                                <input type="text" name="phone" id="phone" placeholder="Số điện thoại">
                            </div>
                            <div class="col-lg-12">
                                <label for="email">Email<span>*</span></label>
                                <input type="text" name="email" id="email" placeholder="Địa chỉ email">
                            </div>

                            <div class="col-lg-12">
                                <label for="street">Địa chỉ<span>*</span></label>
                                <input type="text" name="address" id="street" class="street-first"
                                    placeholder="Tỉnh/Thành phố, Quận/Huyện, Phường/Xã, Tên đường, Tòa nhà, Số nhà">
                            </div>
                        <?php } ?>
                            <input type="hidden" name="total_price" value="<?= $tong ?>">


                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout-content">
                        <a href="my-order.php" class="content-btn">Lịch sử đặt hàng</a>
                    </div>
                    <div class="place-order">
                        <h4>Đơn hàng của bạn</h4>

                        <div class="order-total">

                            <ul class="order-table">

                                <li>Product<span>Total</span></li>
                                <?php $list = $cart->get_product_cart();
                                $tongphu = 0;
                                $tong = 0;
                                if ($list) {
                                    while ($result = $list->fetch_assoc()) { ?>
                                        <li class="fw-normal" style="margin: -20px 0 0 0"><img
                                                style="width:40px;height:40px;   " src="uploads/<?= $result['image'] ?>" alt="">
                                                <?php if($result['sale']){?>
                                                  <?= $result['name'] . " x " . $result['prod_qty'] ?><span><?= "₫" . $fm->format_currency($tongphu = $result['selling_price']) ?></span>
                                                <?php }else{?>
                                                  <?= $result['name'] . " x " . $result['prod_qty'] ?><span><?= "₫" . $fm->format_currency($tongphu = $result['original_price']) ?></span>

                                                <?php }?>
                                        </li>
                                        <?php $tong += $tongphu * $result['prod_qty'];
                                    }
                                } ?>
                                <li class="fw-normal">
                                    Subtotal<span><?= "₫" . $fm->format_currency($tong) ?></span>
                                </li>
                                <li class="total-price">Total<span><?= "₫" . $fm->format_currency($tong) ?></span></li>
                            </ul>

        

                            <div class="payment-check">
                                <div class="pc-item">
                                    <label for="pc-check">
                                        Thanh toán khi nhận hàng
                                        <input type="checkbox" name="payment_mode" id="pc-check" value="COD" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>
                            <a href="congthanhtoan.php?id=<?=$id?>" class="primary-btn">VNPAY</a>
                            <div class="mt-3" id="paypal-button-container"></div>
                            <p id="result-message"></p>
                        </div>
                        <div class="order-btn">
                            <button type="submit" name="btn-order" class="site-btn place-btn">Đặt đơn hàng</button>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    </form>
</div>
</div>
<!-- Shopping Cart Section End -->



<!-- Partner Logo Section End -->
<?php
include 'inc/footer.php';

?>
<script>
    const productList = <?php echo json_encode($productList); ?>;
    const totalAmount = <?php echo $tong; ?>;

</script>
<script src="https://www.paypal.com/sdk/js?client-id=AShXVfk2H3x9UQzUp181bnIcuOGacy_KAxaEwe4ZYTJmNlB1pxPvFNDJKqgN2AsGVVp8tjounRX_tula&components=buttons&enable-funding=venmo,paylater" data-sdk-integration-source="integrationbuilder_sc"></script>

<!-- <script src="https://www.paypal.com/sdk/js?client-id=AShXVfk2H3x9UQzUp181bnIcuOGacy_KAxaEwe4ZYTJmNlB1pxPvFNDJKqgN2AsGVVp8tjounRX_tula&currency=VND"></script> -->
 <script>
    window.paypal
  .Buttons({
    style: {
      shape: 'rect',
      //color:'blue', change the default color of the buttons
      layout: 'vertical', //default value. Can be changed to horizontal
    },
    async createOrder() {
      try {
        const response = await fetch("/api/orders", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          // use the "body" param to optionally pass additional order information
          // like product ids and quantities
          body: JSON.stringify({
            cart: productList,
          }),
        });

        const orderData = await response.json();

        if (orderData.id) {
          return orderData.id;
        } else {
          const errorDetail = orderData?.details?.[0];
          const errorMessage = errorDetail
            ? `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})`
            : JSON.stringify(orderData);

          throw new Error(errorMessage);
        }
      } catch (error) {
        console.error(error);
        resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
      }
    },
    async onApprove(data, actions) {
      try {
        const response = await fetch(`/api/orders/${data.orderID}/capture`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
        });

        const orderData = await response.json();
        // Three cases to handle:
        //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
        //   (2) Other non-recoverable errors -> Show a failure message
        //   (3) Successful transaction -> Show confirmation or thank you message

        const errorDetail = orderData?.details?.[0];

        if (errorDetail?.issue === "INSTRUMENT_DECLINED") {
          // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
          // recoverable state, per https://developer.paypal.com/docs/checkout/standard/customize/handle-funding-failures/
          return actions.restart();
        } else if (errorDetail) {
          // (2) Other non-recoverable errors -> Show a failure message
          throw new Error(`${errorDetail.description} (${orderData.debug_id})`);
        } else if (!orderData.purchase_units) {
          throw new Error(JSON.stringify(orderData));
        } else {
          // (3) Successful transaction -> Show confirmation or thank you message
          // Or go to another URL:  actions.redirect('thank_you.html');
          const transaction =
            orderData?.purchase_units?.[0]?.payments?.captures?.[0] ||
            orderData?.purchase_units?.[0]?.payments?.authorizations?.[0];
          resultMessage(
            `Transaction ${transaction.status}: ${transaction.id}<br><br>See console for all available details`,
          );
          console.log(
            "Capture result",
            orderData,
            JSON.stringify(orderData, null, 2),
          );
        }
      } catch (error) {
        console.error(error);
        resultMessage(
          `Sorry, your transaction could not be processed...<br><br>${error}`,
        );
      }
    },
  })
  .render("#paypal-button-container");

// Example function to show a result to the user. Your site's UI library can be used instead.
function resultMessage(message) {
  const container = document.querySelector("#result-message");
  container.innerHTML = message;
}
 </script>
<script>
    import express from "express";
import fetch from "node-fetch";
import "dotenv/config";
import path from "path";

const { PAYPAL_CLIENT_ID, PAYPAL_CLIENT_SECRET, PORT = 8888 } = process.env;
const base = "https://api-m.sandbox.paypal.com";
const app = express();

// host static files
app.use(express.static("client"));

// parse post params sent in body in json format
app.use(express.json());

/**
 * Generate an OAuth 2.0 access token for authenticating with PayPal REST APIs.
 * @see https://developer.paypal.com/api/rest/authentication/
 */
const generateAccessToken = async () => {
  try {
    if (!PAYPAL_CLIENT_ID || !PAYPAL_CLIENT_SECRET) {
      throw new Error("MISSING_API_CREDENTIALS");
    }
    const auth = Buffer.from(
      PAYPAL_CLIENT_ID + ":" + PAYPAL_CLIENT_SECRET,
    ).toString("base64");
    const response = await fetch(`${base}/v1/oauth2/token`, {
      method: "POST",
      body: "grant_type=client_credentials",
      headers: {
        Authorization: `Basic ${auth}`,
      },
    });

    const data = await response.json();
    return data.access_token;
  } catch (error) {
    console.error("Failed to generate Access Token:", error);
  }
};

/**
 * Create an order to start the transaction.
 * @see https://developer.paypal.com/docs/api/orders/v2/#orders_create
 */
const createOrder = async (cart) => {
  // use the cart information passed from the front-end to calculate the purchase unit details
  console.log(
    "shopping cart information passed from the frontend createOrder() callback:",
    cart,
  );

  const accessToken = await generateAccessToken();
  const url = `${base}/v2/checkout/orders`;
  const payload = {
    intent: "CAPTURE",
    purchase_units: [
      {
        amount: {
          currency_code: "VNĐ",
          value: totalAmount.toFixed(2),
        },
      },
    ],
  };

  const response = await fetch(url, {
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${accessToken}`,
      // Uncomment one of these to force an error for negative testing (in sandbox mode only). Documentation:
      // https://developer.paypal.com/tools/sandbox/negative-testing/request-headers/
      // "PayPal-Mock-Response": '{"mock_application_codes": "MISSING_REQUIRED_PARAMETER"}'
      // "PayPal-Mock-Response": '{"mock_application_codes": "PERMISSION_DENIED"}'
      // "PayPal-Mock-Response": '{"mock_application_codes": "INTERNAL_SERVER_ERROR"}'
    },
    method: "POST",
    body: JSON.stringify(payload),
  });

  return handleResponse(response);
};

/**
 * Capture payment for the created order to complete the transaction.
 * @see https://developer.paypal.com/docs/api/orders/v2/#orders_capture
 */
const captureOrder = async (orderID) => {
  const accessToken = await generateAccessToken();
  const url = `${base}/v2/checkout/orders/${orderID}/capture`;

  const response = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${accessToken}`,
      // Uncomment one of these to force an error for negative testing (in sandbox mode only). Documentation:
      // https://developer.paypal.com/tools/sandbox/negative-testing/request-headers/
      // "PayPal-Mock-Response": '{"mock_application_codes": "INSTRUMENT_DECLINED"}'
      // "PayPal-Mock-Response": '{"mock_application_codes": "TRANSACTION_REFUSED"}'
      // "PayPal-Mock-Response": '{"mock_application_codes": "INTERNAL_SERVER_ERROR"}'
    },
  });

  return handleResponse(response);
};

async function handleResponse(response) {
  try {
    const jsonResponse = await response.json();
    return {
      jsonResponse,
      httpStatusCode: response.status,
    };
  } catch (err) {
    const errorMessage = await response.text();
    throw new Error(errorMessage);
  }
}

app.post("/api/orders", async (req, res) => {
  try {
    // use the cart information passed from the front-end to calculate the order amount detals
    const { cart } = req.body;
    const { jsonResponse, httpStatusCode } = await createOrder(cart);
    res.status(httpStatusCode).json(jsonResponse);
  } catch (error) {
    console.error("Failed to create order:", error);
    res.status(500).json({ error: "Failed to create order." });
  }
});

app.post("/api/orders/:orderID/capture", async (req, res) => {
  try {
    const { orderID } = req.params;
    const { jsonResponse, httpStatusCode } = await captureOrder(orderID);
    res.status(httpStatusCode).json(jsonResponse);
  } catch (error) {
    console.error("Failed to create order:", error);
    res.status(500).json({ error: "Failed to capture order." });
  }
});

// serve index.html
app.get("/", (req, res) => {
  res.sendFile(path.resolve("./client/checkout.html"));
});

app.listen(PORT, () => {
  console.log(`Node server listening at http://localhost:${PORT}/`);
});
</script>