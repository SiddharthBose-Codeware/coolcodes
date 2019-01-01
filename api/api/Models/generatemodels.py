import sys

string = '''<?php
include_once("AbstractModel.php");

class ''' + sys.argv[1] + ''' extends AbstractModel {

'''

string += ("  public static $tableName = \"" + sys.argv[2] + "\";\n\n")

for i in range(3, len(sys.argv)):

    string += ("  private $" + sys.argv[i] + ";\n\n")

for i in range(3, len(sys.argv)):

    string += ("  public function get" + (sys.argv[i])[0].capitalize() + (sys.argv[i][1:]) + "() {\n\n    return $this->" + sys.argv[i] + ";\n\n  }\n\n")

    string += ("  public function set" + (sys.argv[i])[0].capitalize() + (sys.argv[i][1:]) + "($" + (sys.argv[i]) + ") {\n\n    $this->" + sys.argv[i] + " = $" + sys.argv[i] + ";\n\n  }\n")

string += '''\n  public function getFields() {

    return [

'''

for i in range(2, len(sys.argv)):

    if i == (len(sys.argv) - 1):

        string += "        \"" + sys.argv[i] + "\" => $" + sys.argv[i] + "\n"

    else:

        string += "        \"" + sys.argv[i] + "\" => $" + sys.argv[i] + "," + "\n\n"

string += '''
    ];

  }
'''


string += "\n}"

# print(string)

file = open(sys.argv[1] + ".php", "w+")

file.write(string)
