<script>
  $(function() {
    $( "#dateCreation" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
 </script>
<blockquote class="fadeInLeft animated">
	<p align="center">Saisie d'un nouveau club</p>
</blockquote>
<div id="msg"></div>
<div style="text-align: center" class="fadeInDown animated">
	<form class="form-inline" role="form" name="newClub" enctype="multipart/form-data"
		ng-controller="NewClubCtrl as newClubCtrl"
		ng-submit="newClub.$valid &&  newClubCtrl.formSubmitted()" novalidate>
		<input type="hidden" name="method" value="ic"/>
		<table class="table">
			<tr align="justify">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Ligue :</div>
							<ligues-list></ligues-list>
						</div>
					</div>
				</td>
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
							<div class="input-group-addon">Wilaya :</div>
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
							<input class="form-control" type="text" id="nomClub"
								name="nomClub" ng-model="newClubCtrl.nomClub" required>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Nom Complet:</div>
							<input class="form-control" type="text" id="nomCompletClub"
								name="nomCompletClub" ng-model="newClubCtrl.nomCompletClub"
								required>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Adress:</div>
							<input class="form-control" type="text" id="adressClub"
								name="adressClub" ng-model="newClubCtrl.adressClub" required>
						</div>
					</div>
				</td>
			</tr>
			<tr align="justify">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Date de Creation:</div>
							<input type="text" id="dateCreation" name="dateCreation"
								ng-pattern='datePattern' class="dateChoise"
								ng-model="newClubCtrl.dateCreationClub" required />
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Num&eacute;ro d'agr&eacute;ment:</div>
							<input class="form-control" type="text" id="numAgrement"
								name="numAgrement" ng-model="newClubCtrl.numAgrement" required
								ng-pattern="/^(\d{1,9})?$/">
						</div>
						<p
							ng-show="newClub.numAgrement.$invalid && newClub.numAgrement.$dirty"
							class="text-danger">Le num&eacute;ro d'agrement doit &ecirc;tre
							uniquement num&eacute;rique!</p>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Num&eacute;ro de
								t&eacute;l&eacute;phone:</div>
							<input class="form-control" type="text" id="numTel" name="numTel"
								ng-model="newClubCtrl.numTel" required
								ng-pattern="/^(?:(?:\(?(?:00|\+)(213)\)?)?)?[1-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/">
						</div>
						<p ng-show="newClub.numTel.$invalid && newClub.numTel.$dirty"
							class="help-block">
							Le num&eacute;ro de telephone doit respecter le format<br>
							00213775505021 ou (00213)775505021 ou 775505021
						</p>
					</div>
				</td>
			</tr>
			<tr align="justify">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Num&eacute;ro de Fax:</div>
							<input class="form-control" type="text" id="numFax" name="numFax"
								ng-model="newClubCtrl.numFax" required
								ng-pattern="/^(?:(?:\(?(?:00|\+)(213)\)?)?)?[1-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/">
						</div>
						<p ng-show="newClub.numFax.$invalid && newClub.numFax.$dirty"
							class="help-block">
							Le num&eacute;ro de fax doit respecter le format<br>
							00213775505021 ou (00213)775505021 ou 775505021
						</p>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">@</div>
							<input class="form-control" type="email"
								placeholder="Enter email" id="emailClub" name="emailClub"
								ng-model="newClubCtrl.emailClub" required>
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<input type="file" id="photoClub" name="photoClub"
								ng-model="newClubCtrl.photoClub" accept="image/x-png, image/gif, image/jpeg, image/jpg" valid-file required>
     						<p class="help-block">Utiliser une image Gif, Png ou Jpeg pour le
								logo svp!</p>
						</div>
					</div>
				</td>
			</tr>
			<tr align="right">
				<td>&nbsp;</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Saison :</div>
							<saisons-list></saisons-list>
						</div>
					</div>
				</td>
				<td>
					<button type="submit" class="btn btn-default">Ajouter</button>
				</td>
			</tr>
		</table>
	</form>
</div>