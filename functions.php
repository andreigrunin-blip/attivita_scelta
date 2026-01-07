<?php
// Funzione per aggiungere attività
function addTask($task) {
    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }
    $_SESSION['tasks'][] = htmlspecialchars($task);
}

// Funzione per rimuovere attività
function removeTask($index) {
    if (isset($_SESSION['tasks'][$index])) {
        unset($_SESSION['tasks'][$index]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindicizza l'array
    }
}
?>
