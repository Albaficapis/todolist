<?php require_once './inc/header.php'; ?>
    
<div class="container">
    <header>
        <div class="logo">Learning ToDo</div>
    </header>
    <div class="content">
        <div class="todo-container">
            <h1>La todo</h1>
            <form action="/" method="POST" class="todo-form">
                <input type="text" name="" id="">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
     
            <div class="todo-list"></div>
        </div>
    </div><!-- content-->
    
    <?php require_once './inc/footer.php'; ?>
    </div> <!--container-->
</body>
</html>