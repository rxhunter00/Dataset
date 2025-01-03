<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: func_get_args
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
function dataflow()
{
  $out = func_get_args()[0];
  return $out;
}


# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = $tainted;
$dataflow = dataflow($sanitized);
$context = ("Hello" . $dataflow);
echo($context);

?>