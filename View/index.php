<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<?php
require_once "Model/DBConfig.php";
require_once "Controller/CategoryController.php";
$db = new DB();
$categoryCL = new CategoryController($db->getConnection());


// Lấy số trang hiện tại từ tham số truy vấn
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;


// Số lượng danh mục hiển thị trên mỗi trang
$items_per_page = 10;

// Tính vị trí bắt đầu của danh sách trong cơ sở dữ liệu
$start_index = ($current_page - 1) * $items_per_page;

if (isset($_GET['page'])) {
    $categories = $categoryCL->getCategoriesByPage($start_index, $items_per_page);
} else {
    $categories = $categoryCL->getAllCategories();
}

// Tính tổng số trang dựa trên tổng số danh mục và số lượng danh mục trên mỗi trang
$total_pages = ceil(count($categories) / $items_per_page);
?>

<body>
    <div class="container">
        <h1>Categories</h1>
        <!-- Button trigger modal -->
        <form class="form-inline" id="search">
            <input class="form-control mr-sm-2 w-100" id="search_val" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0 invisible" type="submit">Search</button>
        </form>
        <button type="button" class="btn btn-primary float-left" onclick="openModalAdd()" data-toggle="modal" data-target="#exampleModal">
            Add Category
        </button>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Options</th>
            </tr>
            <?php
            function printCategoryTree($categories, $parentId = null, $depth = 0)
            {
                foreach ($categories as $category) {
                    if ($category->getParentCategoryId() == $parentId) {
                        echo '<tr>';
                        echo '<td scope="row">' . $category->getId() . '</td>';
                        echo '<td>' . str_repeat('&nbsp;-&nbsp;', $depth) . $category->getName() . '</td>';
                        echo '<td>';
                        echo '<a href="#" onclick="openModalEdit(' . $category->getId() . ', \'' . $category->getName() . '\', \'' . $category->getParentCategoryId() . '\')"><i data-toggle="modal" data-target="#exampleModal" class="bx bx-edit ml-2"></i></a>';
                        echo '<a href=" "><i class="bx bx-copy-alt ml-2" ></i></a>';
                        echo '<a href="delete.php?categoryId=' . $category->getId() . '"><i class="bx bx-trash ml-2"></i></a>';
                        echo '</td>';
                        echo '</tr>';

                        printCategoryTree($categories, $category->getId(), $depth + 1);
                    }
                }
            }
            printCategoryTree($categories);
            ?>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="cateForm">
                            <div class="form-group">
                                <label for="cateName">Category name</label>
                                <input type="text" name="cateName" class="form-control" id="cateName" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="parentname">Parent Category</label>
                                <select name="parentcateName" id="parentcateName" class="form-control">
                                    <option value="">--None--</option>
                                    <?php
                                    foreach ($categories as $pc) { ?>
                                        <option value="<?php echo $pc->getId(); ?>"><?php echo $pc->getName(); ?></option>

                                    <?php  } ?>
                                </select>
                            </div>
                            <button type="submit" id="submitButton" class="btn btn-primary mt-5">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo '<ul class="pagination">';
            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul>';
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">
        let currentParentId = null;

        //Mở form add
        function openModalAdd() {
            currentParentId = null;
            document.getElementById('exampleModalLabel').innerText = "Add Category"
            document.getElementById('cateName').value = ""
            document.getElementById('parentcateName').value = ""
            document.getElementById('submitButton').innerText = "Add"
        }
        //Mở form edit
        function openModalEdit($Parentid, $cateName, $parentcateName) {
            currentParentId = $Parentid;
            document.getElementById('exampleModalLabel').innerText = "Edit Category"
            document.getElementById('cateName').value = $cateName
            document.getElementById('parentcateName').value = $parentcateName
            document.getElementById('submitButton').innerText = "Edit"
        }

        //Xử lý khi submit form
        document.getElementById('cateForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(document.getElementById('cateForm'))

            if (currentParentId === null) {
                fetch('create.php', {
                        method: "POST",
                        body: formData
                    })
                    .then(res => {
                        location.reload();
                    })
                    .catch(error => {
                        console.log(error);
                    })
            } else {
                formData.append("categoryId", currentParentId);
                fetch('edit.php', {
                        method: "POST",
                        body: formData
                    })
                    .then(res => {
                        location.reload();
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        })
        // Xử lý tìm kiếm
        document.getElementById('search').addEventListener('submit', (e) => {
            e.preventDefault();
            console.log(e);
            const search_val = document.getElementById('search_val').value
            fetch('find.php?searchVal=' + search_val)
                .then(res => res.json())
                .then(function(data) {
                    console.log(data);
                    if (Array.isArray(data) && data[0] !== false) {
                        let htmls = data.map(function(data) {
                            return `<tr>
                                <th scope="row">${data.id}</th>
                                <td>${data.name}</td>
                                <td>
                                <a href=" "><i class="bx bx-edit ml-2" ></i></a>
                                <a href=" "><i class="bx bx-copy-alt ml-2" ></i></a>
                                <a href=" "><i class="bx bx-trash ml-2" ></i></a>
                                </td>
                                </tr>`;
                        });

                        let html = htmls.join('');
                        document.querySelector('.table').innerHTML = html;
                    } else {
                        alert('không tìm thấy kq')
                        location.reload();
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        })
    </script>
</body>

</html>