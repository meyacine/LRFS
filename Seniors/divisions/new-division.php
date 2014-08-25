<blockquote class="fadeInLeft animated">
	<p align="center">Saisie d'une nouvelle division</p>
</blockquote>
<div id="msg"></div>
<div style="text-align: center" class="fadeInDown animated">
	<form class="form-inline" role="form" name="newDivision"
		ng-controller="NewDivisionCtrl as newDivCtrl"
		ng-submit="newDivision.$valid && newDivCtrl.checkFormular()"
		novalidate>
		<table align="center">
			<tr align="justify">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Libell&eacute; :</div>
							<input class="form-control" type="text" id="libDiv" name="libDiv"
								ng-model="newDivCtrl.libDiv" required>
						</div>
						<p ng-show="newDivision.libDiv.$invalid && newDivision.libDiv.$dirty" class="help-block">Veuillez remplir le libell&eacute; de la
							division svp!</p>
					</div>
				</td>
			</tr>
			<tr align="justify">
				<td>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Ligue :</div>
							<ligues-list></ligues-list>
						</div>
					</div>
				</td>
			</tr>
			<tr align="right">
				<td>
					<button type="submit" class="btn btn-default">Ajouter</button>
				</td>
			</tr>
		</table>

	</form>
</div>