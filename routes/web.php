<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
        /*-------------------- Use case connexion---------------------------*/
Route::get('/',[
        'as' => 'chemin_connexion',
        'uses' => 'connexionController@connecter'
]);

Route::post('/',[
        'as'=>'chemin_valider',
        'uses'=>'connexionController@valider'
]);
Route::get('deconnexion',[
        'as'=>'chemin_deconnexion',
        'uses'=>'connexionController@deconnecter'
]);

         /*-------------------- Use case état des frais---------------------------*/
Route::get('selectionMois',[
        'as'=>'chemin_selectionMois',
        'uses'=>'etatFraisController@selectionnerMois'
]);

Route::post('listeFrais',[
        'as'=>'chemin_listeFrais',
        'uses'=>'etatFraisController@voirFrais'
]);

Route::get('paiementfichefrais',[
        'as'=>'chemin_paiementfichefrais',
        'uses'=>'etatFraisController@selectionnerEtatFicheFrais'
]);

Route::post('fichefraisrembourser',[
        'as'=>'chemin_fichefraisrembourser',
        'uses'=>'etatFraisController@ficheFraisRembourser'
]);
Route::get('editepdf',[
        'as'=>'chemin_editepdf',
        'uses'=>'etatFraisController@editepdf'
]);
Route::post('tableaupdf',[
        'as'=>'chemin_tableaupdf',
        'uses'=>'etatFraisController@validepdf'
]);
        /*-------------------- Use case gérer les frais---------------------------*/

Route::get('gererFrais',[
        'as'=>'chemin_gestionFrais',
        'uses'=>'gererFraisController@saisirFrais'
]);

Route::post('sauvegarderFrais',[
        'as'=>'chemin_sauvegardeFrais',
        'uses'=>'gererFraisController@sauvegarderFrais'
]);



