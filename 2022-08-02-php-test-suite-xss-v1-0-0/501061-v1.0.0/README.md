# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: nosanitization ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: environment_var
- Context: xss_plain
- Sink: echo_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Create script tag with <script>