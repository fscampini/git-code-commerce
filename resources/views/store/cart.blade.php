@extends('store.store')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="table-responsive cart_info">

                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Valor</td>
                            <td class="price">Quantidade</td>
                            <td class="price">Total</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($cart->all() as $k=>$item)
                        <tr>
                            <td class="cart_product">
                                <a href="{{ route('store.product', ['id' => $k]) }}">
                                    Imagem
                                </a>
                            </td>

                            <td class="cart_description">
                                <h4><a href="{{ route('store.product', ['id' => $k]) }}">{{ $item['name'] }}</a></h4>
                                <p>Código: {{$k}}</p>
                            </td>

                            <td class="cart_price">
                                R$ {{$item['price']}}
                            </td>

                            <td class="cart_quantity">
                                <select class="quantity" id="quantity{{ $k }}">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>

                            <td class="cart_total">
                                <p class="cart_total_price" id="total_line_price{{ $k }}">R$ {{$item['price'] * $item['qtd']}}</p>
                            </td>

                            <td class="cart_delete">
                                <a href="{{ route('cart.destroy', ['id' => $k]) }}" class="cart_quantity_delete">
                                    Delete
                                </a>
                            </td>

                        </tr>
                    @empty

                        <tr>
                            <td class="" colspan="6">
                                <p> Nenhum item encontrado.</p>
                            </td>
                        </tr>

                    @endforelse

                    <tr class="cart_menu">

                        <td colspan="6">
                            <div class="pull-right">
                                <span style="margin-right: 90px" id="total_cart_price">
                                    TOTAL: R$ {{ $cart->getTotal() }}
                                </span>

                                <a href="{{ route('checkout.place') }}" class="btn btn-success">Fechar a conta</a>

                            </div>
                        </td>

                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </section>
@stop

@section('javascript')
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

<script>
    jQuery(function () {

        @foreach($cart->all() as $k=>$item)
        $('#quantity' + {{ $k }} +' option[value="{{ $item['qtd'] }}"]').prop('selected', true);
        @endforeach

        $(".quantity").change(function () {

                    var id = $(this).attr('id').replace('quantity', '');
                    var quantity = $(this).val();

                    $.ajax({

                        method: "GET",
                        url: "cart/update/" + id + '/' +  quantity,
                        data: {},

                        success: function(result){

                            if(result.success){
                                $('#total_line_price' + id).text('R$ ' + result.price);
                                $('#total_cart_price').text('R$ ' + result.total);
                            } else {
                                alert("Erro! Não foi possível atualizar o carrinho.");
                            }

                        }
                    })
                });
    });
</script>
@endsection

