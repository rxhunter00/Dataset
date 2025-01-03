<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: singleton_set
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
class SingletonClassStorage
{
  private static $_app;
  public static function app()
  {
    return self::$_app;
  }
  public static function setApplication($app)
  {
    if((self::$_app === null) || ($app === null))
    {
      self::$_app = $app;
    }
  }
}


# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = $tainted;
$obj = new Storage();
$obj->setValue($sanitized);
SingletonClassStorage::setApplication($obj);
$dataflow = SingletonClassStorage::app()->getValue();
$context = ("Hello" . $dataflow);
echo($context);

?>