@extends('layouts.admin.base')

@section('content')
    <section class="content">
        <form  action="/dashboard/users/buyCredits" method="POST" enctype="multipart/form-data">

            <div>
                <label>Tienes {{auth::user()->credits}} créditos</label>
            </div>

            </br>

            <div class="form-group col-md-4">
                <label>Cantidad de créditos a comprar</label>
                <input  type="number" id="cant" min="0" class="form-control"  name="credits" placeholder="0" value="{{ isset($credits)?$credits : '' }}" required>
            </div>

            <div class="form-group col-md-4">
                <label>Numero de tarjeta</label>
                <input  type="number" class="form-control"  name="credit_card" value="{{ isset($credit_card)?$credit_card : '' }}" required>
            </div>

            <div class="form-group col-md-4">
                <label>Código de seguridad</label>
                <input  type="number" class="form-control"  name="security_code" value="{{ isset($security_code)?$security_code : '' }}" required>
            </div>

            <div class=form-group>
            {{--<div id="price" style="display:none">{{$price}}</div>--}}
                <label>Precio a pagar</label>
                <div id="show-cant" name="price" >{{$priceToPay}}</div>
            </div>

            <input class="btn btn-accent pull-right" type="submit" value="Comprar">

            {{ csrf_field() }}

        </form>

    </section>

@stop

@section('script')
    <script src="{{asset('js/managePrice.js')}}"></script>
@stop