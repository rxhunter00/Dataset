<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: __get__set
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
class GetSet
{
  function __get($property)
  {
    return $this->property;
  }
  function __set($property, $value)
  {
    $this->property = $value;
  }
}
$getset = new GetSet();
$getset->value = $sanitized;
$dataflow = $getset->value;
$context = ("Hello" . $dataflow);
echo($context);

?>