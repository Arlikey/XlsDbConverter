<!doctype html>
<html lang="en">

<?php
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body data-bs-theme="dark">
    <div class="vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1 class="mb-4">Excel <i class="bi bi-arrows"></i> Database</h1>
        <?php if (isset($_SESSION['success'])): ?>
            <p class="text-success mb-3 h5" data-bs-success><?= $_SESSION['success'] ?></p>
            <?php unset($_SESSION['success']); ?>
        <?php endif ?>
        <div class="col-3 mb-3">
            <a href="excel.php" class="btn btn-outline-secondary d-flex gap-2 justify-content-center"><i
                    class="bi bi-download"></i>Export
                to Excel</a>
        </div>
        <div class="col-3">
            <form action="excel.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="file" class="form-control" name="excel_file" accept=".xlsx,.xls"
                        aria-describedby="Upload" aria-label="Upload">
                    <button class="btn btn-outline-secondary d-flex gap-2" type="submit"><i
                            class="bi bi-upload"></i>Import to database</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>