<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
  <div class="col-md-3"></div>       <!-- Just Padding  -->
  <div class="col-md-5">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>
      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save_task.php" method="POST" enctype="multipart/form-data">

        <div class="title form-group" >
            <h1> Add Product </h1>
          </div>

          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Product Name" autofocus>
          </div>

          <div class="form-group">
            <input type="number" name="price" class="form-control" placeholder="cost" min="0" autofocus>
          </div>

          <div class="form-group">
                <select class="form-control" id="exampleFormControlSelect1" name="category">
                  <option value="1" disabled selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
          </div>

        <div class="input-group ">
          <div class="custom-file">
            <input type="file" name="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
          </div>
        </div>

          <input type="submit" name="save_task" class="btn btn-success btn-block" value="Add Product">
        </form>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      </div>
    </div>

    </div>

  </div>
</main>


 <?php include('includes/footer.php'); ?>



