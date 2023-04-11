<!-- <?php

require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit();
}

// Check if a question has been submitted
if (isset($_POST['question'])) {
  // Get the question and user ID from the form data
  $question = $_POST['question'];
  $user_id = $_SESSION['user_id'];

  // Get the category from the query string if it's set
  if (isset($_GET['category'])) {
    $category = $_GET['category'];
  } else {
    $category = null;
  }

  // Check if the question is not empty
  if (!empty($question)) {
    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, "INSERT INTO questions (user_id, question, category) VALUES (?, ?, ?)");

    // Bind the parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "iss", $user_id, $question, $category);
    mysqli_stmt_execute($stmt);

    // Check if the insert was successful
    if (mysqli_affected_rows($conn) > 0) {
      echo "<script>alert('Pergunta submetida com sucesso.');</script>";
    } else {
      echo "Error inserting question: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
  }
}

// Fetch all questions from the "Dance" category
$dance_questions = mysqli_query($conn, "SELECT * FROM questions WHERE category='Danca'");

// Close the connection
mysqli_close($conn);

?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Document</title>
</head>

<body>
    <div class="app">
        <nav>
            <ul>
                <li>
                     Geronto Move
                </li>
                <li>
                     <form method="POST" action="logout.php">
                        <input type="submit" name="logout" value="Logout">
                    </form>

                </li>
            </ul>
        </nav>
        <div class="accordion">
            <div class="accordion-header">Dance</div>
            <div class="accordion-panel">
                <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                <form action="user-page.php?category=Danca" method="POST">
                    <textarea name="question" id="question" placeholder="Pergunte algo" required></textarea>
                    <input type="submit" value="Submit">
                </form>
                <hr>
                <h3>Questions:</h3>
                <!-- <?php while ($question = mysqli_fetch_assoc($dance_questions)): ?>
                <p>
                    <?php echo $question['question']; ?>
                </p>
                <?php endwhile; ?> -->
            </div>
        </div>
        <div class="accordion">
            <div class="accordion-header">Posture</div>
            <div class="accordion-panel">
                <iframe width="300" height="200" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                <form action="user-page.php?category=Postura" method="POST">
                    <textarea name="question" id="question" placeholder="Pergunte algo" required></textarea>
                    <input type="submit" value="Submit">
                </form>
                <hr>
                <h3>Questions:</h3>
                <!-- <?php while ($question = mysqli_fetch_assoc($dance_questions)): ?>
                <p>
                    <?php echo $question['question']; ?>
                </p>
                <?php endwhile; ?> -->
            </div>
        </div>
    </div>
    
    <script src="app.js"></script>
</body>

</html>