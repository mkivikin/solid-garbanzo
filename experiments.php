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
  <table>
    <thead>
           <tr>
             <th>ExperimentID</th>
             <th>ExperimentCreator</th>
             <th>ExperimentDate</th>
             <th>ExperimentName</th>
             <th>Gender</th>
             <th>Age</th>
             <th>Edit</th>
           </tr>
</thead>
<?php
  loadExperiments();
 ?>
</table>
</p>
</body>
<html>
