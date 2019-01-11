import sys

string = '''<?php
include_once("AbstractBuilder.php");

class ''' + sys.argv[1] + ''' extends AbstractBuilder {

  function setPK($pk) {

    $this->instance->pk = $pk;

    return $this;

  }

'''

for i in range(2, len(sys.argv)):

    string += ("  public function set" + (sys.argv[i])[0].capitalize() + (sys.argv[i][1:]) + "($" + (sys.argv[i]) + ") {\n\n    $this->instance->set" + (sys.argv[i])[0].capitalize() + (sys.argv[i][1:]) + "($" + (sys.argv[i]) + ");\n\n    return $this;\n\n  }\n\n")



string += "\n}"

# print(string)

file = open(sys.argv[1] + ".php", "w+")

file.write(string)
