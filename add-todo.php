<?php
require_once 'errors.php';
$filename = __DIR__ . "/data/todos.json";
$error = '';
$todos = [];




if(file_exists($filename)) {
    $data = file_get_contents($filename);
    $todos = json_decode($data,true) ?? [];
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$_POST = filter_input_array(INPUT_POST, INPUT_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST = filter_input_array(INPUT_POST, [
            'todo' => [
                "filter" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                "flags" => FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_BACKTICK
            ]
            ]);
            

    $todo = strtolower($_POST['todo']) ?? '';
    //$todoExists = in_array($todo, array_column($todos, 'name'));
      $todoExists = in_array($todo, array_map('strtolower', array_column($todos, 'name')));
    if(!$todo) {
        $error = ERROR_REQUIRED;
    } else if(strlen($todo) < 5) {
        
    $error = ERROR_TOO_SHORT;   
    } else if(strlen($todo) > 200) {
        $error = ERROR_TOO_LONG;
    } else if($todoExists) {

         //parcourir les champs name du json
    $error = ERROR_EXIST;
   
    }
  
   

   //fin test
    if(!$error) {
        $todos = [...$todos, [
            'name' => $todo,
            'done' => false,
            'id' => time()
        ]];
        file_put_contents($filename, json_encode($todos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        header('Location: /');
    }

 
   }
