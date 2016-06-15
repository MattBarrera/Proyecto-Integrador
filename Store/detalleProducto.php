<?php require_once ("config.php");
$titulo = "Detalle Producto";
$id = $_GET["id"];
$producto = $repositorio->getProductRepository()->getProductoById($id);?>
<?php require_once("include/head.php"); ?>
<?php require_once ("include/header.php") ?>
<?php if ($repositorio->getProductRepository()->getProductoById($producto->getProductoId())->getProductoFoto() == "artsinfoto.gif") {
    $productoFoto = '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($producto->getProductoId())->getProductoFoto().'" alt="">';
  }else{
    $productoFoto =
      '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($producto->getProductoId())->getProductoUsuarioId().'/products/'.$repositorio->getProductRepository()->getProductoById($producto->getProductoId())->getProductoFoto().'" alt="">';
  }?>
<link rel="stylesheet" href="../css/cssDetalle.css" media="screen" title="no title" charset="utf-8">
  <body>
    <section id="productosStore">
      <h2 class="tituloProducto">
        <!--aca va el titulo del producto-->
        <?php echo $producto->getProductoNombre(); ?>
      </h2>
      <section class="imagenProducto">
        <!--imagen del producto-->
        <?php echo $productoFoto ?>
      </section>
      <section class="precioProducto">
        <!--precio del producto con el titulo-->
        <?php echo "$".$producto->getProductoPrecio() ?>
      </section>
      <br>
      <section class="botonComprar">
        <input type="submit" value="Comprar"></input>
      </section>
      <br><br><br><br><br>
      <section id="categorias">
        <div id="descripcion">
          <section class="descripcionProducto">
            <br><br>
            <!--descripcion completa del producto-->
            <?php echo $producto->getProductoDescripcion() ?>
            <br><br><br>
          </section>
        </div>
      </section>
    </section>

  </body>
</html>
