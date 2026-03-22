<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamified Country Quiz</title>
</head>
<style>
    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    main {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-container {
        display: flex;
        gap: 20px;
    }

    .card {
        padding: 20px;
        border: 2px solid black;
    }

    .image-container {
        border: 2px solid black;
    }

    .image-container img {
        display: block;
        max-width: 300px;
        height: 200px;
    }

    .options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: 20px;
    }

    .next-btn {
        display: none;
    }

    .show {
        display: block;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;

    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;

    }
</style>

<body>
    <main>
        <div class="container">
            <div class="card-container">
                <?php
                $conn = new mysqli("localhost", "root", "", "countries_db");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM game ORDER BY RAND()";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $country = $result->fetch_assoc();

                    $answers = array(
                        $country['ans1'],
                        $country['ans2'],
                        $country['ans3'],
                        $country['ans4']
                    );

                    shuffle($answers);

                    echo "<script>
                            const correctAnswer = '" . addslashes($country['correct']) . "';
                            const shuffledAnswers = " . json_encode($answers) . ";
                            </script>";

                ?>

                    <div class="card">
                        <h3>Guess the Country</h3>
                        <div class="image-container">
                            <img src="<?php echo $country['question']; ?>" alt="Country Flag">
                        </div>
                        <div class="options" id="optionsContainer">
                            <?php
                            foreach ($answers as $answer) {
                                echo '<button data-answer="' . $answer . '">' . $answer . '</button>';
                            }
                            ?>
                        </div>
                        <div class="feedback" id="feedback"></div>
                        <button class="next-btn" id="nextBtn">Next Question</button>
                    </div>

                <?php
                } else {
                    echo "No countries found.";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </main>
    <script>
        let answered = false;

        document.querySelectorAll('.options button').forEach(button => {
            button.addEventListener('click', function() {
                if (answered) return;

                answered = true;
                const selectedAnswer = this.getAttribute('data-answer');
                const feedbackElement = document.getElementById('feedback');
                const nextBtn = document.getElementById('nextBtn');

                if (selectedAnswer === correctAnswer) {
                    this.classList.add('correct');
                    feedbackElement.textContent = 'Correct! Well done!';
                    feedbackElement.classList.add('show', 'success');
                } else {
                    this.classList.add('incorrect');
                    feedbackElement.textContent = 'Incorrect! The correct answer is: ' + correctAnswer;
                    feedbackElement.classList.add('show', 'error');

                    document.querySelectorAll('.options button').forEach(btn => {
                        if (btn.getAttribute('data-answer') === correctAnswer) {
                            btn.classList.add('correct');
                        }
                    });
                }

                document.querySelectorAll('.options button').forEach(btn => {
                    btn.disabled = true;
                });

                nextBtn.classList.add('show');
            });
        });

        document.getElementById('nextBtn').addEventListener('click', function() {
            location.reload();
        });
    </script>
</body>

</html>