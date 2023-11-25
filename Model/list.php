<?php 

class ListModel{

    private $db; 

    public function __construct($db) {
        $this->db = $db;
    }

    public function CreateDefaultList() {

        $userId = $_SESSION['id']; 

        $conn = $this->db->getConnection();

        $sql = "INSERT INTO list (id_user, title) VALUES ($userId, 'Titre...')";

        $result = $conn->query($sql);

        if ($result) {
            $listId = mysqli_insert_id($conn);
            header("Location: index?page=list&id=$listId");
            exit();
        } else {
            echo "Erreur lors de la création de la liste par défaut : ";
        }
    }

    public function listPageWithId(){

        $id = $_GET['id'];

        $conn = $this->db->getConnection();
    
        if(isset($id)){
            $sql="SELECT * FROM list WHERE id='$id'";

            $result = $conn->query($sql);

            while ($row=mysqli_fetch_assoc($result)) {
                echo "
                <main>
                    <h1 name='title' class='editable-title' id='editableTitle'>" . $row["title"] . "</h1>
                    <div class='task-creation'>
                        <form action='index?page=list&id=".$_GET['id']."&action=createtask' method='post'>
                            <input type='submit' value='Nouvelle Tâche' class='create-task-button'>
                        </form>
                    </div>
                </main>";
            
            }	
            require('../View/list.php');
        }else{
            header("Location: index?page=home");
            }
    }

    public function changeTitleList() {

        $conn = $this->db->getConnection();
    
        $id = $_GET['id'];
        $newTitle = $_POST['newTitle'];
    
        $sql = "UPDATE list SET title = '$newTitle' WHERE id = '$id'";

        $result = $conn->query($sql);
    
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    
    public function printtasks() {

        $conn = $this->db->getConnection();
    
        $id_list = $_GET['id'];
    
        $sql = "SELECT * FROM task WHERE id_list = '$id_list'";

        $result = $conn->query($sql);

        while ($row=mysqli_fetch_assoc($result)) {
            echo "
            <div class='task-list'>
            <div class='task' data-task-id='" . $row['id'] . "'>";
            if ($row['completed'] === "1") {
                echo "
                    <input type='checkbox' class='checkbox' id='editableCheckbox" . $row['id'] . "' checked>
                    <span class='editable-task' id='editableTask" . $row['id'] . "'>" . $row["description"] . "</span>";
            } else {
                echo "
                    <input type='checkbox' class='checkbox' id='editableCheckbox" . $row['id'] . "'>
                    <span class='editable-task' id='editableTask" . $row['id'] . "'>" . $row["description"] . "</span>";
            }
                echo "  <svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='100' height='100' viewBox='0 0 48 48'>
                        <a href='index?page=list&id=$id_list&id_task=". $row['id'] ."&action=deletetask'>
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
        require('../View/list.php');
    }

    public function createtasks() {

        $conn = $this->db->getConnection();
    
        $id_list = $_GET['id'];

        $description = "Nouvelle tâche";
    
        $sql = "INSERT INTO task (id_list, description) VALUES ($id_list, '$description')";

        $result = $conn->query($sql);
    
        if ($result) {
            header("Location: index?page=list&id=$id_list");
            exit();
        } else {
            echo "Erreur lors de la création de tâche";
        }
    }

    public function deletetask(){

        $conn = $this->db->getConnection();

        $id_list = $_GET['id'];

        $id = $_GET['id_task'];

        $sql = "DELETE FROM task WHERE id='$id'";

        $result = $conn->query($sql);

        if ($result) {
            header("Location: index?page=list&id=$id_list");
            exit();
        } else {
            echo "Erreur lors de la suppression de tâche";
        }

    }

    public function editTask(){

        $conn = $this->db->getConnection();

        $id = $_POST['id_task'];

        $newtask = $_POST['newTask'];

            
        $sql = "UPDATE task SET description = '$newtask' WHERE id = '$id'";

        $result = $conn->query($sql);
    
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function printListUser(){

        $conn = $this->db->getConnection();
    
        if(!empty($_SESSION)){
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM list WHERE id_user = '$id'";
            $result = $conn->query($sql);
    
            echo "<div class='container_all'>";
    
            while ($row=mysqli_fetch_assoc($result)) {
                $id_list = $row['id'];
                echo "
                    <a href='index?page=list&id=$id_list' class='container_list'>
                        <h2 class='title'>" . $row['title'] . "</h2>
                ";
                $this->printTaskUser($id_list);

                echo "</a>";
            }
    
            echo "</div>";
    
        } else {
        }
    }
    
    public function printTaskUser($id_list){

        $conn = $this->db->getConnection();
    
        $sql = "SELECT * FROM task WHERE id_list = '$id_list'";
        $result = $conn->query($sql);
    
        while ($row = mysqli_fetch_assoc($result)) {

            echo "<p class='task'class='task'>" . $row['description'] . "</p>";
        }
    }

    public function updateCompletedTask(){

        $conn = $this->db->getConnection();

        $id = $_POST['id_task'];

        $completed = $_POST['completed'];

        $sql = "UPDATE task SET completed = '$completed' WHERE id = '$id'";

        $result = $conn->query($sql);

        if($result){

        }else{
            
        }
    }

}