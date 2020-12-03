@extends ('sommaire2')
@section('contenu1')
<div id="contenu">
<h2>Fiche de la frais : </h2>
<form action="{{ route('chemin_tableaupdf') }}" method="post">
{{ csrf_field() }}
<table>
<tr>
<th>Id Visiteur</th>
<th>mois</th>
<th>Nombre Justificatifs</th>
<th>montant</th>
<th>Date de modif</th>
<th>Id Etat</th>
</tr>
<tr>
<td>{{ $InfosUneFiche['idVisiteur'] }}</td>
<td>{{ $InfosUneFiche['mois'] }}</td>
<td>{{ $InfosUneFiche['nbJustificatifs'] }}</td>
<td>{{ $InfosUneFiche['montantValide'] }}</td>
<td>{{ $InfosUneFiche['dateModif'] }}</td>
<td>{{ $InfosUneFiche['idEtat'] }}</td>
</tr>
<tr>
<td><input type="text" name="id" value="{{ $InfosUneFiche['idVisiteur'] }}" readonly></td>
<td><input type="text" name="mois" value="{{ $InfosUneFiche['mois'] }}" readonly></td>
<td><input type="text" name="nbJustificatifs" value="{{ $InfosUneFiche['nbJustificatifs'] }}" readonly></td>
<td>Modifier :<input type="text" name="newmontant"></td>
<td><input type="text" name="dateModif" value="{{ $InfosUneFiche['dateModif'] }}" readonly></td>
<td><input type="text" name="idEtat" value="{{ $InfosUneFiche['idEtat'] }}" readonly></td>
</tr>
</table>
<input type="submit" value="Valider">
</form>

@endsection 