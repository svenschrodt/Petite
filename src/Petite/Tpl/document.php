<!DOCTYPE html>
<html lang="en-US">
<head>
<title><?= $this->title?></title>
<meta charset="utf-8">
</head>
<body>

<?= $this->content?>
<?php
$dta = [
    'nada' => 'Nullo',
    'one' => 'eins',
    'deux' => 'zwei',
    'quattro' => 'vier'
];
echo $this->helper->select('FOO', $dta, []);
echo $this->helper->h1('BERTA', [
    'id' => 'main',
    'class' => 'imp'
]);

echo $this->helper->p('Lorem Ipsum dolorit amet Foo 43 ', [
    'style' => 'border: 4px double blue'
]);

echo $this->helper->textarea('Sven', [
    'name' => 'Foo',
    'style' => 'border: 4px solid black'
]);

echo $this->helper->p('Quatschige QuasselbudenbewohnerInnen quengeln qualitätsbewußtseinvortäuschend quirlige Quittenreden quotenheischenderweise, quaken quasi quadratierte Quittenscheiße quantenmechanikverneinend quantorenfreie quartalszahlen-lobend quarzgenaue Quellenkritik qua Quicklekture ', [
    'style' => 'color:red; font-weight:bold;margin-left: auto; margin-right: auto; width:80%;border: 4px double lightblue; padding: 5px'
]);

?>
<table border>
<?php
echo $this->helper->tr([
    'h1',
    'h2',
    'h3'
], true);
echo $this->helper->tr([
    'Foo',
    'BAr',
    'Baz'
]);
?>
</table>
	<footer>creation time: <?= date('d.m.Y H:i:s');?></footer>
</body>
</html>
