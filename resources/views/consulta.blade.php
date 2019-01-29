@extends('layouts.app')
@section('content')

<div class="container">
    <div class="tab-content">
        <h2>Presupuestos</h2>
        <div><input class="pre_search pre_search_a"  onkeyup="mySearch('presupuesto')" placeholder="Buscar Presupuesto ..." id="shearch_presupuesto"></div>
        <table style=" width: 100%;" id="table_presupuesto">
            <tr>
                <th class="pre_t_th" style="cursor: pointer;" onclick="sortTable('table_presupuesto',0)">Numero</th>
                <th class="pre_t_th" style="cursor: pointer;" onclick="sortTable('table_presupuesto',1)">Cliente</th>
                <th class="pre_t_th" style="cursor: pointer;" onclick="sortTable('table_presupuesto',2)">Fecha</th>
                <th class="pre_t_th">Ver</th>
            </tr>
            @if(count($presupuestos) > 0)
                @foreach($presupuestos as $presupuesto)
                    <tr class="pre_t_tr">
                        <td class="pre_t_td">{{$presupuesto -> t_presupuestosNumero}}</td>
                        <td class="pre_t_td">{{$presupuesto -> t_clientesNombre }}  {{$presupuesto -> t_clientesApellido }}</td>
                        <td class="pre_t_td">{{$presupuesto -> fecha}}</td>
                        <td class="pre_t_td"><a href="/presupuesto/{{$presupuesto -> t_presupuestosNumero}}">Ver</a></td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>
@endsection