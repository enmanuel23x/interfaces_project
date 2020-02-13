<?php include './extend/master.php' ?>
<?php if ($has_session = session_status() == PHP_SESSION_ACTIVE) { 
    if(isset($_SESSION['id'])){ 
        if($_SESSION['rol']==1){
            $categoria = "SELECT * FROM categoria";
	        $categoria = $conn->query($categoria);
            ?>
<form action="./utils/new.php" method="POST" enctype="multipart/form-data">
    <div class="slideshow-container"><input type="file" accept="image/*" name="files[]" id="files[]" onchange="loadFile(event)" required multiple>
    <div id="out">
    <div class="mySlides fade">
            
        </div>
    </div>
        <br>
        <!-- The dots/circles   -->
        <div style="text-align:center" id="out2">
            
        </div>
        </div>
    <div class="content-info">
    <h1 style="display:inline">Nombre:</h1> <input type="text" name="nombre" id="nombre" maxlength="40" required></input>
    <h3>Categoria</h3>
    <select name="categ" id="categ">
        <?php
    foreach($categoria as $name): ?>
        <option value=<?=  $name['id'] ?>><?=  $name['nombre'] ?></option>
    <?php endforeach; ?>
    </select>
    <hr>
    <h3>Detalles</h3>
    <textarea name="message" rows="10" cols="80" maxlength="500" id="descripcion" ></textarea><br>
    <p style="font-size: 20px">Precio: <input type="number" name="precio" id="precio" min="0" value='1'></input><strong>$</strong></p>
    <label for="qty">Cantidad: </label><input type="number" name="qty" id="qty" min="0" value='1' required></input><strong>Unidades</strong>
    <hr>
    <a class="btn btn-3 btn-3a" onclick="reset(event)"><i class="fas fa-sync"></i> Reiniciar</a>
    <button class="btn btn-3 btn-3a" type="submit"><i class="far fa-save"></i> Registrar</button>

        </div>
</form>
<?php include './extend/footer.php' ?>

<?php 
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
<script src="./src/assets/js/new.js"></script>
<script src="./src/assets/js/slideshow.js"></script>
<script src="./src/assets/js/details.js"></script>