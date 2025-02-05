<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="css/style.css">
  <title>Items Management</title>
  <style>
    .custom-select {
      color: white;
      border: none;
      border-radius: 5px;
      padding: 10px;
      font-size: 16px;
    }

    .page-btn.active {
      background-color: #0d6efd;
      color: white;
    }

    .custom-select:focus {
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<?php include "../database/db.php" ?>

<body>
  <?php include "navbar.php"; ?>
  <div class="d-flex" id="wrapper">
    <?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
      <div class="container-fluid border-top border-dark border-top-3 px-4">
        <div class="row my-4">
          <div class="col-md-3">
            <div class="card shadow-sm">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="card-title">
                    <?php
                    $query = "SELECT * FROM ITEM";
                    $result = $conn->query($query)->fetch_all();
                    echo count($result);
                    ?>
                  </h3>
                  <p class="mb-0">Items</p>
                </div>
                <div>
                  <i class="fas fa-gift fa-2x text-primary"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-6">
            <div class="input-group">
              <input type="text" id="search-input" class="form-control" placeholder="Search items by name or description">
              <button class="btn btn-primary" id="search-btn">Search</button>
            </div>
          </div>
        </div>
        <div class="row my-4">
          <h3 class="fs-4 mb-3">Available Items</h3>
          <div class="col">
            <div class="table-responsive">
              <table class="table bg-white rounded shadow-sm table-hover">
                <thead>
                  <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
              </table>
            </div>
            <div class="pagination d-flex justify-content-center" id="pagination-controls">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");
    if (toggleButton) {
      toggleButton.onclick = function() {
        el.classList.toggle("toggled");
      };
    }

    var currentPage = 1;

    function loadItems(page) {
      currentPage = page;
      var searchQuery = $("#search-input").val();
      $.ajax({
        url: "fetch_items.php",
        type: "GET",
        data: {
          page: page,
          search: searchQuery
        },
        dataType: "json",
        success: function(response) {
          if (!response.data || response.data.length === 0) {
            $("#table-body").html("<tr><td colspan='6' class='text-center'>No items available</td></tr>");
            $("#pagination-controls").empty();
            return;
          }
          $("#table-body").empty();
          $.each(response.data, function(index, item) {
            let row = `
              <tr>
                <td>${item.id}</td>
                <td>
                  <img class="img-fluid rounded" style="width:60px;" src="../customer/images/itemsImg/${item.image}" alt="${item.name}">
                </td>
                <td>${item.name}</td>
                <td>${item.price} $</td>
                <td>${item.description}</td>
                <td>
                  <button class="btn btn-danger" onclick="editDetails(${item.id})">Modify</button>
                </td>
              </tr>
            `;
            $("#table-body").append(row);
          });
          $("#pagination-controls").empty();
          for (let i = 1; i <= response.totalPages; i++) {
            $("#pagination-controls").append(`
              <button class="btn btn-secondary mx-1 page-btn ${i === page ? 'active' : ''}" data-page="${i}">${i}</button>
            `);
          }
        },
        error: function(xhr, status, error) {
          console.error("AJAX Error:", error);
        }
      });
    }

    $(document).ready(function() {
      loadItems(1);
      $(document).on("click", ".page-btn", function() {
        var page = $(this).data("page");
        loadItems(page);
      });
      $("#search-btn").on("click", function() {
        loadItems(1);
      });
      $("#search-input").on("keypress", function(e) {
        if (e.which === 13) {
          loadItems(1);
        }
      });
    });

    function editDetails(id) {
      window.location.href = "editItem.php?itemID=" + id;
    }
  </script>
</body>

</html>