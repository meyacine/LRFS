<script>
  $(function() {
    $( "#dateNaissance" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#finValidite" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
 </script>
<blockquote class="fadeInLeft animated">
	<p align="center">Saisie d'un nouveau Membre</p>
</blockquote>
<div id="msg"></div>
<div style="text-align: center" class="fadeInDown animated">
	<form class="form-inline" role="form" name="newMembre"
		enctype="multipart/form-data"
		ng-controller="NewMembreCtrl as newMembreCtrl"
		ng-submit="newMembre.$valid &&  newMembreCtrl.formSubmitted()"
		novalidate>
		<input type="hidden" name="method" value="im" />
		<table class="table">
			<tr align="justify">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Division :</div>
							<divisions-list></divisions-list>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Clubs :</div>
							<clubs-list></clubs-list>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Wilaya de naissance :</div>
							<wilayas-list></wilayas-list>
						</div>
					</div>
				</td>
			</tr>
			<tr align="justify">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Nom :</div>
							<input class="form-control" type="text" id="nomMembre"
								name="nomMembre" ng-model="newMembreCtrl.nomMembre" required
								ng-pattern="/^([A-Z]+\s)*[A-Z]+$/">
						</div>
						<p
							ng-show="newMembre.nomMembre.$invalid && newMembre.nomMembre.$dirty"
							class="text-danger">Le nom doit etre en majuscule (seulement les
							26 char latins et l'espace sont accept&eacute;s)!</p>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Pr&eacute;nom :</div>
							<input class="form-control" type="text" id="prenomMembre"
								name="prenomMembre" ng-model="newMembreCtrl.prenomMembre"
								required ng-pattern="/^([a-zA-Z]+\s)*[a-zA-Z]+$/">
						</div>
						<p
							ng-show="newMembre.prenomMembre.$invalid && newMembre.prenomMembre.$dirty"
							class="text-danger">indication prenom (seulement les 26 char
							latins Maj/Min et l'espace sont accept&eacute;s)!</p>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Date de naissance:</div>
							<input type="text" id="dateNaissance" name="dateNaissance"
								ng-pattern='datePattern' class="dateChoise"
								ng-model="newMembreCtrl.dateNaissanceMembre" required />
						</div>
					</div>
				</td>
			</tr>
			<tr align="justify">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Commune Naissance:</div>
							<input class="form-control" type="text"
								id="communeNaissanceMembre" name="communeNaissanceMembre"
								ng-model="newMembreCtrl.communeNaissanceMembre" required>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Num&eacute;ro de l'act de
								naissance:</div>
							<input class="form-control" type="text" id="numAct" name="numAct"
								ng-model="newMembreCtrl.numAct" required
								ng-pattern="/^(\d{1,9})?$/">
						</div>
						<p ng-show="newMembre.numAct.$invalid && newMembre.numAct.$dirty"
							class="text-danger">Le num&eacute;ro de l'act de naissance doit
							&ecirc;tre uniquement num&eacute;rique!</p>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Fils de:</div>
							<input class="form-control" type="text" id="parentMembre"
								name="parentMembre" ng-model="newMembreCtrl.parentMembre"
								required>
						</div>
					</div>
				</td>
			</tr>
			<tr align="justify">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Adresse:</div>
							<input class="form-control" type="text" id="adrMembre"
								name="adrMembre" ng-model="newMembreCtrl.adrMembre" required>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Groupe Sanguin:</div>
							<select id="groupSanguin" name="groupSanguin"
								class="form-control" ng-model="newMembreCtrl.groupSanguin">
								<option value="--">--</option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
								<option value="O+">O+</option>
								<option value="O-">O-</option>
							</select>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Fin Validit&eacute; :</div>
							<input type="text" id="finValidite" name="finValidite"
								ng-pattern='datePattern' class="dateChoise"
								ng-model="newMembreCtrl.finValidite" required />
						</div>
					</div>
				</td>
			</tr>
			<tr align="justify">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Dur&eacute;e (ann&eacute;e) :</div>
							<input class="form-control" type="text" id="duree" name="duree"
								ng-model="newMembreCtrl.duree" ng-pattern="/^[0-9][1-9]$/"
								required>
						</div>
						<p ng-show="newMembre.duree.$invalid && newMembre.duree.$dirty"
							class="help-block">
							La dur&eacute;e doit &ecirc;tre sur deux chiffre<br> ex: 01 pour
							une ann&eacute;e
						</p>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Numero du dossard :</div>
							<input class="form-control" type="text" id="dossard"
								name="dossard" ng-model="newMembreCtrl.dossard"
								ng-pattern="/^[0-9][0-9]$/" required>
						</div>
						<p
							ng-show="newMembre.dossard.$invalid && newMembre.dossard.$dirty"
							class="help-block">
							Le dossard doit &ecirc;tre sur deux chiffre<br> ex: 01 pour une
							ann&eacute;e
						</p>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<input type="file" id="photoMembre" name="photoMembre"
								ng-model="newMembreCtrl.photoMembre"
								accept="image/x-png, image/gif, image/jpeg, image/jpg"
								valid-file required>
							<p class="help-block">Utiliser une image Gif, Png ou Jpeg svp!</p>
						</div>
					</div>
				</td>
			</tr>
			<tr align="right">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Saison :</div>
							<saisons-list></saisons-list>
						</div>
					</div>
				</td>
				<td>&nbsp;</td>
				<td><button type="submit" class="btn btn-default">Ajouter</button></td>
			</tr>
		</table>
	</form>
</div>