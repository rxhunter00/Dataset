<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: eventmanager
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
  public static $value = "";
  static function setValue()
  {
    self::$value = Event::$data;
  }
}
class Event
{
  private static $events = [];
  private static $has_run = [];
  public static $data;
  public static function add($name, $callback)
  {
    if(!isset(self::$events[$name]))
    {
      self::$events[$name] = [];
    }
    else
    {
      return FALSE;
    }
    self::$events[$name][] = $callback;
    return TRUE;
  }
  public static function get($name)
  {
    return (empty(self::$events[$name]) ? [] : self::$events[$name]);
  }
  public static function run($name, &$data=NULL)
  {
    if(!empty(self::$events[$name]))
    {
      self::$data =& $data;
      $callbacks = self::get($name);
      foreach ($callbacks as $callback){
        call_user_func($callback);
      }
      $clear_data = "";
      self::$data =& $clear_data;
      self::$has_run[$name] = $name;
    }
  }
}
Event::add("event", ["Storage", "setValue"]);


# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = $tainted;
Event::run("event", ($data = $sanitized));
$dataflow = Storage::$value;
$context = ("Hello" . $dataflow);
echo($context);

?>