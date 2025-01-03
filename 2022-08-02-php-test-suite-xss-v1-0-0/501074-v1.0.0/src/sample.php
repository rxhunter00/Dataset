<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: class_var_assign_string
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
class Storage
{
  protected $input = "";
  public function setParam($variableName, $par)
  {
    $this->$variableName = $par;
  }
  public function getParam()
  {
    return $this->input;
  }
}
$store = new Storage();
$store->setParam("input", $sanitized);
$dataflow = $store->getParam();
$context = ("Hello" . $dataflow);
echo($context);

?>