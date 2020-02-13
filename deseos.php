<?php include './extend/master.php' ?>
<body>
<div id="content-list" class="center-positioning">
    <?php
      $iduser = $_SESSION['id'];
      $buscarLista = "SELECT * FROM lista_de_deseos
        WHERE id_cliente = '$iduser'";
      $result = $conn->query($buscarLista);
      $lista = $result->fetch_object();
      $deseos = "SELECT * FROM detalle_lista_de_deseos
        WHERE id_lista_de_deseos = '$lista->id'";
      $deseos = $conn->query($deseos);
      $count = mysqli_num_rows($deseos);
      if($count!=0){
        foreach($deseos as $wish):
          $w=$wish['id_producto'];
          $producto = "SELECT * FROM producto
            WHERE id = '$w'";
          $prod = $conn->query($producto);
          $count2 = mysqli_num_rows($prod);
          if($count!=0){
            $prod=$prod->fetch_object();
        ?>
          <a href=<?= "/details.php?id=" . $prod->id?>>
        <div class="wrap">
          <div class="card center-positioning" style="--h: 430px; --w: 300px">
            <div class="card-image">
              <img src=<?=$prod->imagen?> alt="card picture" />
            </div>
            <div class="card-body">
              <h3 ><?=$prod->nombre?></h3>
              <p><?=$prod->descripcion?></p>
              <h4><?=$prod->precio . "$" ?></h4>
            </div>
          </div>
        </div>
    </a>
        <?php
          } 
        endforeach;
}
?>
  </div>
</body>
<!-- Footer start -->
<?php include './extend/footer.php' ?>
<!-- Footer end-->