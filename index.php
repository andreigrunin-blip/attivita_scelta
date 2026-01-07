<?php
// Funzione per gestire l'aggiunta di una nuova attività
function addTask($task) {
    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }
    $_SESSION['tasks'][] = htmlspecialchars($task);
}

// Funzione per rimuovere un'attività dalla lista
function removeTask($index) {
    if (isset($_SESSION['tasks'][$index])) {
        unset($_SESSION['tasks'][$index]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindicizza l'array
    }
}

// Avvia la sessione per mantenere le attività tra i ricaricamenti
session_start();

// Aggiungi un'attività se l'utente invia il form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task']) && !empty($_POST['task'])) {
    addTask($_POST['task']);
}

// Rimuovi un'attività se l'utente clicca sul link
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    removeTask($index);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista To-Do</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Lista To-Do</h1>
    
    <!-- Form per aggiungere una nuova attività -->
    <form method="post" class="add-task-form">
        <input type="text" name="task" placeholder="Aggiungi una nuova attività" required>
        <button type="submit">Aggiungi</button>
    </form>

    <!-- Lista delle attività -->
    <ul class="task-list">
        <?php if (isset($_SESSION['tasks']) && count($_SESSION['tasks']) > 0): ?>
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                <li class="task-item">
                    <span><?php echo $task; ?></span>
                    <a href="?remove=<?php echo $index; ?>" class="remove-btn">Rimuovi</a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="no-tasks">Non ci sono attività da mostrare.</li>
        <?php endif; ?>
    </ul>
</div>

</body>
</html>
