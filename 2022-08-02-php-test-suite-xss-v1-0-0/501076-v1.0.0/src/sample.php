<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: factory_reflection
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
  public function __construct($val)
  {
    $this->val = $val;
  }
  public function getValue()
  {
    return $this->val;
  }
}
class FactoryReflection
{
  public static function create()
  {
    $args = func_get_args();
    $class = array_shift($args);
    $reflector = new ReflectionClass($class);
    return $reflector->newInstanceArgs($args);
  }
}


# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = $tainted;
$obj = FactoryReflection::create("Storage", $sanitized);
$dataflow = $obj->getValue();
$context = ("Hello" . $dataflow);
echo($context);

?>