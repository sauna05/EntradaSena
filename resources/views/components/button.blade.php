{{-- Propiedades que se le pueden pasar al componente, si a algunas se les está dando valor
directamente es POR SI NO LLEGAN A ENVIAR dicha propiedad cuando llaman al componente --}}
@props(['type'=>'button', 'id'=>'', 'class' => 'btn'])

<button style="cursor: pointer" type="{{$type}}" id="" class="{{$class}}">{{$slot}}</button>
