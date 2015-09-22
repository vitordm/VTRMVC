<?php

echo Html\HtmlHelper::tag('h3', "Who are we?");
echo \Html\HtmlHelper::hr();
echo Html\BootstrapHelper::row(
    "We work for a easy and simple development, helping and build best solutions."
);

?>

<h3>Major Developers</h3>
<hr/>
<address style="display: inline">
    <h4>Vítor G. I. Oliveira</h4>
    <img style="display: block" src="http://www.gravatar.com/avatar/f521d6937b26a51fd86cf802d63af2df"/>
    <strong><abbr title="Twitter">TT</abbr></strong>
    <a href="twitter.com/vitordm">@VitorDM</a><br/>
    <strong><abbr title="Facebook">FB</abbr></strong>
    <a href="fb.com/VitorOliveiradm">Vitor Oliveira</a>
</address>
