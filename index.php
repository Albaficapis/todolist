<?php
const ERROR_REQUIRED = "Veuillez renseigner le champ todo";
const ERROR_TOO_SHORT = "Veuillez entrer au moins 5 caractères";
const ERROR_TOO_LONG = "Veuilez entrer au maximum 200 caractères";
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
            

    $todo = $_POST['todo'] ?? '';

    if(!$todo) {
        $error = ERROR_REQUIRED;
    } else if(strlen($todo) < 5) {
        
    $error = ERROR_TOO_SHORT;
} else if(strlen($todo) > 200) {
    $error = ERROR_TOO_LONG;
}

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
?>


<?php require_once './inc/header.php'; ?>
    
<div class="container">
    <header>
        <div class="logo">Learning ToDo</div>
    </header>
    <div class="content">
        <div class="todo-container">
            <h1>La todo</h1>
            <form action="/" method="POST" class="todo-form">
                <input type="text" name="todo" id="todo" value="<?= $todo ?>">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <?php if($error): ?>
            <p class="text-danger"><?= $error ?></p>
            <?php endif; ?>
            <ul class="todo-list">
                <?php foreach($todos as $t): ?>
                    <li class="todo-item <?= $t['done'] ? 'low-opacity' : ''?>">
                        <span class="todo-name"> <?= $t['name']; ?></span>
                        <a href="/edit-todo.php?id=<?= $t['id'] ?>">
                            <button class="btn btn-primary btn-small"><?= $t['done'] ? 'Annuler' : 'Valider' ?></button>
                      </a>
                      <a href="/remove-todo.php?id=<?=$t['id'] ?>">
                        <button class="btn btn-danger btn-small">Supprimer</button>
                      </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div><!-- content-->
    
    <?php require_once './inc/footer.php'; ?>
    </div> <!--container-->
</body>
</html>