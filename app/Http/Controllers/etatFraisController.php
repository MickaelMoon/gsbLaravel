<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;
use MyDate;
use PDF;
use dompdf\dompdf;
class etatFraisController extends Controller
{
    function selectionnerMois(){
        if(session('visiteur') != null){
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $lesMois = PdoGsb::getLesMoisDisponibles($idVisiteur);
		    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
		    // on demande toutes les clés, et on prend la première,
		    // les mois étant triés décroissants
		    $lesCles = array_keys( $lesMois );
		    $moisASelectionner = $lesCles[0];
            return view('listemois')
                        ->with('lesMois', $lesMois)
                        ->with('leMois', $moisASelectionner)
                        ->with('visiteur',$visiteur);
        }
        else{
            return view('connexion')->with('erreurs',null);
        }

    }

    function voirFrais(Request $request){
        if( session('visiteur')!= null){
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $leMois = $request['lstMois']; 
		    $lesMois = PdoGsb::getLesMoisDisponibles($idVisiteur);
            $lesFraisForfait = PdoGsb::getLesFraisForfait($idVisiteur,$leMois);
		    $lesInfosFicheFrais = PdoGsb::getLesInfosFicheFrais($idVisiteur,$leMois);
		    $numAnnee = MyDate::extraireAnnee( $leMois);
		    $numMois = MyDate::extraireMois( $leMois);
		    $libEtat = $lesInfosFicheFrais['libEtat'];
		    $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif =  $lesInfosFicheFrais['dateModif'];
            $dateModifFr = MyDate::getFormatFrançais($dateModif);
            $vue = view('listefrais')->with('lesMois', $lesMois)
                    ->with('leMois', $leMois)->with('numAnnee',$numAnnee)
                    ->with('numMois',$numMois)->with('libEtat',$libEtat)
                    ->with('montantValide',$montantValide)
                    ->with('nbJustificatifs',$nbJustificatifs)
                    ->with('dateModif',$dateModifFr)
                    ->with('lesFraisForfait',$lesFraisForfait)
                    ->with('visiteur',$visiteur);
            return $vue;
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }

    function selectionnerEtatFicheFrais()
    {
        if( session('comptable')!= null)
        {
            $comptable = session('comptable');
            $idComptable = $comptable['id'];
            $lesFicheFraisEtat = PdoGsb::getLesficheFraisEtat();
            
            //var_dump($lesFicheFraisEtat);
            return view('paiementfichefrais')
                    ->with('lesFicheFraisEtat',$lesFicheFraisEtat)
                    ->with('comptable',$comptable);
        }
        else
        {
            return view('connexion')->with('erreurs',null);
        }
    }
    function ficheFraisRembourser(Request $request)
    {
        if( session('comptable')!= null)
        {
            $comptable = session('comptable');
            $idComptable = $comptable['id'];
            $request2 = $request->all();
            $lesFicheFraisEtat = PdoGsb::getLesficheFraisEtat();
            //dd($request2);
            $newDateModif = date("Y-m-d");
            
            foreach($request2 as $clef => $valeur){
                if($clef != "_token"){
                    //dd($valeur);
                PdoGsb::updateEtatFicheFrais($newDateModif,$valeur);
                }
            }
            
            return view('fichefraisrembourser')
                    ->with('request2',$request2)
                    ->with('newDateModif',$newDateModif)
                    ->with('comptable',$comptable);
        }
        else
        {
            return view('connexion')->with('erreurs',null);
        }
    }
    function editepdf(Request $request)
    {
        if( session('comptable')!= null)
        {
            $comptable = session('comptable');
            $idComptable = $comptable['id'];
            $request2 = $request->all();
            $InfosUneFiche = PdoGsb::getInfoFiche($request['id']);
            return view('editepdf')
                    ->with('InfosUneFiche',$InfosUneFiche)
                    ->with('comptable',$comptable);
        }
        else
        {
            return view('connexion')->with('erreurs',null);
        }
    }
    function validepdf (Request $request){
        if( session('comptable')!= null)
        {
            $comptable = session('comptable');
            $idComptable = $comptable['id'];
            $request2 = $request->all();
            $majour = $request2;
            $pdf = PDF::loadView('tableaupdf',['majour'=>$majour]);
            return $pdf->download('result.pdf', array('Attachement'=>0));

        }
        else
        {
            return view('connexion')->with('erreurs',null);
        }
    }

    
}