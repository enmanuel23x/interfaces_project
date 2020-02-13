<?php include './extend/master.php' ?>
<?php if ($has_session = session_status() == PHP_SESSION_ACTIVE) { 
    if(isset($_SESSION['id'])){ 
        $url = $_GET['id'];
        if($_SESSION['rol']==1 && isset($url)){
            $categoria = "SELECT * FROM categoria";
	        $categoria = $conn->query($categoria);
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
            ?>
<form id="form" action= <?= "./utils/edit.php?id=".$prod->id ."&case=0"?> method="POST" enctype="multipart/form-data">
    <div class="slideshow-container">
        <div id="in">

        </div>
        <div id="out">
    <div class="mySlides fade">
        <img src=<?= $prod->imagen ?> style="width:100%">
    </div>
    <?php while($img = mysqli_fetch_object($images)){ ?>
    <div class="mySlides fade">
        <img src=<?= $img->imagen ?> style="width:100%">
    </div>
    <?php } ?>
    </div>
    <br>
    <!-- The dots/circles -->
    <div style="text-align:center" id="out2">
        <span class="dot" onclick="currentSlide(1)"></span>
        <?php 
        if ($count>=1){
          $range=$count+1;
        foreach(range(2, $range ) as $número): ?>
        <span class="dot" onclick="currentSlide(<?= $número  ?>)"></span>
        <?php endforeach;} ?>
    </div>
    <div>
    <button class="btn btn-3 btn-3a" type='button' onclick="sync(<?=$prod->id?>)"><i class="fas fa-sync"></i> Renovar imagenes</button>
    </div>
</div>
<div class="content-info">
<h1 style="display:inline">Nombre:</h1> <input type="text" name="nombre" id="nombre" maxlength="40" value=<?= $prod->nombre ?> required></input>
<h3>Categoria</h3>
    <select name="categ" id="categ">
        <?php
    foreach($categoria as $name): ?>
        <option value=<?=  $name['id'] ?>><?=  $name['nombre'] ?></option>
    <?php endforeach; ?>
    </select>   
<hr>
    <h3>Detalles</h3>
    <textarea name="message" rows="10" cols="80" maxlength="500" id="descripcion"> <?= $prod->descripcion ?> </textarea><br>
    <p style="font-size: 20px">Precio: <input type="number" name="precio" id="precio" min="0" value=<?= $prod->precio ?> ></input><strong>$</strong></p>
    <label for="qty">Cantidad: </label><input type="number" name="qty" id="qty" min="0" value=<?= $prod->inventario ?> required></input><strong>Unidades</strong>
    <hr>
    <button style="background: red;" class="btn btn-3 btn-3a" type='button' onclick="del(<?= $prod->id ?>)"><i class="fas fa-minus-circle"></i> Eliminar</button>
    <button class="btn btn-3 btn-3a" type='submit'><i class="fas fa-upload"></i> Actualizar</button>
        </form>    
<script src="./src/assets/js/slideshow.js"></script>
<script src="./src/assets/js/edit.js"></script>
<script src="./src/assets/js/new.js"></script>
<?php include './extend/footer.php' ?>

<?php
        }
}else{
    header('Location: '.'/');
}
}else{
    header('Location: '.'/ingreso.php');
}
}else{
    header('Location: '.'/ingreso.php');
}
?>