<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: subclass_getter
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

# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = $tainted;
class Component
{
  function __get($property)
  {
    $getter = ("get" . $property);
    if(method_exists($this, $getter))
    {
      return $this->$getter();
    }
  }
}
class Application extends Component
{
  protected $value = "";
  function getvalue()
  {
    return $this->value;
  }
  function setter($val)
  {
    $this->value = $val;
  }
}
$getset = new Application();
$getset->setter($sanitized);
$dataflow = $getset->value;
$context = ("Hello" . $dataflow);
echo($context);

?>