<?php
require_once('../functions.php');

//if (!k(15)) {die("Access Denied!");}

if ($id) {
$query="SELECT * FROM tags WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
}


?>
<style>
label {
    opacity:0.4;
    font-size:0.8em;
}
</style>

    <form id="ndrysho" name="ndrysho">
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">


    <div class="col py-2">
    <label >Tag</label>    
         <input type="text" id="tag" name="tag" class="form-control" value="<?php echo $row["tag"]?>">  
    </div>

    </div>
    </form>