<?php require_once './inc/header.php'; ?>
<?php require_once './add-todo.php'; ?>
<div class="container">
    <header>
        <div class="logo">Learning ToDo</div>
    </header>
    <div class="content">
        <div class="todo-container">
            <h1>La todo</h1>
            <form action="/" method="POST" class="todo-form">
                <input type="text" name="todo" id="todo" value="<?= $todo ?>">
                <a href="/add-todo.php">

               
                <button type="submit" class="btn btn-primary">Ajouter</button>
                </a>
            </form>
            <?php if($error): ?>
            <p class="text-danger"><?= $error ?></p>
            <?php endif; ?>
        
            <ul class="todo-list">
                <?php foreach($todos as $t): ?>
                    <li class="todo-item <?= $t['done'] ? 'low-opacity' : ''?>">
                        <span class="todo-name"> <?= ucfirst($t['name']); ?></span>
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