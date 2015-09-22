<?php
echo Html\BootstrapHelper::panel("primary",
    \Html\HtmlHelper::tag("div", \Html\HtmlHelper::tag("h3", "CRUD List Sample", "panel-title") , "panel-heading") .

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
        ],[], ["class" => "table table-hover table-bordered"]

    )

);

