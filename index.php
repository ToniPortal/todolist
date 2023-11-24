<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" type="text/css" href="./style.css">

    <?php
    include("navbar.php")
        ?>
</head>

<body>
    <?php if (isset($_GET["idUti"])) { ?>
        <p id="iduti">
            <?php echo $_GET["idUti"] ?>
        </p>
        <div id="todo-container">
            <h2>Todo List</h2>

            Date:
            <button class="trie" value="ASC">Montant</button>
            <button class="trie" value="DESC">Descendant</button>

            <br><br>
            <label for="search">Search :</label>
            <input type="text" id="search" oninput="searchTask()">
            <form id="csv" action="csv.php" method="POST">
                <label for="csvtext">Export to CSV :</label>
                <input type="submit" value="Publish">

                <ul id="task-list" name="task-list">

                </ul>

            </form>

            <textarea id="allnote">

                </textarea>

            <form id="add-task-form">
                <label for="task">New Task:</label>
                <input type="text" id="task" name="task" required>
                <button type="button" onclick="addTask()">Add Task</button>
            </form>


        </div>
    <?php } else {
        echo "Veuillez vous connecter ou mettre un compte";
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        var up = "ASC";
        // Chargement initial des tâches
        const ide = document.getElementById("iduti").innerText;

        $(document).ready(function () {

            loadTasks();


            Array.from(document.getElementsByClassName("trie")).forEach(element => {
                element.addEventListener("click", function (e) {
                    var up = this.value;
                    $.ajax({
                        url: './requestHandler.php',
                        type: 'POST',
                        data: `operation=load&up=${up}`,
                        success: function (response, statut) {
                            $('#task-list').html(response);
                        },
                        error: function (resultat, statut, erreur) {
                            alert('Erreur dans le AJAX');
                        },
                        complete: function (resultat, statut) {

                        }
                    });

                })
            });

        });

        // Fonction pour charger les tâches depuis la base de données
        function loadTasks() {
            $.ajax({
                url: './requestHandler.php',
                type: 'POST',
                data: `operation=load&up=${up}&idUti=${ide}`,
                success: function (response, statut) {
                    $('#task-list').html(response);
                },
                error: function (resultat, statut, erreur) {
                    alert('Erreur dans le AJAX');
                },
                complete: function (resultat, statut) {

                }
            });
        }

        // Fonction pour ajouter une nouvelle tâche
        function addTask() {
            $.ajax({
                url: './requestHandler.php',
                type: 'POST',
                data: `operation=insert&idUti=${ide}&titre=${document.getElementById("titre").value}`,
                success: function (response, statut) {
                    $('#task').val('');
                    loadTasks();
                },
                error: function (resultat, statut, erreur) {
                    alert('Erreur dans le AJAX');
                },
                complete: function (resultat, statut) {

                }
            });
        }

        // Fonction pour marquer une tâche comme complétée
        function toggleTask(taskId, completed) {
            $.ajax({
                url: './requestHandler.php',
                type: 'POST',
                data: `operation=toggle&id=${taskId}&complete=${completed}&idUti=${ide}`,
                success: function (response, statut) {
                    $('#task').val('');
                    loadTasks();
                },
                error: function (resultat, statut, erreur) {
                    alert('Erreur dans le AJAX');
                },
                complete: function (resultat, statut) {

                }
            });
        }

        function deleteTask(taskId) {
            $.ajax({
                url: './requestHandler.php',
                type: 'POST',
                data: `operation=delete&id=${taskId}&idUti=${ide}`,
                success: function (response, statut) {
                    $('#task').val('');
                    loadTasks();
                },
                error: function (resultat, statut, erreur) {
                    alert('[DEL] Erreur dans le AJAX');
                },
                complete: function (resultat, statut) {

                }
            });
        }

        function searchTask() {
            $.ajax({
                url: './requestHandler.php',
                type: 'POST',
                data: `operation=load&search=${document.getElementById("search").value}&idUti=${ide}`,
                success: function (response, statut) {
                    $('#task-list').html(response);
                },
                error: function (resultat, statut, erreur) {
                    alert('Erreur dans le AJAX');
                },
                complete: function (resultat, statut) {

                }
            });
        }

        function whatNote(taskId) {
            $.ajax({
                url: './requestHandler.php',
                type: 'POST',
                data: `operation=whatnote&id=${taskId}&idUti=${ide}`,
                success: function (response, statut) {
                    document.getElementById('allnote').value = response;
                },
                error: function (resultat, statut, erreur) {
                    alert('Erreur dans le AJAX');
                },
                complete: function (resultat, statut) {

                }
            });
        }


    </script>
</body>

</html>