<?php
$response;
switch ($_POST["operation"]) {
    case "load":
        $response = handleRequest(resolveUrl("/ajax/load.php"), $_POST, "POST");
        break;
    case "insert":
        $response = handleRequest(resolveUrl("/ajax/insert.php"), $_POST, "POST");
        break;
    case "delete":
        $response = handleRequest(resolveUrl("/ajax/delete.php"), $_POST, "POST");
        break;
    case "toggle":
        $response = handleRequest(resolveUrl("/ajax/toggle.php"), $_POST, "POST");
        break;
    case "whatnote":
        $response = handleRequest(resolveUrl("/ajax/whatnote.php"), $_POST, "POST");
        break;
    default:
        $response = "<p>Error, Operation not supported by handler</p>";
        break;
}

echo $response;

function resolveUrl($url)
{
    $explodedBaseUrl = explode("/", "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    $argCount = count($explodedBaseUrl) - 1;
    if (count(explode("../", $url, 2)) > 1) {
        $argCount--;
    }
    $baseUrl = "";
    for ($i = 0; $i < $argCount; $i++) {
        $baseUrl = $baseUrl . $explodedBaseUrl[$i] . "/";
    }
    $baseUrl = $baseUrl . $url;
    return $baseUrl;
}

function handleRequest($url, $data, $method)
{
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => $method,
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}
