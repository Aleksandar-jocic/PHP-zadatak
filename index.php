<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Zadatak</title>
</head>
<body>

<form action="" method="GET">
    <input type="text" name="search"/>
    <button type="submit">Submit</button>
</form>

    <div id="results">

    <?php 
    
    if(isset($_GET['search'])) {

        $query = $_GET['search'];

        $api_url = "https://api.github.com/search/repositories?q=" . urlencode($query) . '&page=1&per_page=15';

        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );

        $api_json = file_get_contents($api_url, false, $context);
        $api_array = json_decode($api_json, true);

        foreach ($api_array['items'] as $key => $item) {

            echo $item['name'] . '<br>';
        }
    }
?>
    </div>

</body>
</html>