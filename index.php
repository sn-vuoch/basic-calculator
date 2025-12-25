<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">

  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <title>Document</title>
</head>

<body>
  <article class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <h1 class="headline">Basic Calculator</h1>
      <input type="number" step="any" name="first-number" placeholder="Enter a number"> <br>
      <select class="operator" name="operator" id="operator">
        <option value="add">+</option>
        <option value="subtract">-</option>
        <option value="multiple">*</option>
        <option value="divide">/</option>
      </select> <br>
      <input type="number" step="any" name="second-number" placeholder="Enter a number"> <br>
      <button class="calculate-btn" type="submit">Calculate</button>
    </form>

    <?php
    // Initialize variables to avoid warnings
    $firstNumber = $secondNumber = $operator = "";
    $value = null;
    $errors = false;
    
    // Grab data from user's input
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $firstNumber = filter_input(INPUT_POST, "first-number", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $secondNumber = filter_input(INPUT_POST, "second-number", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $operator = htmlspecialchars($_POST["operator"]);

      // Corrected empty check (allows '0')
      if ($firstNumber === "" || $secondNumber === "" || empty($operator)) {
        echo "<p class='calc-error'>Please fill numbers and operator in all the fields</p>";
        $errors = true;
      } else if (!is_numeric($firstNumber) || !is_numeric($secondNumber)) 
      {
        echo "<p class='calc-error'>Only write number!</p>";
        $errors = true;
      }

      // Calculate if no errors
      if (!$errors) {
        switch($operator) {
          case "add":
            $value = $firstNumber + $secondNumber;
            break;
          case "subtract":
            $value = $firstNumber - $secondNumber;
            break;
          case "multiple":
            $value = $firstNumber * $secondNumber;
            break;
          case "divide":
            if ($secondNumber == 0) {
                echo "<p class='calc-error'>Error: Division by zero is not allowed.</p>";
            } else {
                $value = $firstNumber / $secondNumber;
            }
            break;
          default:
          echo "<p>Something went wrong!</p>";
        }
      }

      if ($value !== null) {
        echo "<p class='result-box'>Result: $value</p>";
      }
    }
    ?>
  </article>
</body>

</html>