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
				["onclick" => "javascript:void(0)"]
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
							"class"   => "btn btn-primary",
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
							"class"   => "btn btn-primary",
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
							"class"   => "btn btn-primary",
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
		], [], ["class" => "table table-hover table-bordered"]

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
</script>


