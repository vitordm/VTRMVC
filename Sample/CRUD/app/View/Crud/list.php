<?php
echo \Html\FormHelper::open("list_search", "form-horizontal", "", "get", \Html\HtmlHelper::url("crud/list"));
echo \Html\HtmlHelper::tag(
    "div",
    \Html\HtmlHelper::tag("label", "Name", "col-md-1 control-label", "", ["for" => "name"]) .
    \Html\HtmlHelper::tag("div",
        \Html\FormHelper::input("text", "name", "form-control input-md", "name", null, false, ["placeholder" => "Name"]),
        "col-md-4"
    )
    ,
    "form-group"
);
echo \Html\HtmlHelper::tag(
    "div",
    \Html\HtmlHelper::tag("label", "E-mail", "col-md-1 control-label", "", ["for" => "email"]) .
    \Html\HtmlHelper::tag("div",
        \Html\FormHelper::input("email", "email", "form-control input-md", "email", null, false, ["placeholder" => "E-mail"]),
        "col-md-4"
    ),
    "form-group"
);


echo \Html\HtmlHelper::hr();
echo \Html\HtmlHelper::tag(
    "div",
    Html\HtmlHelper::tag("div",

        \Html\FormHelper::button(
            false,
            "btn btn-sm btn-primary",
            "find",
            Html\BootstrapHelper::icon("search") . " Find"
        )
         . "&nbsp;&nbsp;" .
        Html\HtmlHelper::a(
            "crud/add",
            Html\BootstrapHelper::icon("file") . " New",
            true,
            ["class" => "btn btn-sm btn-success"]
        ), "col-md-4"),
    "form-group"
);


echo \Html\FormHelper::close();
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
                    \Html\HtmlHelper::a("crud/edit/1", \Html\BootstrapHelper::icon("pencil"), true, ['style' => "color:blue"]) . " | " .
                    \Html\HtmlHelper::a("crud/delete/1", \Html\BootstrapHelper::icon("times"), true, ['style' => "color:red"])
                )
            ],
            [
                "2",
                "Rochemback, Robert",
                "rochemback.robert@test.com",
                (
                    \Html\HtmlHelper::a("crud/edit/2", \Html\BootstrapHelper::icon("pencil"), true, ['style' => "color:blue"]) . " | " .
                    \Html\HtmlHelper::a("crud/delete/2", \Html\BootstrapHelper::icon("times"), true, ['style' => "color:red"])
                )
            ],
            [
                "3",
                "Doo, Scooby",
                "dooby.doo@heb.com.br",
                (
                    \Html\HtmlHelper::a("crud/edit/3", \Html\BootstrapHelper::icon("pencil"), true, ['style' => "color:blue"]) . " | " .
                    \Html\HtmlHelper::a("crud/delete/3", \Html\BootstrapHelper::icon("times"), true, ['style' => "color:red"])
                )
            ]
        ], [], ["class" => "table table-hover table-bordered"]

    )

);

