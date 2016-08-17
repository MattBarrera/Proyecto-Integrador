{{-- <div class="thumbnail"> --}}
  @if($producto->productoFoto !== 'artsinfoto.gif')
    <a href="/Productos/{{$producto->productoId}}" title="Details"><img src="/assets/{{$producto->users_id}}/products/{{$producto->productoFoto}}" alt="" class="productoFoto"></a>
  @else
   <a href="/Productos/{{$producto->productoId}}" title="Details"> <img src="/assets/{{$producto->productoFoto}}" alt="" class="productoFoto"></a>
  @endif
  <div class="caption">
    <h3 class="item-title"><a href="/Productos/{{$producto->productoId}}" title="Details">{{$producto->productoNombre}}</a></h3>
    <p>$ {{$producto->productoPrecio}}</p>
    @if($producto->categoriaIdParent > "0")
      <p><a href="/Busqueda?cat={{$producto->categoriaPadre->categoriaId}}" title="">{{$producto->categoriaPadre->categoriaNombre}}</a> > <a href="/Busqueda?cat={{$producto->categoria->categoriaId}}" title="">{{$producto->categoria->categoriaNombre}}</a></p>
    @else
      <p><a href="" title="">{{$producto->categoria->categoriaNombre}}</a></p>
    @endif
    @if($producto->empresaId == 0)
      <p>User: <a href="User/{{$producto->users_id}}" title="">{{$producto->usuario->full_name}}</a></p>
    @else
      <p>Business: <a href="Empresa/{{$producto->empresaId}}" title="">{{$producto->empresa->empresaNombre}}</a></p>
    @endif
    {{-- {{dd($producto->getStokTotalAttribute())}} --}}
    @if($producto->getStokTotalAttribute() == 0)
      <p class="sinStock" ">Out of Stock</p>
    @endif