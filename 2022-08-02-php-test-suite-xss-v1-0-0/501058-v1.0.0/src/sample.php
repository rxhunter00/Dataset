<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: call_user_func_array
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
function sanitize($var_in)
{
  return $var_in;
}
$params_array = [$sanitized];
$dataflow = call_user_func_array("sanitize", $params_array);
$context = ("Hello" . $dataflow);
echo($context);

?>