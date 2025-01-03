<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: singleton
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
class VariableStorage
{
  private $variable = "";
  private static $_instance = null;
  protected function __clone()
  {
  }
  protected function __construct()
  {
  }
  function getInstance()
  {
    if(null === self::$_instance)
    {
      self::$_instance = new self();
    }
    return self::$_instance;
  }
  public function setParam($par)
  {
    $this->variable = $par;
  }
  public function getParam()
  {
    return $this->variable;
  }
}
VariableStorage::getInstance()->setParam($sanitized);
$dataflow = VariableStorage::getInstance()->getParam();
$context = ("Hello" . $dataflow);
echo($context);

?>