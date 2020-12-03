@extends ('sommaire2')
@section('contenu1')
<div id="contenu">
        <h2>Suivi paiement fiche de frais</h2>
        <h3>Les Fiches à rembourser : </h3>
      <form action="{{ route('chemin_fichefraisrembourser') }}" method="post">
      {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
        <div class="form-group"><p>
          <h4>Fiche à sélectionner : </h4>
              @foreach($lesFicheFraisEtat as $ficheFraisEtat)
              <fieldset style="background-color: #77AADD;">
              Id du visiteur : <strong>{{ $ficheFraisEtat['idVisiteur'] }} </strong>
              <br> Etat : <strong>{{ $ficheFraisEtat['libEtat'] }} depuis le {{ $ficheFraisEtat['dateModif'] }} </strong>
              <br> Montant validé : <strong>{{ $ficheFraisEtat['montantValide'] }} </strong>
              <br> Nombre de justificatif : <strong>{{ $ficheFraisEtat['nbJustificatifs'] }} </strong>
              <br><strong><a href="{{ route('chemin_editepdf',['id'=>$ficheFraisEtat['idVisiteur'].'-'.$ficheFraisEtat['mois']]) }}">ÉDITER</a></strong>
              <input selected type="checkbox" name="{{ $ficheFraisEtat['idVisiteur'] }}" value="{{ $ficheFraisEtat['idVisiteur'].'-'.$ficheFraisEtat['mois'] }}" style="float: right; width: 50px; height: 25px;"/>
              </fieldset>
              @endforeach
        </p></div>
        <div class="piedForm">
        <p>
          <input id="ok" type="submit" value="Valider" size="20" />
          <input id="annuler" type="reset" value="Effacer" size="20" />
        </p> 
        </div>
          
        </form>
  @endsection 