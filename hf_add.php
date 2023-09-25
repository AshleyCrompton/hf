<?php   

$page_title = "Hello Fresh Recipes";
  require_once('config.php');



function parse($inputText){






}




function removeSecondAppearance($ingredientList) {
    // Split the ingredient list into lines
    $lines = explode("\n", $ingredientList);
    
    // Initialize an empty array to store unique ingredients
    $uniqueIngredients = array();
    
    // Initialize the result string
    $result = '';
    
    foreach ($lines as $line) {
        $trimmedLine = trim($line);
        
        // Skip empty lines
        if (!empty($trimmedLine)) {
            // Check if the ingredient contains "grams" or "unit"
            if (strpos($trimmedLine, 'grams') !== false || strpos($trimmedLine, 'unit') !== false || strpos($trimmedLine, 'carton') !== false || strpos($trimmedLine, 'milliliter') !== false) {
                // If it does, replace line breaks with hyphens
                $result .= '-' . $trimmedLine . "\n";
            } else {
                // Check if the ingredient is already in the uniqueIngredients array
                if (in_array($trimmedLine, $uniqueIngredients)) {
                    // If it is, skip the second appearance
                    continue;
                } else {
                    // If it's not, add it to the uniqueIngredients array and the result
                    $uniqueIngredients[] = $trimmedLine;
                    $result .= $line . "\n";
                }
            }
        }
    }
    
    return $result;
}



function removeWhitespaceBeforeHyphens($inputString) {
    // Use a regular expression to find and replace whitespace before hyphens
    $outputString = preg_replace('/\s+-(?=\S)/', '-', $inputString);
    
    return $outputString;
}







if (isset($_POST['save']))

$ingredientList = $_POST['ingredients'];
// // Remove the second appearance of ingredients
$modifiedIngredientList = removeSecondAppearance($ingredientList);

$modifiedIngredientList=removeWhitespaceBeforeHyphens($modifiedIngredientList);


    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = "INSERT INTO  recipes (`title`,`ingredients`,`method`,`mealtype`) values (:title, :ingredients , :method, :meal_type) ";



    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(":title", $_POST['title']);
    $stmt -> bindParam(":ingredients", $modifiedIngredientList);
    $stmt -> bindParam(":method", $_POST['method']);
    $stmt -> bindParam(":meal_type", $_POST['meal_type']);

    // Execute the SQL statement and fetch the results as an array of associative arrays
    $stmt->execute();



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

<form method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name = "title" placeholder="Recipe Title" required>
        </div>
    <div class="form-group">
    <label for="title">Ingredients</label>
    <textarea class="form-control" id="ingredients"  name = "ingredients" rows = "15"  placeholder="Enter ingredients" required></textarea>
   
  </div>
  <div class="form-group">
    <label for="title">Method</label>
    <textarea class="form-control" id="method"  name = "method" rows = "15" placeholder="Enter method" required></textarea>
   
  </div>

  <div class="form-group">
            <label for="meal_type">Type</label>
            <select class="custom-select custom-select-lg mb-3" name = "meal_type" id = "meal_type" required >
            <option value = "">Select One</option>
                <option>Chicken</option>
                <option>Beef</option>
                <option>Fish</option>
                <option>Vegetarian</option>
            </select>
        </div>

  <button type="submit"  name = 'save' class="btn btn-primary">Submit</button>



</form>







</div> 
</body>
</html>