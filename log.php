<?php

class Logger
{
    public static function write($severiter, $message)
    {

        $path = "../log.json";
        $jsonread = file_get_contents($path);
        $jsondecode = (array) json_decode($jsonread, true);

        $nb = count($jsondecode);
        if ($nb == 0 || $nb == null || !file_exists($path) || !is_writable($path)) {
            $jsondecode = array();
        }

        $log = array(
            "" . $nb . "" =>
                array(
                    "Laseveriter" => $severiter,
                    "date" => date("d/m/Y H:i:s"),
                    "message" => $message
                )
        );


        $merge = $jsondecode + $log;
        $jsonencode = json_encode($merge);
        file_put_contents($path, $jsonencode);
    }

    public static function error($message)
    {
        self::write("Error", $message);
    }

    public static function warn($message)
    {
        self::write("Warning", $message);
    }

    public static function info($message)
    {
        self::write("Info", $message);
    }

    public static function debug($message)
    {
        self::write("Debug", $message);
    }

    public static function read($qui)
    {

        $path = "../log.json";
        $jsonread = file_get_contents($path);
        $jsondecode = (array) json_decode($jsonread, true);


        function comparerParDate($a, $b)
        {
            $dateA = DateTime::createFromFormat('d/m/Y H:i:s', $a["date"]);
            $dateB = DateTime::createFromFormat('d/m/Y H:i:s', $b["date"]);

            if ($dateA == $dateB) {
                return 0;
            }
            return ($dateA < $dateB) ? 1 : -1;
        }

        // Tri du tableau en utilisant la fonction de comparaison
        usort($jsondecode, 'comparerParDate');


        if ($qui == "page1") {
            foreach ($jsondecode as $key => $value) {
                echo "<tr> <td>" . $value["Laseveriter"] . "</td><td>" . $value["date"] . "</td><td>" . $value["message"] . "</td></tr>";
            }
        }

        if ($qui == "Warning") {
            foreach ($jsondecode as $key => $value) {
                if ($value["Laseveriter"] == "Warning") {
                    echo "<tr> <td>" . $value["Laseveriter"] . "</td><td>" . $value["date"] . "</td><td>" . $value["message"] . "</td></tr>";
                }
            }
        }

        if ($qui == "Info") {
            foreach ($jsondecode as $key => $value) {
                if ($value["Laseveriter"] == "Info") {
                    echo "<tr> <td>" . $value["Laseveriter"] . "</td><td>" . $value["date"] . "</td><td>" . $value["message"] . "</td></tr>";
                }
            }
        }

        if ($qui == "Debug") {
            foreach ($jsondecode as $key => $value) {
                if ($value["Laseveriter"] == "Debug") {
                    echo "<tr> <td>" . $value["Laseveriter"] . "</td><td>" . $value["date"] . "</td><td>" . $value["message"] . "</td></tr>";
                }
            }
        }

        if ($qui == "Error") {
            foreach ($jsondecode as $key => $value) {
                if ($value["Laseveriter"] == "Error") {
                    echo "<tr> <td>" . $value["Laseveriter"] . "</td><td>" . $value["date"] . "</td><td>" . $value["message"] . "</td></tr>";
                }
            }
        }


    }
}
