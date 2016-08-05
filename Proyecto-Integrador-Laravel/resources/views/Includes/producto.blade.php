<div class="thumbnail">
  @if($producto->productoFoto !== 'artsinfoto.gif')
    <img src="/assets/{{$producto->users_id}}/products/{{$producto->productoFoto}}" alt="" class="productoFoto">
  @else
    <img src="/assets/{{$producto->productoFoto}}" alt="" class="productoFoto">
  @endif
  <div class="caption">
    <h3><a href="Productos/{{$producto->productoId}}" title="Details">{{$producto->productoNombre}}</a></h3>
    <p>$ {{$producto->productoPrecio}}</p>
    @if($producto->categoriaIdParent > "0")
      <p><a href="" title="">{{$producto->categoria->categoriaIdParent}}</a> > <a href="" title="">{{$producto->categoria->categoriaNombre}}</a></p>
    @else
      <p><a href="" title="">{{$producto->categoria->categoriaNombre}}</a></p>
    @endif
    <p>Usuario: <a href="User/{{$producto->users_id}}" title="">{{$producto->usuario->full_name}}</a></p>