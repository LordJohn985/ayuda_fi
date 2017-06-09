@extends('layouts.admin.base')

@section('content')
    <section class="content">
        <form  action="/dashboard/users/buyCredits" method="POST" enctype="multipart/form-data">

            <div class=form-group>
                <label>Cantidad de créditos a comprar</label>
                <input  type="number" class="form-control"  name="credits" placeholder="0" required>
            </div>

            <div class=form-group>
                <label>Numero de tarjeta</label>
                <input  type="number" class="form-control"  name="credit_card" required>
            </div>

            <div class=form-group>
                <label>Código de seguridad</label>
                <input  type="number" class="form-control"  name="security_code" required>
            </div>

            <input class="btn btn-accent pull-right" type="submit" value="Comprar">

            {{ csrf_field() }}

        </form>

    </section>

@stop