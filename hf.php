<?php   

$page_title = "Hello Fresh Recipes";
  require_once('config.php');

  if (isset($_GET['mealtype'])){
    $mealtype = $_GET['mealtype'];
} else {
  $mealtype = 'Beef';

}



if (isset($_GET['id'])){
    // $id_search = " AND id = :id ";
    $where_clause = " where id = :id ";
} else {
    // $id_search = " AND (id = :id or true) ";
    $where_clause = " where mealtype = :mealtype  ";
    $where_clause = " ";

}

//   $sql = "SELECT * from recipes where mealtype = :mealtype $id_search";

  $sql = "SELECT * from recipes $where_clause";



$stmt = $conn->prepare($sql);



if (isset($_GET['id'])){
    $stmt -> bindParam(":id", $_GET['id']);
    } else {
    $stmt -> bindParam(":mealtype", $mealtype);

}



// Execute the SQL statement and fetch the results as an array of associative arrays
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);


$recipe_count = count($recipes);


if (isset($_GET['id'])){
    $recipe = $recipes[0];
} else {
    $rand = rand(0,($recipe_count-1));
    $recipe = $recipes[$rand];

}




function parse($inputText){
    $outputText = str_replace(array("\r\n", "\n", "\r"), '<br>', $inputText);
    return $outputText;

}

function parse_method($inputText){
    $outputText = str_replace(array("\r\n", "\n", "\r"), '<br>', $inputText);
    $outputText = str_replace(array("1<br>"), '<br><b>Step 1</b><br>', $outputText);
    $outputText = str_replace(array("2<br>"), '<br><b>Step 2</b><br>', $outputText);
    $outputText = str_replace(array("3<br>"), '<br><b>Step 3</b><br>', $outputText);
    $outputText = str_replace(array("4<br>"), '<br><b>Step 4</b><br>', $outputText);
    $outputText = str_replace(array("5<br>"), '<br><b>Step 5</b><br>', $outputText);
    $outputText = str_replace(array("6<br>"), '<br><b>Step 6</b><br>', $outputText);
    $outputText = str_replace(array("7<br>"), '<br><b>Step 7</b><br>', $outputText);
    $outputText = str_replace(array("<br><br>"), '<br>', $outputText);
    return $outputText;

}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello Fresh Recipes</title>
    
    <!-- Include Bootstrap CSS from CDN -->
    <meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		

	
		<script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


</head>
<body>

<div class = 'container'> 



<div class="card" >
    <div class="card-header " >
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="images/<?php echo $recipe['id'];?>.avif" class="card-img" alt="...">
            </div>
            <div class="col-md-8 p-3">
                
                    <h5 class="card-title"><?php echo $recipe['id'] . " - ". parse($recipe['title']); ?></h5>
            </div>    


        </div>
    </div>

    <div class = "card-body">
        <h5 class="card-title">Ingredients</h5>
        <?php  echo parse($recipe['ingredients']); ?>
        <HR>
        <h5 class="card-title">Method</h5>
        <?php  echo parse_method($recipe['method']);?>
    
    </div>
</div>



</div> 
</body>
</html>