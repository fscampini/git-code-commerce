@extends('store.store')

@section('content')
    <div class="container">

        <h3>Meus pedidos</h3>

        <table class="table">
            <tbody>
            <tr>
                <th>#ID</th>
                <th>Itens</th>
                <th>Valor</th>
                <th>Status</th>
            </tr>

            @foreach($orders as $order)

            <tr>
                <td>{{$order->id}}</td>
                <td>
                    <ul>
                        @foreach($order->items as $item)
                        <li>{{$item->product->name}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{$order->total}}</td>
                <td>
                    <!--{{$order->getStatus()}}-->
                    <select class="status" id="status{{$order->id}}">
                        <option value="0">Aguardando Pagamento/Pendente</option>
                        <option value="1">Aprovado PagSeguro</option>
                        <option value="2">Cancelado</option>
                    </select>
                </td>
            </tr>

            @endforeach

            </tbody>
        </table>

    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

    <script>
        jQuery(function () {

            @foreach($orders as $order)
            $('#status' + {{ $order->id }} +' option[value="{{ $order->status }}"]').prop('selected', true);
            @endforeach

            $(".status").change(function () {

                var id = $(this).attr('id').replace('status', '');
                var status = $(this).val();

                $.ajax({

                    method: "GET",
                    url: 'orders/' + id + '/' +  status + '/update',
                    data: {},

                    success: function(result){

                        if(result.success){
                            alert("Dados atualizados no banco de dados!");
                        } else {
                            alert("Erro! Não foi possível o registro no banco de dados!");
                        }

                    }
                })
            });
        });
    </script>
@endsection