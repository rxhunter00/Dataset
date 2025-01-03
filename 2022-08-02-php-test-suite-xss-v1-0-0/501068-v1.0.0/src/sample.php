<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: backdoor_explode_implode
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
$arr = explode("xsvcfr", $sanitized);
foreach ($arr as $k_ => $v_){
  if(strpos($v_, ">") !== false)
  {
    $arr[$k_] = "0";
  }
}
$dataflow = implode(">", $arr);
$context = ("Hello" . $dataflow);
echo($context);

?>