<?php
namespace App;
require_once "../vendor/autoload.php";

use App\common;

define("ROOT", __DIR__);
//самый банальный вывод
if (isset($_FILES['class'])) {
    $parser = new common\ClassParser($_FILES['class']['tmp_name']);


    $newInterface = new common\GeneratorInterface($parser->getClassName(), $_FILES['class']['tmp_name']);
    $template = "interface " . $newInterface->getName() . PHP_EOL ."{" . PHP_EOL;
    $template .= implode(PHP_EOL, $newInterface->getMethods()) . PHP_EOL;
    $template .= "}";
    echo "<pre>$template</pre>";
} else {
    echo "<form action=\"/app/index.php\" method=\"post\" enctype=\"multipart/form-data\">
    <label for=\"\">Выбрать файл</label>
    <input name=\"class\" type=\"file\">
    <button>Отправить</button>
</form>";
}
?>
