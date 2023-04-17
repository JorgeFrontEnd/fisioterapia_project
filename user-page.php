<?php
session_start();
require 'con.php';

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
$posture_questions = mysqli_query($conn, "SELECT * FROM questions WHERE category='Postura'");
$walking_questions = mysqli_query($conn, "SELECT * FROM questions WHERE category='Caminhada'");
$pilates_questions = mysqli_query($conn, "SELECT * FROM questions WHERE category='Pilates'");
$stretching_questions = mysqli_query($conn, "SELECT * FROM questions WHERE category='Relaxamento'");

// Close the connection
mysqli_close($conn);

?>

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
                    <span>Geronto Move</span>
                </li>
                <li>
                    <form method="POST" action="logout.php">
                        <input class="logout" type="submit" name="logout" value="Logout">
                    </form>

                </li>
            </ul>
        </nav>
        <div class="accordion">
            <div class="accordion-header">Dance</div>
            <div class="accordion-panel">
                <div class="video">
                    <video width="280" height="300" controls>
                        <source src="dance.mp4" type="video/mp4">
                    </video>
                </div>
                <form action="user-page.php?category=Danca" method="POST">
                    <textarea name="question" id="question" placeholder="Pergunte algo" required></textarea>
                    <input class="submit-question-btn" type="submit" value="Submit">
                </form>
                <hr>
                <?php while ($question = mysqli_fetch_assoc($dance_questions)): ?>
  <div class="questions">
    <?php echo $question['question']; ?>
  </div>
  <div class="answers" style="display: none;">
    <?php
      require 'con.php';
      // Get the answers for this question
      $question_id = $question['id'];
      $answers_query = mysqli_query($conn, "SELECT answer FROM `questions` WHERE id=$question_id");
    
     while ($answer = mysqli_fetch_assoc($answers_query)):
        echo '<div>'.$answer['answer'].'</div>';
    endwhile;
    ?>
  </div>
  <button class="show-answer" onclick="toggleAnswers(this)">ver resposta</button>
<?php endwhile; ?>
            </div>
        </div>
        <div class="accordion">
            <div class="accordion-header">Alongamentos</div>
            <div class="accordion-panel">
                <div class="video">
                    <video width="280" height="300" controls>
                        <source src="alongamentos.mp4" type="video/mp4">
                    </video>
                </div>
                <form action="user-page.php?category=Alongamentos" method="POST">
                    <textarea name="question" id="question" placeholder="Pergunte algo" required></textarea>
                    <input class="submit-question-btn" type="submit" value="Submit">
                </form>
                <hr>
                <?php while ($question = mysqli_fetch_assoc($posture_questions)): ?>
                <div class="questions">
                    <?php echo $question['question']; ?>
                </div>
                <?php
        require 'con.php';
        // Get the answers for this question
        $question_id = $question['id'];
        $answers_query = mysqli_query($conn, "SELECT answer FROM `questions` WHERE id=$question_id");
    ?>
                <div class="answers" style="display: none;">
                    <?php while ($answer = mysqli_fetch_assoc($answers_query)): ?>
                    <div>
                        <?php echo $answer['answer']; ?>
                    </div>
                    <?php endwhile; ?>
                </div>
                <button class="show-answer" onclick="toggleAnswers(this)">ver resposta</button>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Caminhada</div>
            <div class="accordion-panel">
                <div class="video">
                    <video width="280" height="300" controls>
                        <source src="walking.mp4" type="video/mp4">
                    </video>
                </div>
                <form action="user-page.php?category=Caminhada" method="POST">
                    <textarea name="question" id="question" placeholder="Pergunte algo" required></textarea>
                    <input class="submit-question-btn" type="submit" value="Submit">
                </form>
                <hr>
                <?php while ($question = mysqli_fetch_assoc($walking_questions)): ?>
                <div class="questions">
                    <?php echo $question['question']; ?>
                </div>
                <?php
        require 'con.php';
        // Get the answers for this question
        $question_id = $question['id'];
        $answers_query = mysqli_query($conn, "SELECT answer FROM `questions` WHERE id=$question_id");
    ?>
                <div class="answers" style="display: none;">
                    <?php while ($answer = mysqli_fetch_assoc($answers_query)): ?>
                    <div>
                        <?php echo $answer['answer']; ?>
                    </div>
                    <?php endwhile; ?>
                </div>
                <button class="show-answer" onclick="toggleAnswers(this)">ver resposta</button>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">Pilates</div>
            <div class="accordion-panel">
                <div class="video">
                    <video width="280" height="300" controls>
                        <source src="pilates.mp4" type="video/mp4">
                    </video>
                </div>
                <form action="user-page.php?category=Pilates" method="POST">
                    <textarea name="question" id="question" placeholder="Pergunte algo" required></textarea>
                    <input class="submit-question-btn" type="submit" value="Submit">
                </form>
                <hr>
                <?php while ($question = mysqli_fetch_assoc($pilates_questions)): ?>
                <div class="questions">
                    <?php echo $question['question']; ?>
                    <div class="answers" style="display: none;">
                        <?php
        require 'con.php';
        // Get the answers for this question
        $question_id = $question['id'];
        $answers_query = mysqli_query($conn, "SELECT answer FROM `questions` WHERE id=$question_id");

        while ($answer = mysqli_fetch_assoc($answers_query)):
            echo "<div>".$answer['answer']."</div>";
        endwhile;
    ?> </div>
    <button class="show-answer" onclick="toggleAnswers(this)">ver resposta</button>
            <?php endwhile; ?>
                </div>
            </div>
        
        <div class="accordion">
            <div class="accordion-header">Relaxamento</div>
            <div class="accordion-panel">
                <div class="video">
                    <video width="280" height="300" controls>
                        <source src="relaxamento.mp4" type="video/mp4">
                    </video>
                </div>
                <form action="user-page.php?category=Relaxamento" method="POST">
                    <textarea name="question" id="question" placeholder="Pergunte algo" required></textarea>
                    <input class="submit-question-btn" type="submit" value="Submit">
                </form>
                <hr>
                <?php while ($question = mysqli_fetch_assoc($stretching_questions)): ?>
                <div class="questions">
                    <?php echo $question['question']; ?>
                    <div class="answers" style="display: none;">
                        <?php
        require 'con.php';
        // Get the answers for this question
        $question_id = $question['id'];
        $answers_query = mysqli_query($conn, "SELECT answer FROM `questions` WHERE id=$question_id");

        while ($answer = mysqli_fetch_assoc($answers_query)):
            echo "<div>".$answer['answer']."</div>";
        endwhile;
    ?> </div>
    <button class="show-answer" onclick="toggleAnswers(this)">ver resposta</button>
            <?php endwhile; ?>
                </div>
            </div>
        </div>
        
        
        <script>
            function toggleAnswers(button) {
              var answersDiv = button.previousElementSibling;
              if (answersDiv.style.display === "none") {
                answersDiv.style.display = "block";
                button.innerHTML = "voltar";
              } else {
                answersDiv.style.display = "none";
                button.innerHTML = "ver resposta";
              }
            }
        </script>

        <script src="app.js"></script>
</body>
</html>