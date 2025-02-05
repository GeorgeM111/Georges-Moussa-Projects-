<?php
function printCategories(object $connection)
{
    $sql = "SELECT * FROM CATEGORY";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $stmt = null;
    if ($result) {
        while ($row = $result->fetch_assoc()) : ?>
            <option value="<?php echo $row['name'] ?>" class="text-center"><?php echo $row['name'] ?></option>
        <?php endwhile;
    }
}

function printItems(object $connection)
{
    $sql = "SELECT * FROM CATEGORY";
    $firstCategory = 0;

    $categRes = $connection->query($sql);
    while ($category = $categRes->fetch_assoc()) {
        $style = 'style="display:none;"';
        $query = "SELECT * FROM items where category_id = " . $category['id'];
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            $items = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $items = array();
        }
        if ($firstCategory === 0) {
            $style = 'style="display:block;"';
            $firstCategory++;
        }
        ?><section id="<?php echo $category['name'] ?>" <?php echo $style ?>>
            <div>
                <div class="row mb-3" id="<?php echo $category['id'] ?>">
                    <?php
                    foreach ($items as $item) :
                        $stock = "";
                        $unavailable_color = "";
                        $price = $item['PRICE'];
                        if ($item['stock'] == 'out') {
                            $stock = "out_of_stock";
                            $price = "UNAVAILABLE";
                            $unavailable_color = "text-danger";
                        }
                    ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-2 wow fadeInUp">
                            <div class="card">
                                <img class="card-img-top <?php echo $stock ?>" src="images/<?php echo $item['IMAGE'] ?>" alt="Card image">
                                <div class="card-body">
                                    <h6 class="card-title text-center  text-bold"><?php echo $item['NAME']; ?></h6>
                                    <hr>
                                    <h4 class="card-text text-center text-bold <?php echo $unavailable_color ?>">
                                        <?php echo $price;  ?>
                                    </h4>
                                </div>
                            </div>
                        </div>

                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </section>
<?php
    }
}
