@extends('layouts.admin.base')

@section('content')
    <section class="content">
        <form  action="/dashboard/users/buyCredits" method="POST" enctype="multipart/form-data">

            <div>
                <label>Tienes {{auth::user()->credits}} créditos</label>
            </div>

            </br>

            <div class=form-group>
                <label>Cantidad de créditos a comprar</label>
                <input  type="number" id="cant" class="form-control"  name="credits" placeholder="0" required>
            </div>

            <div class=form-group>
                <label>Numero de tarjeta</label>
                <input  type="number" class="form-control"  name="credit_card" required>
            </div>

            <div class=form-group>
                <label>Código de seguridad</label>
                <input  type="number" class="form-control"  name="security_code" required>
            </div>

            <div class=form-group>
            {{--<div id="price" style="display:none">{{$price}}</div>--}}
                <label>Precio a pagar</label>
                <div id="show-cant" name="price" >0</div>
            </div>

            <input class="btn btn-accent pull-right" type="submit" value="Comprar">

            {{ csrf_field() }}

        </form>

    </section>

@stop

@section('script')
    <script src="{{asset('js/managePrice.js')}}"></script>
@stop