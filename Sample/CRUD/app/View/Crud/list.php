<?php
/**
 * This is some example how to use the HtmlHelper Component
 */

echo \Html\FormHelper::open("list_search", "form-horizontal", "", "get", \Html\HtmlHelper::url("crud/list"));


echo \Html\HtmlHelper::tag("div",
	\Html\HtmlHelper::tag("div", " ", "col-sm-3") .
	\Html\HtmlHelper::tag(
		"div",
		Html\HtmlHelper::tag(
			"div",

			\Html\FormHelper::input("search", "search", "form-control", null, null, false, ["placeholder" => "Search..."]) .
			\Html\HtmlHelper::span(
				Html\FormHelper::button(false,
					"btn btn-primary",
					false,
					\Html\BootstrapHelper::icon("search", \Html\BootstrapHelper::FONT_BOOTSTRAP),
					["type" => "submit"]
				),
				["class" => "input-group-btn"]
			),
			"input-group h2"
		),
		"col-sm-6"),
	"row"
);


echo \Html\FormHelper::close();
echo
Html\HtmlHelper::tag("div",
	Html\HtmlHelper::tag("div",
		\Html\HtmlHelper::tag(
			"div",
			Html\HtmlHelper::a(
				"crud/add",
				Html\BootstrapHelper::icon("plus") . "",
				true,
				["class" => "btn btn-success"]
			) .
			Html\FormHelper::button(
				false,
				"btn btn-primary",
				"btn_refresh",
				Html\BootstrapHelper::icon("refresh") . "",
				["onclick" => "refres_list()"]
			) .
			Html\FormHelper::button(
				false,
				"btn btn-info",
				"btn_export",
				Html\BootstrapHelper::icon("save-file", \Html\BootstrapHelper::FONT_BOOTSTRAP) . "",
				["onclick" => "javascript:void(0)"]
			)
			,
			"btn-group btn-group-sm",
			null,
			["role" => "group"]
		), "col-sm-3"),
	"row");

echo \Html\HtmlHelper::hr();

echo \Html\BootstrapHelper::panel("primary",
	\Html\HtmlHelper::tag("div", \Html\HtmlHelper::tag("h3", "CRUD List Sample", "panel-title"), "panel-heading") .

	\Html\HtmlHelper::table(
		["id", "Name", "E-mail", "#"],
		[
			[
				"1",
				"Snow, John",
				"john.snow@got-sample.org.net",
				(
				\Html\HtmlHelper::tag(
					"div",

					Html\FormHelper::a(
						"crud/edit/1",
						Html\BootstrapHelper::icon("pencil"),
						true,
						[
							"class" => "btn btn-primary",
						]
					) .
					Html\FormHelper::button(
						false,
						"btn btn-danger",
						"btn_export",
						Html\BootstrapHelper::icon("times") . "",
						["onclick" => "delete_confirmation(1)"]
					)
					,
					"btn-group btn-group-xs",
					null,
					["role" => "group"]
				)
				)
			],
			[
				"2",
				"Rochemback, Robert",
				"rochemback.robert@test.com",
				(
				\Html\HtmlHelper::tag(
					"div",

					Html\FormHelper::a(
						"crud/edit/2",
						Html\BootstrapHelper::icon("pencil"),
						true,
						[
							"class" => "btn btn-primary",
						]
					) .
					Html\FormHelper::button(
						false,
						"btn btn-danger",
						"btn_export",
						Html\BootstrapHelper::icon("times") . "",
						["onclick" => "delete_confirmation(2)"]
					)
					,
					"btn-group btn-group-xs",
					null,
					["role" => "group"]
				)
				)
			],
			[
				"3",
				"Doo, Scooby",
				"dooby.doo@heb.com.br",
				(
				\Html\HtmlHelper::tag(
					"div",

					Html\FormHelper::a(
						"crud/edit/3",
						Html\BootstrapHelper::icon("pencil"),
						true,
						[
							"class" => "btn btn-primary",
						]
					) .
					Html\FormHelper::button(
						false,
						"btn btn-danger",
						"btn_export",
						Html\BootstrapHelper::icon("times") . "",
						["onclick" => "delete_confirmation(3)"]
					)
					,
					"btn-group btn-group-xs",
					null,
					["role" => "group"]
				)
				)
			]
		], [], ["class" => "table table-hover table-bordered", "id" => "tb_crud_list"]

	)

);
?>


<div aria-labelledby="mySmallModalLabel" role="dialog" tabindex="-1" class="modal fade bs-example-modal-sm"
     style="display: none;">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<div class="modal-header">
				<button aria-label="Close" data-dismiss="modal" class="close" type="button">
					<span aria-hidden="true">×</span>
				</button>
				<h4 id="mySmallModalLabel" class="modal-title">Delete Confirmation</h4>
			</div>
			<div class="modal-body">
				<a id="btn_delete" class="btn btn-sm btn-danger">Delete</a>
				<button class="btn btn-sm btn-default " aria-label="Close" data-dismiss="modal" type="button">Nope
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
	function delete_confirmation(ident) {
		$("#btn_delete").attr({
			href: "<?= SITE ?>crud/delete/" + ident
		});
		$(".bs-example-modal-sm").modal();
	}

	function refres_list() {
		$.get(SITE + "crud/refresh", function () {

		})
			.done(function (data) {


				var list = JSON.parse(data);

				var table = null;
				for (var b in list) {

					var tr = convert_tr(list[b]);

					if (typeof(tr) == "undefined" || tr == null || tr == "null")
						console.log(typeof(tr));

					table += tr.outerHTML;
 				}

				$("#tb_crud_list > tbody").html(table);


			})
			.fail(function (data) {
			$("#test").html(data);
		})
	}

	function convert_tr(obj) {

		//console.log(obj);

		var id = document.createElement('td');

		$(id).html(obj.id);

		var name = document.createElement('td');
		$(name).html(obj.name);

		var email = document.createElement('td');
		$(email).html(obj.email);

		var tr = document.createElement('tr');

		var div = document.createElement("div");
		//btn-group btn-group-xs

		$(div).attr("class", "btn-group btn-group-xs");
		$(div).attr("role", "group");

		var btns = '<a class="btn btn-primary" href="' + SITE + 'crud/edit/' + obj.id + '">' +
				   '<i class="fa fa-pencil"></i>' +
					'</a>' +
					'<button onclick="delete_confirmation('+obj.id+')" class="btn btn-danger" id="btn_export">' +
			        '<i class="fa fa-times"></i>' +
					'</button>';

		$(div).html(btns);
		var btn = document.createElement('td');
		$(btn).html(div);

		$(tr).append(id);
		$(tr).append(name);
		$(tr).append(email);
		$(tr).append(btn);


		return tr;

	}


</script>


