<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;

class connexionController extends Controller
{
    function connecter(){
        
        return view('connexion')->with('erreurs',null);
    } 
    function valider(Request $request){
        $login = $request['login'];
        $mdp = $request['mdp'];
        $visiteur = PdoGsb::getInfosVisiteur($login,$mdp);
        if($visiteur['role'] != 1){
            if($visiteur['role'] != 0){
            $erreurs[] = "Login ou mot de passe incorrect(s)";
            return view('connexion')->with('erreurs',$erreurs);
            }
            else{
                session(['visiteur' => $visiteur]);
                return view('sommaire')->with('visiteur',session('visiteur'));
            }
        }
        else{
            session(['comptable' => $visiteur]);
            return view('sommaire2')->with('comptable',session('comptable'));
        }
    } 
    function deconnecter(){
            session(['visiteur' => null]);
            session(['comptable' => null]);
            return redirect()->route('chemin_connexion');
       
           
    }
       
}
