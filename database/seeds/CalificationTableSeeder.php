<?php

use Illuminate\Database\Seeder;

class CalificationTableSeeder extends Seeder
{

    public function run()
    {
        #CALIFICACION PARA LISTAR POSTULANTES CON POSTULANTE ELEGIDO
        App\Calification::create([
            'user_id' => 2,
            'publication_id' => 4]);

        #CALIFICACION PARA PUBLICAR GAUCHADA
        App\Calification::create([
            'user_id' => 2,
            'publication_id' => 9]);
    }

}
