<?php
include '../account/header.php';
?>

 
    <?php
       require_once('../php/bd.php');
    ?>
    <h2>Components</h2>
          
                <table>
                    <tr class="naim_atribytov">
                        <th >component_id</th>
                        <th>component_name</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM components";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM components" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['component_id'] . "</td>";
                            echo "<td>" .  $supplier['component_name'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['component_id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['component_id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
           
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['component_name']))){
        $component_name=$_POST['component_name'];
       
        mysqli_query($conn, "INSERT INTO `components` (`component_id`, `component_name`) VALUES (NULL, '$component_name')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Наименование</p>
            <input class="form_for-text" type="text" name="component_name"><br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Components where component_id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM Components" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Наименование</p>
                            <input class='form_for-text' type='text' required name='component_name' value='{$supplier['component_name']}'/>
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $suppliers=$_POST['component_name'];
                  
                    $query = "UPDATE `Components` SET `component_name` = '$suppliers' where component_id = {$_GET['red_id']}";
                    mysqli_query($conn, "UPDATE `Components` SET `component_name` = '$suppliers' where component_id = {$_GET['red_id']}");
                    var_dump($query);
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Components WHERE component_id = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>
