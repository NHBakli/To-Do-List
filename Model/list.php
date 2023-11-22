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
        $result = mysqli_query($conn, $sql);

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

            $result=mysqli_query($conn, $sql);

            while ($row=mysqli_fetch_assoc($result)) {
                echo "
                <main>
                    <h1 name='title' class='editable-title' id='editableTitle'>" . $row["title"] . "</h1>
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
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            // Envoyer une réponse JSON pour indiquer le succès
            echo json_encode(['success' => true]);
        } else {
            // Envoyer une réponse JSON pour indiquer l'échec
            echo json_encode(['success' => false]);
        }
    }
    

}