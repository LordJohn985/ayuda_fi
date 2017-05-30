<?php

use Illuminate\Database\Seeder;

class PostulationTableSeeder extends Seeder
{

    public function run()
    {

        #POSTULANTES PARA LISTAR POSTULANTES CON VARIOS POSTULANTES
        App\Postulation::create([
            'comment' => 'comentario 1',
            'publication_id' => 3,
            'user_id' => 2]);
        App\Postulation::create([
            'comment' => 'comentario 2',
            'publication_id' => 3,
            'user_id' => 3]);
        App\Postulation::create([
            'comment' => 'comentario 3',
            'publication_id' => 3,
            'user_id' => 4]);
        App\Postulation::create([
            'comment' => 'comentario 4',
            'publication_id' => 3,
            'user_id' => 5]);
        App\Postulation::create([
            'comment' => 'comentario 5',
            'publication_id' => 3,
            'user_id' => 6]);
        App\Postulation::create([
            'comment' => 'comentario 6',
            'publication_id' => 3,
            'user_id' => 7]);
        App\Postulation::create([
            'comment' => 'comentario 7',
            'publication_id' => 3,
            'user_id' => 8]);
        App\Postulation::create([
            'comment' => 'comentario 8',
            'publication_id' => 3,
            'user_id' => 9]);
        App\Postulation::create([
            'comment' => 'comentario 9',
            'publication_id' => 3,
            'user_id' => 10]);
        App\Postulation::create([
            'comment' => 'comentario 10',
            'publication_id' => 3,
            'user_id' => 11]);
        App\Postulation::create([
            'comment' => 'comentario 11',
            'publication_id' => 3,
            'user_id' => 12]);
        App\Postulation::create([
            'comment' => 'comentario 12',
            'publication_id' => 3,
            'user_id' => 13]);
        App\Postulation::create([
            'comment' => 'comentario 13',
            'publication_id' => 3,
            'user_id' => 14]);
        App\Postulation::create([
            'comment' => 'comentario 14',
            'publication_id' => 3,
            'user_id' => 15]);

        #POSTULANTE PARA LISTARS POSTULANTES CON POSTULANTE ELEGIDO
        App\Postulation::create([
            'comment' => 'me eligieron',
            'publication_id' => 4,
            'user_id' => 2]);

        #POSTULANTE PARA PUBLICAR GAUCHADA
        App\Postulation::create([
            'comment' => 'no dejo publicar',
            'publication_id' => 9,
            'user_id' => 2]);
    }

}
