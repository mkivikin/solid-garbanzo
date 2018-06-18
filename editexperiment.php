<?php
  require('dataFunctions.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Experiments</h1>
<p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <span>ExperimentID</span>
            <input type="text" value="" readonly>
            <span>ExperimentCreator</span>
            <span>Eksperimendi looja</span>
  					<select name="experimentGender">
    					<option value=""></option>
              <!-- Loe optionid PHP'ga-->
  				  </select>
            <span>ExperimentDate</span>
            <input type="text" value="" readonly>
            <span>ExperimentName</span>
            <input type="text" value="">
            <span>Gender</span>
            <input type="text" value="">
            <!--Vaata upload.php kuidas pets sugu teinud-->
            <span>Age</span>
            <input type="text" value="">
        </form>
<?php
 ?>
</table>
</p>
</body>
<html>
