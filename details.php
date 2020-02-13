<?php include './extend/master.php' ?>
<?php
    $url = $_GET['id'];
    if ( isset( $url ) ){
        $buscarProducto = "SELECT * FROM producto
	    WHERE id = '$url' ";
	    $result = $conn->query($buscarProducto);
	    $count = mysqli_num_rows($result);
	    if ($count == 0) {
            header('Location: '.'/');
        } else {
            $prod = $result->fetch_object();
            $buscarImagenes = "SELECT * FROM other_images
	        WHERE id_producto = '$url' ";
	        $images = $conn->query($buscarImagenes);
          $count = mysqli_num_rows($images);
          $click=$prod->click+1;
          $sql = "UPDATE producto SET click= '$click' WHERE id= '$url'";
                    if ($conn->multi_query($sql) === TRUE) {
                    }
            ?>
    <div class="slideshow-container">
    <h1><?= $prod->nombre ?></h1>
    <div class="mySlides fade">
        <img src=<?= $prod->imagen ?> style="width:100%">
    </div>
    <?php while($img = mysqli_fetch_object($images)){ ?>
    <div class="mySlides fade">
        <img src=<?= $img->imagen ?> style="width:100%">
    </div>
    <?php } ?>
    <br>
    <!-- The dots/circles -->
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <?php 
        if ($count>=1){
          $range=$count+1;
        foreach(range(2, $range ) as $número): ?>
        <span class="dot" onclick="currentSlide(<?= $número  ?>)"></span>
        <?php endforeach;} ?>
    </div>
</div>
<div class="content-info">
    <h1><?= $prod->nombre ?></h1>
    <hr>
    <h3>Detalles</h3>
    <p><?= $prod->descripcion ?></p>
    <p style="font-size: 20px">Precio: <strong><?= $prod->precio ?>$</strong></p>
    <?php
    if($prod->inventario!=0){
        ?>
        <label for="qty">Cantidad: </label>
    <select name="qty" id="qty">
        <?php
    foreach(range(1, $prod->inventario) as $número): ?>
        <option value=<?=  $número ?>><?=  $número ?></option>
    <?php endforeach;} ?>
    </select>
    <hr>
    <?php
    if($prod->inventario!=0){
        ?>
        <p style="color: darkgreen; font-size: 20px"><strong>En existencia</strong></p>
    <button class="btn btn-3 btn-3a" onclick="agregar(<?= $prod->id ?>)"><i class="fas fa-shopping-cart"></i> Agregar al Carro</button>
    <button class="btn btn-3 btn-3a" onclick="comprar(<?= $prod->id ?>)"><i class="fas fa-money-bill"></i> Comprar ahora</button>
        <?php
    }else{
        ?>
        <p style="color: darkred; font-size: 20px"><strong>No disponible</strong></p>
        <?php
    }
    if ($has_session = session_status() == PHP_SESSION_ACTIVE) {
        if(isset($_SESSION['id'])){
    $iduser = $_SESSION['id'];
    $buscarLista = "SELECT * FROM lista_de_deseos
        WHERE id_cliente = '$iduser'";
    $result = $conn->query($buscarLista);
    $lista = $result->fetch_object();
    $buscarInLista = "SELECT * FROM detalle_lista_de_deseos
       WHERE (id_lista_de_deseos = '$lista->id' AND id_producto = '$prod->id')";
    $listfav = $conn->query($buscarInLista);
    $countList = mysqli_num_rows($listfav);
    if( $countList== 1){
        ?>
        <a href="#modal-two" class="btn btn-3 btn-3a " style="background-color:red;"><i class="fas fa-heart"></i> Eliminar de la lista de deseos</a>
        <div class="modal" id="modal-two" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-header">
      <h2>Alerta!</h2>
      <a href="#" class="btn-close" aria-hidden="true">×</a>
    </div>
    <div class="modal-body">
      <p>Eliminar a la lista de deseos?</p>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn" >Cerrar</a>
      <a href=<?= "./utils/favs.php?id=" . $prod->id . "&case=2" ?> class="btn" style="background-color:red;">Aceptar</a>
    </div>
  </div>
</div>
        <?php 
    }else{
    ?>
    <a href="#modal-one" class="btn btn-3 btn-3a "><i class="fas fa-heart"></i> Añadir a la lista de deseos</a>
    <div class="modal" id="modal-one" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-header">
      <h2>Alerta!</h2>
      <a href="#" class="btn-close" aria-hidden="true">×</a>
    </div>
    <div class="modal-body">
      <p>¿Añadir a la lista de deseos?</p>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn" style="background-color:red;">Cerrar</a>
      <a href=<?= "./utils/favs.php?id=" . $prod->id . "&case=1" ?> class="btn">Aceptar</a>
    </div>
  </div>
</div>
    <?php };
    }else{
        ?>
        <a href="#modal-one" class="btn btn-3 btn-3a "><i class="fas fa-heart"></i> Añadir a la lista de deseos</a>
        <div class="modal" id="modal-one" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-header">
          <h2>Alerta!</h2>
          <a href="#" class="btn-close" aria-hidden="true">×</a>
        </div>
        <div class="modal-body">
          <p>¿Añadir a la lista de deseos?</p>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn" style="background-color:red;">Cerrar</a>
          <a href=<?= "./utils/favs.php?id=" . $prod->id . "&case=1" ?> class="btn">Aceptar</a>
        </div>
      </div>
    </div>
        <?php  
    }
}
    ?>
</div>
<script src="./src/assets/js/slideshow.js"></script>
<script src="./src/assets/js/details.js"></script>
    <?php
        }
    }else{
        header('Location: '.'/');
    }
?>
<!-- Modal -->

<!-- /Modal -->
