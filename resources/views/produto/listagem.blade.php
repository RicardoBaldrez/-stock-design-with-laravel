@extends('layout.principal')

@section('content')
    <h1>Listagem dos produtos</h1>

    @if(old('nome'))
        <div class="alertSuccessNewProduct alert alert-success">
            O produto <b>{{ old('nome') }}</b> foi adicionado com sucesso!!! 
        </div>

        <script>
            $('.alertSuccessNewProduct').addClass('animated bounceInLeft');

            setTimeout(function() {
                $('.alertSuccessNewProduct').removeClass('bounceInLeft').addClass('bounceOutLeft');
            }, 3000);

            setTimeout(function() {
                $('.alertSuccessNewProduct').remove();    
            }, 3500);
        </script>
    @endif
    
    @if(empty($produtos))
        <div class="alert alert-danger">
            <p>Nenhum produto cadastrado.</p>
        </div>    
    @else
        <table class="table table-bordered table-hover">
            @foreach ($produtos as $produto)
                <tr class="{{ $produto->quantidade <= 1 ? 'danger' : '' }}">
                    <td id="middle" class="oneRow">{{ $produto->nome }}</td>
                    <td>{{ substr($produto->descricao, 0, 80)."..." }}</td>
                    <td id="middle" class="oneRow">{{ $produto->compatibilidade }}</td>
                    <td id="middle">{{ $produto->genero }}</td>
                    <td id="middle">{{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td id="middle">{{ $produto->quantidade }}</td>
                    <td id="middle">
                        <a href="/produtos/mostra/{{ $produto->id }}">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td id="middle">
                        <a href="/produtos/remove/{{ $produto->id }}">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <h4>
        <span class="label label-danger pull-right">
            Um ou menos itens no estoque
        </span>
    </h4>
@endsection        