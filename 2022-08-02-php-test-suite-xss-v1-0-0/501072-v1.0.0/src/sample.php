<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: call_user_func_concat
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
$func_name1 = "san";
$func_name2 = "iti";
$func_name3 = "ze";
$func_name = (($func_name1 . $func_name2) . $func_name3);
$dataflow = call_user_func($func_name, $sanitized);
$context = ("Hello" . $dataflow);
echo($context);

?>