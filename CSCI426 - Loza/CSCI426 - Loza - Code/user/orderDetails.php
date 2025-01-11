<!DOCTYPE html>
<html lang="en">
<?php ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <title>Loza Chocolatier</title>
  <link href="img/logo.png" rel="icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="style/animate.css">
</head>

<body>
  <div class="container-fluid px-0 mx-0">
    <?php include "header.php"; ?>
    <div class="row m-4">
      <div class="col-sm-6 text-center">
      <h1 class="italianno-regular text-bold" id="totalPriceElement"></h1>
      </div>
      <div class="col-sm-6 text-center">
      <button class="btn btn-warning mt-2" onclick="exportToPDF()">Save as PDF</button>
      <button class="btn btn-info mt-2" onclick="exportCartAsCSV()">Export as CSV</button>
      </div>
    </div>

    <div class=" checkout-btn mt-3 me-3 ">
      
    </div>
  <div class="row mx-3">
    <table class="table italiana-regular text-bold fs-5">
      <thead>
        <tr>
          <th>Product Image</th>
          <th>Product Name </th>
          <th>Cover Color</th>
          <th>Quantity</th>
          <th>Unit Price</th>
        </tr>
      </thead>
      <!-- class : rows / id : pic item cover qtite price -->
      <tbody>
        <?php
        include "../Database/db.php";
        $orderID = $_GET['orderID'];
        $sql = "SELECT * FROM order_details WHERE ORDER_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$orderID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $total = 0;
        $i = 0;
        while ($item = $result->fetch_assoc()) {
            $query = "SELECT * FROM chocolates
 WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i",$item['chocolate_id']);
            $stmt->execute();
            $chocres=$stmt->get_result();
            $stmt->close();
            $choc = $chocres->fetch_assoc();
             ?>
          <tr class="rows">
            <td id="pic">
              <img src="img/store/<?php echo $choc['name']; ?>.jpg" alt="Product Image" width="80px" class="flex-shrink-0 img-fluid rounded">
            </td>
            <td id="item">
            <?php echo $choc['name']; ?>
            </td>
            <td id="cover">
            <?php echo $item['cover']; ?>
          </td>
          <td id="qtite">
            <?php echo $item['quantity']; ?>
          </td>
          <td id="price">
            <?php echo $item['price']; ?>
          </td>
          </tr>
          <?php
        $itemPrice = $item['price'] * $item['quantity'];
        $total += $itemPrice;
        $i++;
      } ?>
      </tbody>
    </table>
    <input type="hidden" id="totalPrice" value="<?php echo $total; ?>" >
  </div>
  <p class="text-end pe-3"><button class="btn btn-warning" onclick="goBack()">Go Back</button></p>
  </div>
  <?php include "footer.php"; ?>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
         function goBack(){
        window.location.href = "orders.php";
      }
    document.getElementById("totalPriceElement").innerHTML="Total Price :"+document.getElementById("totalPrice").value +"$";
    function exportToPDF() {
      var cartItems = [];

      // Iterate through each item row in the HTML
      $('.rows').each(function(index, element) {

        var pic = $(element).find('#pic').text().trim();
        var itemName = $(element).find('#item').text().trim();
        var cover = $(element).find('#cover').text().trim();
        var price = parseFloat($(element).find('#price').text().trim()); // Added closing parenthesis
        var quantity = parseFloat($(element).find('#qtite').text().trim()); // Added closing parenthesis

        // Create an object with item details
        var item = {
          pic: pic,
          name: itemName,
          cover: cover,
          price: price,
          quantity: quantity
        };

        // Add the item to the cartItems array
        cartItems.push(item);
      });

      // Convert the cartItems array to JSON string
      var cartItemsJSON = JSON.stringify(cartItems);

      // Create a form element
      var form = document.createElement('form');
      form.method = 'POST';
      form.action = 'pdf.php';

      // Create a hidden input field to hold the JSON data
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'cartItems';
      input.value = cartItemsJSON;

      // Append the input field to the form
      form.appendChild(input);

      // Append the form to the document body and submit it
      document.body.appendChild(form);
      form.submit();
    }


    function exportCartAsCSV() {
      var cartItems = [];

      // Iterate through each item row in the HTML
      $('.rows').each(function(index, element) {

        var itemName = $(element).find('#item').text().trim();
        var cover = $(element).find('#cover').text().trim();
        var price = parseFloat($(element).find('#price').text().trim()); // Added closing parenthesis
        var quantity = parseFloat($(element).find('#qtite').text().trim()); // Added closing parenthesis

        // Create an object with item details
        var item = {
          name: itemName,
          cover: cover,
          price: price,
          quantity: quantity
        };

        // Add the item to the cartItems array
        cartItems.push(item);
      });


      // Convert cartItems to CSV format
      var itemTotalSum = 0;
      var csvContent = 'Name,Cover,Price,Quantity,Total Price\n';
      cartItems.forEach(function(item) {
        var total = item.price * item.quantity;
        itemTotalSum += total;
        csvContent += `${item.name},${item.cover},${item.price},${item.quantity},${total}\n`;
      });
      csvContent += `,,,Total:,${itemTotalSum}\n`;


      // Create a Blob containing the CSV data
      var blob = new Blob([csvContent], {
        type: 'text/csv'
      });

      // Create a download link
      var link = document.createElement('a');
      link.href = window.URL.createObjectURL(blob);
      link.download = 'cart_items.csv';

      // Append the link to the document and trigger a click
      document.body.appendChild(link);
      link.click();

      // Clean up
      document.body.removeChild(link);
    }
  </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
</body>

</html>