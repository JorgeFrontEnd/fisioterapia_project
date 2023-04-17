<?php
session_start();
require 'con.php';

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

  // Insert the question and user ID into the questions table
  $insert_question = mysqli_prepare($conn, "INSERT INTO questions (question, user_id, category) VALUES (?, ?, ?)");
  mysqli_stmt_bind_param($insert_question, "sis", $question, $user_id, $category);
  mysqli_stmt_execute($insert_question);
  mysqli_stmt_close($insert_question);
}

if (isset($_POST['answer'])) {
  // Get the answer, user ID, and question ID from the form data
  $answer = $_POST['answer'];
  $user_id = $_SESSION['user_id'];
  $question_id = $_POST['question_id'];

  // Insert the answer, user ID, and question ID into the questions table
  $insert_answer = mysqli_prepare($conn, "UPDATE questions SET answer=? WHERE id=?");
  mysqli_stmt_bind_param($insert_answer, "si", $answer, $question_id);
  mysqli_stmt_execute($insert_answer);
  mysqli_stmt_close($insert_answer);
}

$dance_questions = mysqli_query($conn, "SELECT * FROM questions WHERE category='Danca'");
$posture_questions = mysqli_query($conn, "SELECT * FROM questions WHERE category='Alongamentos'");
$walking_questions = mysqli_query($conn, "SELECT * FROM questions WHERE category='Caminhada'");
$pilates_questions = mysqli_query($conn, "SELECT * FROM questions WHERE category='Pilates'");
$stretching_questions = mysqli_query($conn, "SELECT * FROM questions WHERE category='Relaxamento'");

// Close the connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="pt">

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
            <div class="accordion-header">Dança</div>
            <div class="accordion-panel">
                <div class="video">
                    <video width="280" height="300" controls>
                        <source src="dance.mp4" type="video/mp4">
                    </video>
                </div>
                <hr>
                <?php while ($question = mysqli_fetch_assoc($dance_questions)): ?>
                <div class="questions">
                    <?php echo $question['question']; ?>
                </div>
                <form class="answer-form" method="POST" action="">
                    <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>" />
                    <textarea name="answer" placeholder="Enter your answer here" required></textarea>
                    <input class="submit-question-btn" type="submit" value="Submit" />
                </form>
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
                <hr>
                <?php while ($question = mysqli_fetch_assoc($posture_questions)): ?>
                <div class="questions">
                    <?php echo $question['question']; ?>
                </div>
                <form class="answer-form" method="POST" action="">
                    <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>" />
                    <textarea name="answer" placeholder="Enter your answer here" required></textarea>
                    <input class="submit-question-btn" type="submit" value="Submit" />
                </form>
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
                <hr>
                <?php while ($question = mysqli_fetch_assoc($walking_questions)): ?>
                <div class="questions">
                    <?php echo $question['question']; ?>
                </div>
                <form class="answer-form" method="POST" action="">
                    <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>" />
                    <textarea name="answer" placeholder="Enter your answer here" required></textarea>
                    <input class="submit-question-btn" type="submit" value="Submit" />
                </form>
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
                <hr>
                <?php while ($question = mysqli_fetch_assoc($pilates_questions)): ?>
                <div class="questions">
                    <?php echo $question['question']; ?>
                </div>
                <form class="answer-form" method="POST" action="">
                    <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>" />
                    <textarea name="answer" placeholder="Enter your answer here" required></textarea>
                    <input class="submit-question-btn" type="submit" value="Submit" />
                </form>
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
                <hr>
                <?php while ($question = mysqli_fetch_assoc($stretching_questions)): ?>
                <div class="questions">
                    <?php echo $question['question']; ?>
                </div>
                <form class="answer-form" method="POST" action="">
                    <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>" />
                    <textarea name="answer" placeholder="Enter your answer here" required></textarea>
                    <input class="submit-question-btn" type="submit" value="Submit" />
                </form>
                <?php endwhile; ?>
            </div>
        </div>
        
    </div>
    
    
    </div>

    <script src="app.js"></script>
</body>

</html>