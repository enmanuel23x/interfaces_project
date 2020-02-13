<?php include './extend/master.php' ?>
<?php if ($has_session = session_status() == PHP_SESSION_ACTIVE) { 
    if(isset($_SESSION['id'])){ 
        if($_SESSION['rol']==1){?>
<link rel="stylesheet" href="./src/assets/css/table.css">
<div class="center-positioning">
<h1>Categorias</h1>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descipcion</th>
        </tr>
        </thead>
    <tbody>
<?php
$categoria = "SELECT * FROM categoria";
$categoria = $conn->query($categoria);
$productos = "SELECT * FROM categoria";
$productos = $conn->query($productos);
$count = mysqli_num_rows($productos);
if($count!=0){
  foreach($productos as $prod): ?>
    <tr>
        <td> <?=$prod['nombre']?> </td>
        <td> <?=$prod['descripcion']?> </td>
        <td><a href=<?= "#modal-".$prod['id'] ?>><button class="edit"><i class="fas fa-edit"></i> Editar</button></a></td>
            <div class="modal" id=<?= "modal-".$prod['id'] ?> aria-hidden="true">
                <div class="modal-dialog">
                    <form action=<?= "./utils/editar_categ.php?id=".$prod['id'] ?> method="POST">
                        <div class="modal-header">
                            <h2>Editando</h2>
                            <a href="#" class="btn-close" aria-hidden="true">×</a>
                            </div>
                        <div class="modal-body">
                            <label for="nombre">Nombre: </label><input id="nombre" name="nombre" type="text" maxlength="40" value=<?=$prod['nombre']?> required>
                            <label for="descipcion">Descipcion: </label><input id="descipcion" name="descipcion" type="text" maxlength="500" value=<?=$prod['descripcion']?> required>
                            </div>
                        <div class="modal-footer">
                            <a href="#" class="btn" >Cerrar</a>
                            <button type="submit"  class="btn" style="background-color:green;width:auto;">Modificar</button>
                            </div>
                        </form>
                    </div>
                </div>
    </tr>
  <?php endforeach;
}
?>
<tr>
        <td></td><td></td>
        <td style="text-align: end;"><a href="#modal-new"><button class="edit"><i class="fas fa-plus-square"></i> Nuevo</button></a></td>
        <div class="modal" id="modal-new" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="./utils/new_categ.php" method="POST">
                        <div class="modal-header">
                            <h2>Nuevo</h2>
                            <a href="#" class="btn-close" aria-hidden="true">×</a>
                            </div>
                        <div class="modal-body">
                            <label for="nombre">Nombre: </label><input id="nombre" name="nombre" type="text" maxlength="40" required>
                            <label for="descipcion">Descipcion: </label><input id="descipcion" name="descipcion" type="text" maxlength="500" required>
                            </div>
                        <div class="modal-footer">
                            <a href="#" class="btn" >Cerrar</a>
                            <button type="submit"  class="btn" style="background-color:green;width:auto;">Añadir</button>
                            </div>
                        </form>
                    </div>
                </div>
    </tr>
</tbody>
</table>

    <h1>Productos</h1>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Categoria</th>
            <th>Inventario</th>
            <th>Imagen</th>
            <th>Accion</th>
        </tr>
        </thead>
    <tbody>
<?php
$productos = "SELECT * FROM producto";
$productos = $conn->query($productos);
$count = mysqli_num_rows($productos);
if($count!=0){
  foreach($productos as $prod): ?>
    <tr>
        <td> <?=$prod['nombre']?> </td>
        <td> <?=$prod['precio']?> </td>
        <td><?php foreach($categoria as $cat):
            if($cat['id']==$prod['id_categoria']){
                echo $cat['nombre'];
                }
            endforeach;?></td>
        <td> <?=$prod['inventario']?> </td>
        <td><img src=<?=$prod['imagen']?> alt="card picture" /> </td>
        <td><a href=<?="/editar.php?id=".$prod['id'] ?>><button class="edit"><i class="fas fa-edit"></i> Editar</button></a></td>
  </tr>
  <?php endforeach;
}
?>
<tr>
        <td></td><td></td><td></td><td></td><td></td>
        <td style="text-align: end;"><a href="/nuevo.php"><button class="edit"><i class="fas fa-plus-square"></i> Nuevo</button></a></td>
  </tr>
</tbody>
</table>
      </div>

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