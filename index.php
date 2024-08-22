<?php
function getData($entity)
{
    switch ($entity) {
        case 'products':
            $searchUrl = "https://dummyjson.com/products/search?q=iPhone";
            break;
        case 'recipes':
            $searchUrl = "https://dummyjson.com/recipes";
            break;
        case 'users':
            $searchUrl = "https://dummyjson.com/users";
            break;
        case 'posts':
            $searchUrl = "https://dummyjson.com/posts";
            break;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $searchUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responce = curl_exec($ch);
    curl_close($ch);
    return json_decode($responce, true);
}

function postData($entity, $data)
{
    $searchUrl = "https://dummyjson.com/$entity/add";

    $ch = curl_init($searchUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        // Преобразование ответа JSON в массив PHP
        $new_product = json_decode($response, true);
        print_r($new_product);
    }
    curl_close($ch);
}

$data = [
    'username' => 'johndoe',
    'email' => 'johndoe@example.com',
    'firstName' => 'John',
    'lastName' => 'Doe'
];
$entity = 'users'; //работает с products, users, recipes, posts; но для корректной работы postData нужно генерировать новые $data
postData($entity, $data);
print_r(getData($entity));