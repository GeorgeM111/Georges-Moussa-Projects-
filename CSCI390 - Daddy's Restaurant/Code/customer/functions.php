<?php

declare(strict_types=1);
include "../database/db.php";

function printCategoryOptions(object $conn): void
{
    $sql = "SELECT * FROM CATEGORY";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    while ($row = $result->fetch_assoc()) :
?>
        <option value="<?php echo htmlspecialchars(strval($row['name']), ENT_QUOTES, 'UTF-8'); ?>" name="options"><?php echo htmlspecialchars(strval($row['name']), ENT_QUOTES, 'UTF-8'); ?></option>
        <?php endwhile;
}

function printItems(object $conn): void
{
    $sql = 'SELECT id,name FROM CATEGORY;';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $i = 0;
    $firstCategory = 0;
    while ($row = $result->fetch_assoc()) :
        $sql2 = "SELECT * FROM ITEM WHERE CATEGORY_ID = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $row['id']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $stmt2->close();
        if ($firstCategory == 0) { ?>
            <div name="categories">
            <?php $firstCategory++;
        } else { ?>
                <div name="categories" style="display:none;">
                <?php } ?>

                <div class="row g-4">
                    <h3 class="text-start pacifico pb-3"><?php echo  htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?> </h3>
                    <?php
                    $j = 0;
                    while ($row2 = $result2->fetch_assoc()) :
                        $floatPrice = number_format($row2['PRICE'], 2);
                        if ($j % 2 === 0) {
                            $animation = "fadeInLeft";
                        } else {
                            $animation = "fadeInRight";
                        }
                        if ($i == 0) { ?>
                            <div class="col-md-6">
                            <?php } ?>
                            <!--  -->
                            <div class="col-lg-12 wow mb-3 <?php echo htmlspecialchars(strval($animation), ENT_QUOTES, 'UTF-8'); ?>">
                                <?php $j++; ?>
                                <div class="d-flex align-items-center pb-3">
                                    <div class="position-relative">
                                        <img class="flex-shrink-0 img-fluid rounded" src="images/itemsImg/<?php echo htmlspecialchars(strval($row2['IMAGE']), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo $row2['IMAGE'] ?>" style="width: 80px;">
                                        <button class="btn btn-warning rounded-pill border border-1 end-0 fw-light position-absolute  addToCart" onclick="window.location.href='customize.php?itemID=<?php echo htmlspecialchars(strval($row2['ID']), ENT_QUOTES, 'UTF-8'); ?>';">
                                            <span class="fs-5 text-dark"><small><i class="fa-solid fa-cart-shopping"></i></small></span>
                                        </button>
                                    </div>
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <span><small><?php echo htmlspecialchars($row2['NAME'], ENT_QUOTES, 'UTF-8'); ?></small></span>
                                            <span class="text-warning me-3"><small><?php echo htmlspecialchars(strval($floatPrice), ENT_QUOTES, 'UTF-8'); ?>$</small></span>
                                        </h5>
                                        <small class="fst-italic"><?php echo htmlspecialchars($row2['DESCRIPTION'], ENT_QUOTES, 'UTF-8'); ?></small>
                                    </div>
                                </div>
                            </div>

                        <?php
                        $i++;
                        if ($result2->num_rows % 2 == 0) {
                            if ($i == $result2->num_rows / 2) echo '</div><div class="col mt-0">';
                        } else
                            if ($i - 0.5 == $result2->num_rows / 2) echo '</div><div class="col-md-6">';
                    endwhile; ?>
                            </div>
                            <hr>
                </div>
                <?php if ($result2->num_rows != 0) { ?>
                </div>

            <?php
                }
                $i = 0;
            endwhile;
        }


        function printCartItems(object $conn): void
        {
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
            <div class="row mt-3 mb-sm-5">
                <div class="col-md-8  mt-6" id="AddedItems">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody class="pe-0" id="tableBody">
                                <?php
                                $totalItems = 0;
                                $totalPrice = 0;
                                foreach ($_SESSION['cart'] as $index => $item) {
                                    $totalItems++;
                                    $sql = "SELECT * FROM ITEM WHERE ID = ?;";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("i", $item['id']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();

                                    if ($result->num_rows > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $floatPrice = number_format(floatval($item['price']), 2);
                                        $totalPrice += $floatPrice * $item['quantity'];
                                    } else {
                                        continue;
                                    }
                                ?>
                                    <tr class="rows">
                                        <td>
                                            <img class="flex-shrink-0 img-fluid rounded" src="images/itemsImg/<?php echo htmlspecialchars(strval($row['IMAGE']), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars(strval($row['NAME']), ENT_QUOTES, 'UTF-8'); ?>" style="width: 80px;">
                                        </td>
                                        <td><?php echo $row['NAME'] ?></td>
                                        <td class="w-25">
                                            <input type="number" class="w-100 quantity-input" id="quantity-<?php echo $index; ?>" data-id="<?php echo $index; ?>" value="<?php echo htmlspecialchars(strval($item['quantity']), ENT_QUOTES, 'UTF-8'); ?>">
                                        </td>
                                        <td>
                                            <span class="price"><?php echo htmlspecialchars(strval($floatPrice), ENT_QUOTES, 'UTF-8'); ?></span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal<?php echo htmlspecialchars(strval($item['indexID']), ENT_QUOTES, 'UTF-8'); ?>">
                                                Details
                                            </button>
                                            <div class="modal fade" id="myModal<?php echo htmlspecialchars(strval($item['indexID']), ENT_QUOTES, 'UTF-8'); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Details For : <?php echo htmlspecialchars(strval($row['NAME']), ENT_QUOTES, 'UTF-8'); ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Item Request :</h5>
                                                            <p>
                                                                <?php
                                                                if (!empty($item['request'])) {
                                                                    echo htmlspecialchars(strval($item['request']), ENT_QUOTES, 'UTF-8');;
                                                                } else {
                                                                    echo "<h6>No Request</h6>";
                                                                } ?>
                                                            </p>
                                                            <hr>
                                                            <h5>Removed Ingredients :</h5>
                                                            <?php
                                                            if (!in_array(0, $item['removedIngredients'])) {
                                                                echo "<ul>";
                                                                foreach ($item['removedIngredients'] as $ingredient) :
                                                                    $sql = "SELECT * FROM INGREDIENT WHERE ID = ?";
                                                                    $stmt = $conn->prepare($sql);
                                                                    $stmt->bind_param("i", $ingredient);
                                                                    $stmt->execute();
                                                                    $result = $stmt->get_result();
                                                                    $stmt->close();
                                                                    if ($result->num_rows > 0) {
                                                                        $ingredientRow = $result->fetch_assoc();
                                                                    }
                                                            ?>
                                                                    <li>
                                                                        <h6 class="d-flex justify-content-between pb-2">
                                                                            <span><?php echo htmlspecialchars($ingredientRow['NAME'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                                        </h6>
                                                                    </li>
                                                            <?php endforeach;
                                                                echo "</ul>";
                                                            } else {
                                                                echo "<h6>No Removed Ingredients</h6>";
                                                            }
                                                            ?>

                                                            <hr>
                                                            <h5>Added Ingredients :</h5>
                                                            <?php
                                                            if (!in_array(0, $item['addedIngredients'])) {
                                                                echo "<ul>";
                                                                foreach ($item['addedIngredients'] as $ingredient) :
                                                                    $sql = "SELECT * FROM INGREDIENT WHERE ID = ?";
                                                                    $stmt = $conn->prepare($sql);
                                                                    $stmt->bind_param("i", $ingredient);
                                                                    $stmt->execute();
                                                                    $result = $stmt->get_result();
                                                                    $stmt->close();
                                                                    if ($result->num_rows > 0) {
                                                                        $ingredientRow = $result->fetch_assoc();

                                                            ?>
                                                                        <li>
                                                                            <h6 class="d-flex justify-content-between pb-2">
                                                                                <span><?php echo htmlspecialchars($ingredientRow['NAME'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                                                <span class="text-warning me-3"><?php echo "(+" . htmlspecialchars(strval($ingredientRow['PRICE']), ENT_QUOTES, 'UTF-8') . ")"; ?></span>
                                                                            </h6>
                                                                        </li>
                                                            <?php }
                                                                endforeach;
                                                                echo "</ul>";
                                                            } else {
                                                                echo "<h6>No Added Ingredients</h6>";
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <a href="#" class="remove text-warning text-nowrap text-decoration-none" onclick="removeFromCart(<?php echo htmlspecialchars(strval($item['id']), ENT_QUOTES, 'UTF-8'); ?>)"><i class="fa-solid fa-trash-can"></i>Remove</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="check border bg-white">
                        <div class="mt-3">
                            <h4 class="text-center">Summary</h4>
                            <h6 class="d-flex justify-content-between  pb-2 me-3 ms-3">
                                <span>Total Items</span>
                                <span class="text-success" id="totalItems"><?php echo htmlspecialchars(strval($totalItems), ENT_QUOTES, 'UTF-8'); ?></span>
                            </h6>
                            <hr class="me-5 ms-5">
                            <h6 class="d-flex justify-content-between  pb-2 me-3 ms-3">
                                <span>Total</span>
                                <span class="text-secondary" id="totalPrice"><?php echo htmlspecialchars(strval($totalPrice), ENT_QUOTES, 'UTF-8'); ?> $</span>
                            </h6>
                            <div class="me-5 ms-5 mb-3">
                                <?php
                                $kitchenSQL = "SELECT KITCHEN_STATUS FROM RESTAURANT";
                                $kitchenSTMT = $conn->prepare($kitchenSQL);
                                $kitchenSTMT->execute();
                                $kitchenResult = $kitchenSTMT->get_result();
                                $kitchenSTMT->close();
                                if ($kitchenResult->num_rows > 0) {
                                    $kitchen = $kitchenResult->fetch_assoc();
                                    $status = $kitchen['KITCHEN_STATUS'];
                                    $disabled = "";
                                    $message = '';
                                    if ($status === "Busy") {
                                        $message = '<p class="text-warning"><small>* Please note that the kitchen is currently busy, therefore your order might take a bit longer than usual.</small></p>';
                                    } else if ($status === "Closed") {
                                        $message = '<p class="text-danger"><small>* The kitchen is currently closed, please try again during our opening hours !</small></p>';
                                        $disabled = "disabled";
                                    }
                                }
                                ?>

                                <form action="checkout.php">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-warning btn-block" <?php echo htmlspecialchars(strval($disabled), ENT_QUOTES, 'UTF-8'); ?>>Checkout</button>
                                    </div>
                                </form>
                                <?php echo $message ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            ?>
        <?php } else { ?>
            <div class="col-12 mx-auto d-block">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="images/dish.png" class="mt-4 mb-1" alt="Empty Cart" style="width:17%;">
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <h1 class="display-2 pacifico mb-3 mt-0">Cart is empty</h1>
                </div>
            </div>
        <?php     }
        }

        function printCheckoutItems(object $conn): void
        {
        ?>
        <div class="table-responsive mx-3 mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody class="pe-0" id="tableBody">
                <tbody class="pe-0" id="tableBody">
                    <?php
                    $totalItems = 0;
                    $totalPrice = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $totalItems++;
                        $sql = "SELECT * FROM ITEM WHERE ID = ?;";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $item['id']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();

                        if ($result->num_rows > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $floatPrice = number_format(floatval($item['price']), 2);
                            $totalPrice += $floatPrice * $item['quantity'];
                        } else {
                            continue;
                        }
                    ?>
                        <tr class="rows">
                            <td>
                                <img class="flex-shrink-0 img-fluid rounded" src="images/itemsImg/<?php echo htmlspecialchars(strval($row['IMAGE']), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars(strval($row['NAME']), ENT_QUOTES, 'UTF-8'); ?>" style="width: 80px;">
                            </td>
                            <td><?php echo htmlspecialchars(strval($row['DESCRIPTION']), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <span class="price"><?php echo htmlspecialchars(strval($floatPrice), ENT_QUOTES, 'UTF-8'); ?></span>
                            </td>
                            <td>
                                <span class="Quantity"><?php echo htmlspecialchars(strval($item['quantity']), ENT_QUOTES, 'UTF-8'); ?></span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal<?php echo htmlspecialchars(strval($item['indexID']), ENT_QUOTES, 'UTF-8'); ?>">
                                    Details
                                </button>
                                <div class="modal fade" id="myModal<?php echo htmlspecialchars(strval($item['indexID']), ENT_QUOTES, 'UTF-8'); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Details For : <?php echo htmlspecialchars(strval($row['NAME']), ENT_QUOTES, 'UTF-8'); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Item Request :</h5>
                                                <p>
                                                    <?php
                                                    if (!empty($item['request'])) {
                                                        echo htmlspecialchars(strval($item['request']), ENT_QUOTES, 'UTF-8');
                                                    } else {
                                                        echo "<h6>No Request</h6>";
                                                    } ?>
                                                </p>
                                                <hr>
                                                <h5>Removed Ingredients :</h5>
                                                <?php
                                                if (!in_array(0, $item['removedIngredients'])) {
                                                    echo "<ul>";
                                                    foreach ($item['removedIngredients'] as $ingredient) :
                                                        $sql = "SELECT * FROM INGREDIENT WHERE ID = ?";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->bind_param("i", $ingredient);
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();
                                                        $stmt->close();
                                                        if ($result->num_rows > 0) {
                                                            $ingredientRow = $result->fetch_assoc();
                                                        }
                                                ?>
                                                        <li>
                                                            <h6 class="d-flex justify-content-between pb-2">
                                                                <span><?php echo htmlspecialchars($ingredientRow['NAME'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                            </h6>
                                                        </li>
                                                <?php endforeach;
                                                    echo "</ul>";
                                                } else {
                                                    echo "<h6>No Removed Ingredients</h6>";
                                                }
                                                ?>

                                                <hr>
                                                <h5>Added Ingredients :</h5>
                                                <?php
                                                if (!empty($item['addedIngredients'])) {
                                                    echo "<ul>";
                                                    foreach ($item['addedIngredients'] as $ingredient) :
                                                        $sql = "SELECT * FROM INGREDIENT WHERE ID = ?";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->bind_param("i", $ingredient);
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();
                                                        $stmt->close();
                                                        if ($result->num_rows > 0) {
                                                            $ingredientRow = $result->fetch_assoc();

                                                ?>
                                                            <li>
                                                                <h6 class="d-flex justify-content-between pb-2">
                                                                    <span><?php echo htmlspecialchars($ingredientRow['NAME'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                                    <span class="text-warning me-3"><?php echo "(+" . htmlspecialchars(strval($ingredientRow['PRICE']), ENT_QUOTES, 'UTF-8') . ")"; ?></span>
                                                                </h6>
                                                            </li>
                                                <?php }
                                                    endforeach;
                                                    echo strval("</ul>");
                                                } else {
                                                    echo "<h6>No Added Ingredients</h6>";
                                                }
                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                </tbody>
            </table>
        </div>

        <div class="container  mb-3">
            <div class="check border bg-white">
                <div class="mt-3">
                    <h4 class="text-center">Summary</h4>
                    <h6 class="d-flex justify-content-between  pb-2 me-3 ms-3">
                        <span>Total Items</span>
                        <span class="text-success" id="totalItems"><?php echo htmlspecialchars(strval($totalItems), ENT_QUOTES, 'UTF-8'); ?></span>
                    </h6>
                    <hr class="me-5 ms-5">
                    <h6 class="d-flex justify-content-between  pb-2 me-3 ms-3">
                        <span>Total</span>
                        <span class="text-secondary" id="totalPrice"><?php echo htmlspecialchars(strval($totalPrice), ENT_QUOTES, 'UTF-8'); ?> $</span>
                    </h6>
                </div>
            </div>
        </div>
        <div class="row mx-2 mb-3">
            <div class="check border bg-white">
                <div class="mt-3">
                    <h4 class="text-center">Select Dining Option</h4>
                    <hr class="me-5 ms-5">
                    <div class="row mb-2">
                        <div class="col-md-6 col-sm-6 col-6 text-center border-end border-dark mt-1">
                            <button data-bs-toggle="collapse" data-bs-target="#dineIn" class="btn btn-warning" id="dineInButton">Dine In</button>
                            <div id="dineIn" class="collapse show">
                                <form action="placeOrder.php" method="post">
                                    <label for="tableNb">Please Enter Your Table Number</label>
                                    <input type="number" name="tableNumber" id="tableNb" class="pb-1 w-75 mb-2" required>
                                    <button type="submit" class="btn btn-warning">Place Order</button>
                                    <input type="hidden" name="total" value="<?php echo htmlspecialchars(strval($totalPrice), ENT_QUOTES, 'UTF-8'); ?>">
                                </form>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 text-center mt-1">
                            <button data-bs-toggle="collapse" data-bs-target="#dineOut" class="btn btn-warning" id="dineOutButton">Dine Out</button>
                            <div id="dineOut" class="collapse">
                                <?php
                                if (!isset($_SESSION['loginCredentials'])) { ?>
                                    <a href="login.php" class="btn-warning btn mt-2">Login</a>
                                <?php  } else { ?>
                                    <div class="row mb-2 text-center border-end border-dark mt-1">
                                        <div class="d-flex justify-content-center align-items-center px-3">
                                            <form action="placeOrder.php" method="post" class="mt-2">
                                                <select name="dineOutOptions" id="dineOutSelect" onchange="dineOut()" class="mb-2 form-control text-center">
                                                    <option value="Pickup">Pickup</option>
                                                    <option value="Delivery">Delivery</option>
                                                </select>
                                                <div id="address" style="display: none;">
                                                    <label for="addressInput">Please Enter Your Address</label>
                                                    <?php
                                                    $value = "";
                                                    $required = "";
                                                    if (!isset($_SESSION['loginCredentials']['address'])) {
                                                        $required = "required";
                                                    } else {
                                                        $value = $_SESSION['loginCredentials']['address'];
                                                    } ?>
                                                    <input type="text" name="addressVal" id="addressInput" value="<?php echo htmlspecialchars(strval($value), ENT_QUOTES, 'UTF-8'); ?>" class="pb-1 w-75 mb-2">
                                                    <br>
                                                </div>
                                                <br>
                                                <input type="hidden" name="total" value="<?php echo htmlspecialchars(strval($totalPrice), ENT_QUOTES, 'UTF-8'); ?>">
                                                <button type="submit" class="btn btn-warning">Place Order</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            </div>

        <?php
        }

        function printAbout(object $conn)
        {
            $sql = "SELECT ABOUT1,ABOUT2,YEARS FROM RESTAURANT";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $row = $result->fetch_assoc();
            $about1 = $row['ABOUT1'];
            $about2 = $row['ABOUT2'];
            $years = $row['YEARS'];
        ?>
            <div class="col-lg-6 text-center wow slideInDown " id="about">
                <h3 class="section-title text-warning pacifico">About Us</h3>
                <h2 class="mb-4 wow fadeIn" data-wow-delay="0.7s">Welcome to <i class="fa fa-utensils text-warning me-2"></i>Daddy's Restaurant</h2>
                <p class="mb-4 wow fadeInLeft" data-wow-delay="1s"><?php echo htmlspecialchars(strval($about1), ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="mb-4 wow fadeInRight" data-wow-delay="1s"><?php echo htmlspecialchars(strval($about2), ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="row g-4 mb-4">
                        <div class="d-flex align-items-center border-start border-5 border-warning px-3 wow rotateInUpLeft" data-wow-delay="0.5s">
                            <h1 class="display-5 text-warning mb-0" data-toggle="counter-up"><?php echo htmlspecialchars(strval($years), ENT_QUOTES, 'UTF-8'); ?></h1>
                            <div class="ps-4 text-start">
                                <p class="mb-0">Years of</p>
                                <h6 class="mb-0">EXPERIENCE</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        $query = "SELECT PHONE,EMAIL,INSTAGRAM,FACEBOOK FROM RESTAURANT";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        $phoneNumber = $row['PHONE'];
        $email = $row['EMAIL'];
        $instagram = $row['INSTAGRAM'];
        $facebook = $row['FACEBOOK'];


        function printFeauturedItems(object $conn)
        {
            $sql = "SELECT ITEM_ID FROM FEATURED";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if ($result->num_rows > 0) {
                $first_item = 1;
                $featured_num = $result->num_rows;
            ?>
                <div id="slideshow" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php
                        for ($i = 0; $i < $featured_num; $i++) {
                            $class = "";
                            if ($first_item == 1) {
                                $class = 'class="active"';
                                $first_item++;
                            }
                        ?>
                            <button type="button" data-bs-target="#slideshow" data-bs-slide-to="<?php echo $i ?>" <?php echo $class ?> aria-current="true" aria-label="Slide <?php echo $i + 1 ?>"></button>
                        <?php
                        } ?>
                    </div>
                    <div class="carousel-inner">
                        <?php
                        $first_item = 1;
                        while ($row = $result->fetch_assoc()) {
                            $sql2 = "SELECT NAME,IMAGE FROM ITEM WHERE ID = ?";
                            $stmt2 = $conn->prepare($sql2);
                            $stmt2->bind_param("i", $row['ITEM_ID']);
                            $stmt2->execute();
                            $result2 = $stmt2->get_result();
                            $stmt2->close();
                            if ($result2->num_rows > 0) {
                                $class = "";
                                if ($first_item == 1) {
                                    $class = 'active';
                                    $first_item++;
                                }
                                $item = $result2->fetch_assoc();
                                $img = $item['IMAGE'];
                                $name = $item['NAME'];

                        ?>
                                <div class="carousel-item <?php echo $class ?>">
                                    <img src="images/itemsImg/<?php echo $img ?>" class="d-block w-100 h-100 img-fluid" alt="<?php echo $name ?>">
                                </div>


                        <?php
                            }
                        } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            <?php

            }
        }



        function printRecommendedItems(object $conn)
        {
            $sql = "SELECT ITEM_ID FROM RECOMMENDED";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if ($result->num_rows > 0) {
                $first_item = 1;
                $featured_num = $result->num_rows;
            ?>
                <div id="slideshow2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php
                        for ($i = 0; $i < $featured_num; $i++) {
                            $class = "";
                            if ($first_item == 1) {
                                $class = 'class="active"';
                                $first_item++;
                            }
                        ?>
                            <button type="button" data-bs-target="#slideshow2" data-bs-slide-to="<?php echo $i ?>" <?php echo $class ?> aria-current="true" aria-label="Slide <?php echo $i + 1 ?>"></button>
                        <?php
                        } ?>
                    </div>
                    <div class="carousel-inner">
                        <?php
                        $first_item = 1;
                        while ($row = $result->fetch_assoc()) {
                            $sql2 = "SELECT NAME,IMAGE FROM ITEM WHERE ID = ?";
                            $stmt2 = $conn->prepare($sql2);
                            $stmt2->bind_param("i", $row['ITEM_ID']);
                            $stmt2->execute();
                            $result2 = $stmt2->get_result();
                            $stmt2->close();
                            if ($result2->num_rows > 0) {
                                $class = "";
                                if ($first_item == 1) {
                                    $class = 'active';
                                    $first_item++;
                                }
                                $item = $result2->fetch_assoc();
                                $img = $item['IMAGE'];
                                $name = $item['NAME'];

                        ?>
                                <div class="carousel-item <?php echo $class ?>">
                                    <img src="images/itemsImg/<?php echo $img ?>" class="d-block w-100 h-100 img-fluid" alt="<?php echo $name ?>">
                                </div>


                        <?php
                            }
                        } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#slideshow2" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#slideshow2" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
        <?php

            }
        }
