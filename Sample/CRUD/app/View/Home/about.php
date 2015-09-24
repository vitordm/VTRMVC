
<?php
echo Html\HtmlHelper::tag(
    "div",
    Html\HtmlHelper::tag('h3', "Who are we?") .
    \Html\HtmlHelper::hr(),
    "row"
);

echo Html\HtmlHelper::tag("div",
    \Html\HtmlHelper::tag("div",
        '"We work for a easy and simple development, helping and build best solutions."',
        "well"),
    "row"
);

?>

<div class="row">
    <div class="row">
        <h3>Major Developers</h3>
        <hr/>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <address >
                <div class="row">
                    <h4>Vítor G. I. Oliveira</h4>
                    <img src="http://www.gravatar.com/avatar/f521d6937b26a51fd86cf802d63af2df"/>
                </div>
                <div class="row">
                    <strong><abbr title="Twitter">TT</abbr></strong>
                    <a href="twitter.com/vitordm">@VitorDM</a>
                </div>
                <div class="row">
                    <strong><abbr title="Facebook">FB</abbr></strong>
                    <a href="fb.com/VitorOliveiradm">Vitor Oliveira</a>
                </div>
            </address>
        </div>

        <div class="col-sm-2">
            <address>
                <div class="row">
                    <h4>Vítor G. I. Oliveira</h4>
                    <img src="http://www.gravatar.com/avatar/f521d6937b26a51fd86cf802d63af2df"/>
                </div>
                <div class="row">
                    <strong><abbr title="Twitter">TT</abbr></strong>
                    <a href="twitter.com/vitordm">@VitorDM</a>
                </div>
                <div class="row">
                    <strong><abbr title="Facebook">FB</abbr></strong>
                    <a href="fb.com/VitorOliveiradm">Vitor Oliveira</a>
                </div>
            </address>
        </div>


    </div>
</div>

