<?php 
    require_once ("config.php");
    $titulo = "Detalle Producto";
    $id = $_GET["id"];
    $producto = $repositorio->getProductRepository()->getProductoById($id);
    $productos = $repositorio->getProductRepository()->getAllProducts();
    $productosOK = $repositorio->getProductRepository()->getProductoByEstado($productos,1);
    if ($repositorio->getProductRepository()->getProductoById($producto->getProductoId())->getProductoFoto() == "artsinfoto.gif") {
      $productoFoto = '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($producto->getProductoId())->getProductoFoto().'" alt="">';
    }else{
      $productoFoto =
        '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($producto->getProductoId())->getProductoUsuarioId().'/products/'.$repositorio->getProductRepository()->getProductoById($producto->getProductoId())->getProductoFoto().'" alt="">';
    }?>
  <?php require_once("include/head.php"); ?>
    <link rel="stylesheet" href="../css/cssDetalle.css" media="screen" title="no title" charset="utf-8">
  <body>
    <?php require_once ("include/header.php") ?>
    <section id="productosStore">
      <section class="imagenProducto">
        <!--imagen del producto-->
          <?php echo $productoFoto ?>
      </section>

      <section class="detalleProducto">
      <form action="">
        <!--aca va el titulo del producto-->
          <h2><?php echo $producto->getProductoNombre(); ?></h2>
        <!--descripcion completa del producto-->
          <p><?php echo $producto->getProductoDescripcion() ?></p>

        <!--precio del producto con el titulo-->
          <h3>Precio:</h3>
          <?php echo "$".$producto->getProductoPrecio() ?>

        <!--precio del producto con el titulo-->
          <h3>Color:</h3>
          <p>Ejemplo de Color 1</p>
          <p>Ejemplo de Color 2</p>
          
        <!--precio del producto con el titulo-->
          <h3>Talle:</h3>
          <p>Ejemplo de Talle</p>
          <p>Ejemplo de Talle</p>

          <input type="submit" class="botonComprarDetalle" value="Comprar"></input>
      </form>
      </section>
      <section class="relatedProducts">
        <div class="productosDestacados">
          <h2>Productos Relacionados:</h2>
          <?php for ($i = 0; $i < 4; $i++) {
                  if ($repositorio->getProductRepository()->getProductoById($productosOK[$i]->getProductoId())->getProductoFoto() == "artsinfoto.gif") {
                      $productoFoto = '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($productosOK[$i]->getProductoId())->getProductoFoto().'" alt="">';
                    }else{
                      $productoFoto =
                        '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($productosOK[$i]->getProductoId())->getProductoUsuarioId().'/products/'.$repositorio->getProductRepository()->getProductoById($productosOK[$i]->getProductoId())->getProductoFoto().'" alt="">';
          ?>
                   <div class="productoDestacado">
                          <?php echo $productoFoto; ?>
                          <h3><a href="detalleProducto.php?id=<?php echo $productosOK[$i]->getProductoId();?>" title=""><?php echo $productosOK[$i]->getProductoNombre();?></a></h3>
                          <p><?php echo $productosOK[$i]->getProductoDescripcion();?></p>
                          <p>Precio: $ <?php echo $productosOK[$i]->getProductoPrecio();?></p>
                          <p>Categoria:<?php echo $productosOK[$i]->getProductoCategoria();?></p>
                          <button><a href="#" title="">Comprar</a></button>
                    </div>
              <?php } ?>
          <?php } ?>
        </div>
      </section>
    </section>
  </body>
</html>
