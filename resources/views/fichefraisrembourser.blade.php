@extends ('sommaire2')
@section('contenu2')
<div id="contenu">
<h2>Fiche de frais rembourser  : </h2>
    @foreach($request2  as $clef => $valeur)
    @if($clef != "_token")
    <fieldset>  
    <h4>Visiteur :({{ $valeur }})</h4>
    <h3>Modifié le : {{ $newDateModif }}</h4>
    </fieldset>
    @endif
    @endforeach
    <br>
    
</div>
@endsection