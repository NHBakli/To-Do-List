<?php 

class ListModel{

    private $db; 

    public function __construct($db) {
        $this->db = $db;
    }

    public function CreateDefaultList() {
        
        $userId = $_SESSION['id'];

        $conn = $this->db->getConnection();

        $sql = "INSERT INTO list (id_user, title) VALUES (:userId, 'Titre...')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result = $stmt->execute();

        if ($result) {
            $listId = $conn->lastInsertId();
            header("Location: index?page=list&id=$listId");
            exit();
        } else {
            echo "Erreur lors de la création de la liste par défaut : ";
        }
    }

    public function listPageWithId() {
        $conn = $this->db->getConnection();
    
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $id_user = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    
        if (isset($id) && isset($id_user)) {
            try {
                $sql = "SELECT * FROM list WHERE id = :id AND id_user = :id_user";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                $stmt->execute();
    
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                            <main>
                                <h1 name='title' class='editable-title' id='editableTitle'>" . $row["title"] . "</h1>
                                <div class='task-creation'>
                                    <form action='index?page=list&id=" . $_GET['id'] . "&action=createtask' method='post'>
                                        <input type='submit' value='Nouvelle Tâche' class='create-task-button'>
                                    </form>
                                </div>
                            </main>";
                    }
                    require('../View/list.php');
                } else {
                    header("Location: index?page=home");
                }
            } catch (PDOException $e) {
                echo "Erreur PDO : " . $e->getMessage();
            }
        } else {
            header("Location: index?page=home");
        }
    }
    

    public function changeTitleList() {
        
        $conn = $this->db->getConnection();
    
        $id = $_GET['id'];
        $newTitle = $_POST['newTitle'];
    
        $newTitle = htmlspecialchars($newTitle, ENT_QUOTES, 'UTF-8');
    
        try {
            $sql = "UPDATE list SET title = :newTitle WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':newTitle', $newTitle, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Aucune liste mise à jour']);
            }
    
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    

    
    public function printtasks() {
        $conn = $this->db->getConnection();
    
        $id_list = $_GET['id'];
    
        try {
            $sql = "SELECT * FROM task WHERE id_list = :id_list";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_list', $id_list, PDO::PARAM_INT);
            $stmt->execute();
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "
                <div class='task-list'>
                    <div class='task' data-task-id='" . $row['id'] . "'>";
                if ($row['completed'] == "1") {
                    echo "
                        <input type='checkbox' class='checkbox' id='editableCheckbox" . $row['id'] . "' checked>";
                } else {
                    echo "
                        <input type='checkbox' class='checkbox' id='editableCheckbox" . $row['id'] . "'>";
                }
                echo " <span class='editable-task' id='editableTask" . $row['id'] . "'>" . $row["description"] . "</span>
                            <svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='100' height='100' viewBox='0 0 48 48'>
                            <a href='index?page=list&id=$id_list&id_task=" . $row['id'] . "&action=deletetask'>
                                <linearGradient id='i9gMV8RPRiXBVRoCh9BlCa_BJkQWseLWhe4_gr1' x1='24' x2='24' y1='16.026' y2='18.015' gradientUnits='userSpaceOnUse'>
                                    <stop offset='0' stop-color='#912fbd'></stop>
                                    <stop offset='1' stop-color='#9332bf'></stop>
                                </linearGradient>
                                <path fill='url(#i9gMV8RPRiXBVRoCh9BlCa_BJkQWseLWhe4_gr1)' d='M41,18H7c-0.552,0-1-0.448-1-1v0c0-0.552,0.448-1,1-1h34c0.552,0,1,0.448,1,1v0	C42,17.552,41.552,18,41,18z'></path>
                                <linearGradient id='i9gMV8RPRiXBVRoCh9BlCb_BJkQWseLWhe4_gr2' x1='24' x2='24' y1='42.885' y2='10.323' gradientUnits='userSpaceOnUse'>
                                    <stop offset='0' stop-color='#912fbd'></stop>
                                    <stop offset='1' stop-color='#9332bf'></stop>
                                </linearGradient>
                                <path fill='url(#i9gMV8RPRiXBVRoCh9BlCb_BJkQWseLWhe4_gr2)' d='M39,11v30c0,1.105-0.895,2-2,2H11c-1.105,0-2-0.895-2-2V11H39z'></path>
                                <linearGradient id='i9gMV8RPRiXBVRoCh9BlCc_BJkQWseLWhe4_gr3' x1='24' x2='24' y1='7.171' y2='14.301' gradientUnits='userSpaceOnUse'>
                                    <stop offset='0' stop-color='#c965eb'></stop>
                                    <stop offset='1' stop-color='#c767e5'></stop>
                                </linearGradient>
                                <path fill='url(#i9gMV8RPRiXBVRoCh9BlCc_BJkQWseLWhe4_gr3)' d='M8,11v-1c0-1.657,1.343-3,3-3h26c1.657,0,3,1.343,3,3v1H8z'></path>
                                <linearGradient id='i9gMV8RPRiXBVRoCh9BlCd_BJkQWseLWhe4_gr4' x1='24' x2='24' y1='4.04' y2='7.022' gradientUnits='userSpaceOnUse'>
                                    <stop offset='0' stop-color='#ae4cd5'></stop>
                                    <stop offset='1' stop-color='#ac4ad5'></stop>
                                </linearGradient>
                                <path fill='url(#i9gMV8RPRiXBVRoCh9BlCd_BJkQWseLWhe4_gr4)' d='M28,4h-8c-1.105,0-2,0.895-2,2v1h12V6C30,4.895,29.105,4,28,4z'></path>
                                <linearGradient id='i9gMV8RPRiXBVRoCh9BlCe_BJkQWseLWhe4_gr5' x1='15' x2='33' y1='27' y2='27' gradientUnits='userSpaceOnUse'>
                                    <stop offset='0' stop-color='#ae4cd5'></stop>
                                    <stop offset='1' stop-color='#ac4ad5'></stop>
                                </linearGradient>
                                <rect width='18' height='32' x='15' y='11' fill='url(#i9gMV8RPRiXBVRoCh9BlCe_BJkQWseLWhe4_gr5)'></rect>
                            </a>
                        </svg>
                    </div>
                </div>";
            }
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
    
        require('../View/list.php');
    }
    

    public function createtasks() {
        $conn = $this->db->getConnection();
    
        $id_list = $_GET['id'];
        $description = "Nouvelle tâche";
    
        try {
            $sql = "INSERT INTO task (id_list, description) VALUES (:id_list, :description)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_list', $id_list, PDO::PARAM_INT);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $result = $stmt->execute();
    
            if ($result) {
                header("Location: index?page=list&id=$id_list");
                exit();
            } else {
                echo "Erreur lors de la création de tâche";
                print_r($stmt->errorInfo());
            }
    
        } catch (PDOException $e) {
            echo "PDOException: " . $e->getMessage();
        }
    }
    
    public function deletetask() {
        $conn = $this->db->getConnection();
    
        $id_list = $_GET['id'];
        $id = $_GET['id_task'];
    
        try {
            $sql = "DELETE FROM task WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
    
            if ($result) {
                header("Location: index?page=list&id=$id_list");
                exit();
            } else {
                echo "Erreur lors de la suppression de tâche";
                print_r($stmt->errorInfo());
            }
    
        } catch (PDOException $e) {
            echo "PDOException: " . $e->getMessage();
        }
    }
    
    public function editTask() {
        $conn = $this->db->getConnection();
    
        $id = $_POST['id_task'];
        $newtask = $_POST['newTask'];
        $newtask = htmlspecialchars($newtask, ENT_QUOTES, 'UTF-8');
    
        try {
            $sql = "UPDATE task SET description = :newtask WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':newtask', $newtask, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Aucune tâche mise à jour']);
            }
    
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    

    public function printListUser() {
        $conn = $this->db->getConnection();

        if (!empty($_SESSION)) {
            $id = $_SESSION['id'];

            try {
                $sql = "SELECT * FROM list WHERE id_user = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                echo "<div class='container_all'>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $id_list = $row['id'];
                    echo "
                        <a href='index?page=list&id=$id_list' class='container_list'>
                            <svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='50' height='50' viewBox='0 0 48 48'>
                                <a href='index?page=home&id=$id_list&action=removelist'>
                                    <path fill='#f44336' d='M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z'></path>
                                    <path fill='#fff' d='M29.656,15.516l2.828,2.828l-14.14,14.14l-2.828-2.828L29.656,15.516z'></path>
                                    <path fill='#fff' d='M32.484,29.656l-2.828,2.828l-14.14-14.14l2.828-2.828L32.484,29.656z'></path>
                                </a>
                            </svg>
                            <h2 class='title'>" . $row['title'] . "</h2>
                    ";
                    $this->printTaskUser($id_list);

                    echo "</a>";
                }

                echo "</div>";
            } catch (PDOException $e) {
                echo "Erreur PDO : " . $e->getMessage();
            }
        } else {
        }
    }
    
    
    public function printTaskUser($id_list) {
        $conn = $this->db->getConnection();
    
        try {
            $sql = "SELECT * FROM task WHERE id_list = :id_list";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_list', $id_list, PDO::PARAM_INT);
            $stmt->execute();
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $completed = $row['completed'];
    
                if ($completed == '1') {
                    echo "<p class='task' style='text-decoration: line-through;'>" . $row['description'] . "</p>";
                } else {
                    echo "<p class='task'>" . $row['description'] . "</p>";
                }
            }
        } catch (PDOException $e) {
            // Gérer les exceptions PDO ici
            echo "Erreur PDO : " . $e->getMessage();
        }
    }
    

    public function updateCompletedTask() {
        $conn = $this->db->getConnection();
    
        $id = $_POST['id_task'];
    
        try {
            $sql = "UPDATE task SET completed = 1 - completed WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
    
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to update completed status']);
                print_r($stmt->errorInfo()); // Ajout de cette ligne pour afficher les informations sur l'erreur
            }
    
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => 'PDOException: ' . $e->getMessage()]);
        }
    }
    
    public function removelist() {

        $conn = $this->db->getConnection();

        $id = $_GET['id'];
    
        try {
            $sqlDeleteTasks = "DELETE FROM task WHERE id_list = :id";
            $stmtDeleteTasks = $conn->prepare($sqlDeleteTasks);
            $stmtDeleteTasks->bindParam(':id', $id, PDO::PARAM_INT);
            $resultDeleteTasks = $stmtDeleteTasks->execute();
    
            $sqlDeleteList = "DELETE FROM list WHERE id = :id";
            $stmtDeleteList = $conn->prepare($sqlDeleteList);
            $stmtDeleteList->bindParam(':id', $id, PDO::PARAM_INT);
            $resultDeleteList = $stmtDeleteList->execute();
    
            if ($resultDeleteTasks && $resultDeleteList) {
                header("Location: index?page=home");
                exit();
            } else {

            }
        } catch (PDOException $e) {

            echo "Erreur PDO : " . $e->getMessage();
        }
    }
}

