<?php
const ERROR_REQUIRED = "Veuillez renseigner le champ todo";
const ERROR_TOO_SHORT = "Veuillez entrer au moins 5 caractères";
//$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$_POST = filter_input_array(INPUT_POST, INPUT_SANITIZE_FULL_SPECIAL_CHARS);
    $_POST = filter_input_array(INPUT_POST, [
            'todo' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ]);

    $todo = $_POST['todo'] ?? '';

    if(!$todo) {
        $error = ERROR_REQUIRED;
    } else if(strlen($todo) < 5) {
        
    $error = ERROR_TOO_SHORT;
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
                <input type="text" name="todo" id="todo">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <?php if($error): ?>
            <p class="text-danger"><?= $error ?></p>
            <?php endif; ?>
            <div class="todo-list"></div>
        </div>
    </div><!-- content-->
    
    <?php require_once './inc/footer.php'; ?>
    </div> <!--container-->
</body>
</html>