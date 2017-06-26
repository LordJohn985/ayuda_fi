<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PublicationTableSeeder extends Seeder
{

    public function run()
    {

        #POSTULARSE A GAUCHADA - publicacion 1
        App\Publication::create([
            'title' => 'postularse a gauchada',
            'finish_date' => Carbon::now()->addMonths(2),
            'content' => 'esta gauchada se usará para testear la HU postularse a gauchada',
            'city_id' => 15,
            'user_id' => 1,
            'category_id'=> 3
        ]);

        #LISTAR POSTULANTES - publicaciones 2 a 6
        App\Publication::create([
            'title' => 'listar postulantes - sin postulantes',
            'finish_date' => Carbon::now()->addMonths(2),
            'content' => 'esta gauchada se usará para testear la HU listar postulantes',
            'city_id' => 25,
            'user_id' => 1,
            'category_id'=> 2
        ]);

        App\Publication::create([
            'title' => 'listar postulantes - varios postulantes',
            'finish_date' => Carbon::now()->addMonths(2),
            'content' => 'esta gauchada se usará para testear la HU listar postulantes',
            'city_id' => 12,
            'user_id' => 1,
            'category_id'=> 1
        ]);

        App\Publication::create([
            'title' => 'listar postulantes - postulante elegido',
            'finish_date' => Carbon::now()->addMonths(2),
            'content' => 'esta gauchada se usará para testear la HU listar postulantes',
            'city_id' => 33,
            'user_id' => 1,
            'category_id'=> 4
        ]);

        App\Publication::create([
            'title' => 'listar postulantes - gauchada vencida',
            'finish_date' => Carbon::yesterday(),
            'content' => 'esta gauchada se usará para testear la HU listar postulantes',
            'city_id' => 42,
            'user_id' => 1,
            'category_id'=> 1,
        ]);

        App\Publication::create([
            'title' => 'listar postulantes - gauchada borrada',
            'finish_date' => Carbon::now()->addMonths(2),
            'content' => 'esta gauchada se usará para testear la HU listar postulantes',
            'city_id' => 42,
            'user_id' => 1,
            'category_id'=> 1,
            'deleted_at' => Carbon::now(),
        ]);

        #CALIFICAR POSTULANTE - publicaciones 7 a 9
        App\Publication::create([
            'title' => 'calificar postulante - calificación positiva',
            'finish_date' => Carbon::now()->addMonths(2),
            'content' => 'esta gauchada se usará para testear la HU calificar postulante',
            'city_id' => 50,
            'user_id' => 1,
            'category_id'=> 6,
        ]);

        App\Publication::create([
            'title' => 'calificar postulante - calificacion neutra',
            'finish_date' => Carbon::now()->addMonths(2),
            'content' => 'esta gauchada se usará para testear la HU calificar postulante',
            'city_id' => 42,
            'user_id' => 1,
            'category_id'=> 1,
        ]);

        App\Publication::create([
            'title' => 'calificar postulante - calificacion negativa',
            'finish_date' => Carbon::now()->addMonths(2),
            'content' => 'esta gauchada se usará para testear la HU calificar postulante',
            'city_id' => 20,
            'user_id' => 1,
            'category_id'=> 1,
        ]);

        #PUBLICAR GAUCHADA - publicacion 10
        App\Publication::create([
            'title' => 'publicar gauchada - calificaciones pendientes',
            'finish_date' => Carbon::now()->addMonths(2),
            'content' => 'esta gauchada se usará para testear la HU publicar gauchada',
            'city_id' => 20,
            'user_id' => 12,
            'category_id'=> 1,
        ]);
        //factory('App\Publication', 15)->create();

    }

}
