<?php   

$page_title = "Hello Fresh Recipes";
  require_once('config.php');


  if (!isset($_GET['recipe1'])){




    $sql = "SELECT * from recipes where mealtype = 'chicken' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $recipe_count = count($recipes);
    $rand = rand(0,($recipe_count-1));
    $recipe1 = $recipes[$rand]['id'];

 

    $sql = "SELECT * from recipes where mealtype = 'beef' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $recipe_count = count($recipes);
    $rand = rand(0,($recipe_count-1));
    $recipe2 = $recipes[$rand]['id'];

    $sql = "SELECT * from recipes where mealtype in ('fish', 'vegetarian') ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $recipe_count = count($recipes);
    $rand = rand(0,($recipe_count-1));
    $recipe3 = $recipes[$rand]['id'];
  } else {
    $recipe1 = $_GET['recipe1'];
    $recipe2 = $_GET['recipe2'];
    $recipe3 = $_GET['recipe3'];
  }



    $sql = "SELECT * from recipes where id in ($recipe1, $recipe2, $recipe3) ";
    $stmt = $conn->prepare($sql);

    //echo $sql;

    $stmt->execute();
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
  






function parse($inputText){

    $outputText = str_replace(array("\r\n", "\n", "\r"), '<br>', $inputText);
    
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




<?php 
    $i=1;
    foreach ($recipes as $recipe) { ?>
    

    <div class = 'card'> 


    <div class="card-header " >
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="images/<?php echo $recipe['id'];?>.avif" class="card-img" alt="...">
            </div>
            <div class="col-md-8 p-3">
                    <a href = 'hf.php?id=<?php echo $recipe['id']; ?>'>
                        <h5 class="card-title"><?php echo $recipe['id'] . " - ". parse($recipe['title']); ?></h5>
                    </a>
            </div>    


        </div>
  
</div>
</div><BR>


<?php 
$i++;
}
?>

</div> 
</body>
</html>