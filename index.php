<?php include './extend/master.php' ?>

<div class="center-positioning">
<?php
$productos = "SELECT * FROM producto";
$productos = $conn->query($productos);
$count = mysqli_num_rows($productos);
if($count!=0){
  foreach($productos as $prod): ?>
    <a href=<?= "/details.php?id=" . $prod['id']?>>
        <div class="wrap">
          <div class="card center-positioning" style="--h: 430px; --w: 300px">
            <div class="card-image">
              <img src=<?=$prod['imagen']?> alt="card picture" />
            </div>
            <div class="card-body">
              <h3 ><?=$prod['nombre']?></h3>
              <p><?=$prod['descripcion']?></p>
              <h4><?=$prod['precio'] . "$" ?></h4>
            </div>
          </div>
        </div>
    </a>
  <?php endforeach;
}
?>
      </div>
<!-- Footer start -->
<?php include './extend/footer.php' ?>
<!-- Footer end-->
