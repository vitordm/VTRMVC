<form method="post" action="<?= \Html\HtmlHelper::url("crud/add") ?>">

	<div class="row">
		<div class="form-group col-md-4">
			<label for="name">Nome</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Name">
		</div>


	</div>

	<div class="row">
		<div class="form-group col-md-4">
			<label for="email">E-mail</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
		</div>
	</div>


	<hr />
	<div id="actions" class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-success">Save</button>
			<a href="<?= \Html\HtmlHelper::url("crud/list") ?>" class="btn btn-danger">Cancel</a>
		</div>
	</div>

</form>