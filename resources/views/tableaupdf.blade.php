<style>
table, th, td {
  border: 1px solid black;
}
th, td {
  padding: 10px;
  text-align: center;
}
</style>
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
<td>{{ $majour['id'] }}</td>
<td>{{ $majour['mois'] }}</td>
<td>{{ $majour['nbJustificatifs'] }}</td>
<td>{{ $majour['newmontant'] }}</td>
<td>{{ $majour['dateModif'] }}</td>
<td>{{ $majour['idEtat'] }}</td>
</tr>
</table>
