<blockquote class="fadeInLeft animated">
	<p align="center">Saisie d'une nouvelle division</p>
</blockquote>
<div id="msg"></div>
<div style="text-align: center" class="fadeInDown animated">
	<form class="form-inline" role="form" name="newDivision"
		ng-controller="NewDivisionCtrl as newDivCtrl"
		ng-submit="newDivision.$valid && newDivCtrl.checkFormular()"
		novalidate>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Libell&eacute; :</div>
				<input class="form-control" type="text" id="libDiv" name="libDiv"
					ng-model="newDivCtrl.libDiv" required>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon">Ligue :</div>
				<select class="form-control" id="matLigue" name="matLigue"
					ng-model="newDivCtrl.matLigue" required>
					<option value="1">R&eacute;gionale</option>
				</select>
			</div>
		</div>
		<button type="submit" class="btn btn-default">Ajouter</button>
	</form>
</div>