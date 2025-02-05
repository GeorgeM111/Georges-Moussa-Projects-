<?php
include "../database/database.php";

function printNumberOfItems(object $connection)
{
    $query = "SELECT * FROM ITEMS";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $statement->close();
    echo $result->num_rows;
}

function printItemsForDelete(object $connection)
{
    $query = "SELECT * FROM CATEGORY";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $statement->close();
?>
    <div class="col table-responsive">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    $query2 = "SELECT * FROM ITEMS WHERE CATEGORY_ID = ?";
                    $statement2 = $connection->prepare($query2);
                    $statement2->bind_param("i", $row['id']);
                    $statement2->execute();
                    $result2 = $statement2->get_result();
                    $statement2->close();
                    while ($row2 = $result2->fetch_assoc()) {
                ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($i); ?>
                            </td>
                            <td>
                                <img class="flex-shrink-0 img-fluid rounded" style="width:60px;" src="../customer/images/items/<?php echo htmlspecialchars($row2["IMAGE"]) ?>">
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row2['NAME']) ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row2['PRICE']) ?>
                            </td>
                            <td>
                                <?php
                                echo htmlspecialchars($row['name']) ?>
                            </td>
                            <td>
                                <button onclick="removeItem(<?php echo htmlspecialchars($row2['ID']) ?>)" class="btn btn-danger">Remove</button>
                            </td>
                        </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}

function printItems(object $connection)
{
    $query = "SELECT * FROM CATEGORY";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $statement->close();
?>
    <div class="col table-responsive">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    $query2 = "SELECT * FROM ITEMS WHERE CATEGORY_ID = ?";
                    $statement2 = $connection->prepare($query2);
                    $statement2->bind_param("i", $row['id']);
                    $statement2->execute();
                    $result2 = $statement2->get_result();
                    $statement2->close();
                    while ($row2 = $result2->fetch_assoc()) {
                ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($i); ?>
                            </td>
                            <td>
                                <img class="flex-shrink-0 img-fluid rounded" style="width:60px;" src="../customer/images/items/<?php echo htmlspecialchars($row2["IMAGE"]) ?>">
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row2['NAME']) ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row2['PRICE']) ?>
                            </td>
                            <td>
                                <?php
                                echo htmlspecialchars($row['name']) ?>
                            </td>
                            <td>
                                <a href="editItemForm.php?token=<?php echo htmlspecialchars($row2['ID']) ?>" class="btn btn-danger">Edit</a>
                            </td>
                        </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}

function printItemsForStock(object $connection)
{
    $query = "SELECT * FROM CATEGORY";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $statement->close();
?>
    <div class="col table-responsive">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Edit Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    $query2 = "SELECT * FROM ITEMS WHERE CATEGORY_ID = ?";
                    $statement2 = $connection->prepare($query2);
                    $statement2->bind_param("i", $row['id']);
                    $statement2->execute();
                    $result2 = $statement2->get_result();
                    $statement2->close();
                    while ($row2 = $result2->fetch_assoc()) {
                ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($i); ?>
                            </td>
                            <td>
                                <img class="flex-shrink-0 img-fluid rounded" style="width:60px;" src="../customer/images/items/<?php echo htmlspecialchars($row2["IMAGE"]) ?>">
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row2['NAME']) ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row2['PRICE']) ?>
                            </td>
                            <td>
                                <?php
                                echo htmlspecialchars($row['name']) ?>
                            </td>
                            <td>
                                <button onclick="toggleStock(<?php echo htmlspecialchars($row2['ID']) ?>,'<?php echo htmlspecialchars($row2['stock']) ?>')" class="btn btn-danger">
                                    <?php
                                    if ($row2['stock'] === 'in') {
                                        echo htmlspecialchars('Remove');
                                    } else {
                                        echo htmlspecialchars('Add');
                                    }
                                    ?>
                                </button>
                            </td>
                        </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}
