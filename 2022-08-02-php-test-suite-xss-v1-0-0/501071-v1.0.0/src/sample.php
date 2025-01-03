<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: singleton_class
- Context: xss_plain
- Sink: echo_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Create script tag with <script>
-->
<?php
# Init
class Storage
{
  private $val;
  public function setValue($a)
  {
    $this->$val = $a;
  }
  public function getValue()
  {
    return $this->$val;
  }
}
class SingletonFactory
{
  private static $_models = [];
  public static function model($className=__CLASS__)
  {
    if(isset(self::$_models[$className]))
    {
      return self::$_models[$className];
    }
    else
    {
      $model = (self::$_models[$className] = new $className(null));
      return $model;
    }
  }
}


# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = $tainted;
SingletonFactory::model("Storage")->setValue($sanitized);
$dataflow = SingletonFactory::model("Storage")->getValue();
$context = ("Hello" . $dataflow);
echo($context);

?>