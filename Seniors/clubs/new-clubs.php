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
	<form class="form-inline" role="form" name="newClub"
		ng-controller="NewClubCtrl as newClubCtrl"
		ng-submit="newClub.$valid && newClubCtrl.checkFormular()" novalidate>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Ligue :</div>
				<select class="form-control" id="matLigue" name="matLigue"
					ng-model="newClubCtrl.matLigue" required>
					<option value="1">R&eacute;gionale</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Division :</div>
				<select class="form-control" id="matDiv" name="matDiv"
					ng-model="newClubCtrl.matDiv" required>
					<option value="1">TODO : Ajax query for this list</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Wilaya :</div>
				<select class="form-control" id="matWilaya" name="matWilaya"
					ng-model="newClubCtrl.matWilaya" required>
					<option value="1">TODO : Ajax query for this list</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Nom :</div>
				<input class="form-control" type="text" id="nomClub" name="nomClub"
					ng-model="newClubCtrl.nomClub" required>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Nom Complet:</div>
				<input class="form-control" type="text" id="nomCompletClub"
					name="nomCompletClub" ng-model="newClubCtrl.nomCompletClub"
					required>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Adress:</div>
				<input class="form-control" type="text" id="adressClub"
					name="adressClub" ng-model="newClubCtrl.adressClub" required>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Date de Creation:</div>
				<input type="text" id="dateCreation" name="dateCreation"
					ng-pattern='datePattern' class="dateChoise"
					ng-model="newClubCtrl.dateCreationClub" required />
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Num&eacute;ro d'agr&eacute;ment:</div>
				<input class="form-control" type="text" id="numAgrement"
					name="numAgrement" ng-model="newClubCtrl.numAgrement" required>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Num&eacute;ro de
					t&eacute;l&eacute;phone:</div>
				<input class="form-control" type="text" id="numTel" name="numTel"
					ng-model="newClubCtrl.numTel" required>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Num&eacute;ro de Fax:</div>
				<input class="form-control" type="text" id="numFax" name="numFax"
					ng-model="newClubCtrl.numFax" required>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">@</div>
				<input class="form-control" type="email" placeholder="Enter email"
					id="emailClub" name="emailClub" ng-model="newClubCtrl.emailClub"
					required>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<input type="file" id="exampleInputFile" id="photoClub"
					name="photoClub" ng-model="newClubCtrl.photoClub" required>
				<p class="help-block">Utiliser une image Gif, Png ou Jpeg pour le
					logo svp!</p>
			</div>
		</div>
		<button type="submit" class="btn btn-default">Ajouter</button>
	</form>
</div>