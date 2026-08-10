<?php
session_start();
include "db.php";

if(!isset($_SESSION['fullname']))
{
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id']))
{
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM tasks WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['updateTask']))
{
    $subject = $_POST['subject'];
    $task = $_POST['task'];
    $study_date = $_POST['due_date'];
    $priority = $_POST['priority'];

    mysqli_query($conn,
    "UPDATE tasks
    SET subject='$subject',
        task='$task',
        study_date='$study_date',
        priority='$priority'
    WHERE id='$id'");

    header("Location: home.php?updated=1");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Task - StudyMate</title>

    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

<div class="edit-page">

    <!-- ================= EDIT HEADER ================= -->

    <div class="edit-header">

        <div class="edit-brand">

            <div class="edit-logo">
                📚
            </div>

            <div>
                <h1>StudyMate</h1>
                <p>Smart Study Planner</p>
            </div>

        </div>

        <a href="home.php" class="back-btn">
            ← Dashboard
        </a>

    </div>


    <!-- ================= EDIT CARD ================= -->

    <div class="edit-card">

        <div class="edit-title">

            <div class="edit-title-icon">
                ✏️
            </div>

            <div>

                <h2>Edit Study Task</h2>

                <p>
                    Update your task details and keep your study plan organized.
                </p>

            </div>

        </div>


        <form method="POST" class="edit-form">


            <!-- Subject -->

            <div class="form-group">

                <label>
                    📚 Subject
                </label>

                <input
                    type="text"
                    name="subject"
                    value="<?php echo $row['subject']; ?>"
                    placeholder="Enter subject"
                    required>

            </div>


            <!-- Task -->

            <div class="form-group">

                <label>
                    📝 Task
                </label>

                <input
                    type="text"
                    name="task"
                    value="<?php echo $row['task']; ?>"
                    placeholder="Enter task"
                    required>

            </div>


            <!-- Date + Priority -->

            <div class="edit-grid">


                <div class="form-group">

                    <label>
                        📅 Study Date
                    </label>

                    <input
                        type="date"
                        name="due_date"
                        value="<?php echo $row['study_date']; ?>"
                        required>

                </div>


                <div class="form-group">

                    <label>
                        🎯 Priority
                    </label>

                    <select name="priority" required>

                        <option value="High"
                        <?php
                        if($row['priority']=="High")
                        {
                            echo "selected";
                        }
                        ?>>
                            🔴 High
                        </option>


                        <option value="Medium"
                        <?php
                        if($row['priority']=="Medium")
                        {
                            echo "selected";
                        }
                        ?>>
                            🟡 Medium
                        </option>


                        <option value="Low"
                        <?php
                        if($row['priority']=="Low")
                        {
                            echo "selected";
                        }
                        ?>>
                            🟢 Low
                        </option>

                    </select>

                </div>

            </div>


            <!-- Buttons -->

            <div class="edit-actions">

                <a href="home.php" class="cancel-btn">
                    Cancel
                </a>

                <button
                    type="submit"
                    name="updateTask"
                    class="update-btn">

                    ✓ Update Task

                </button>

            </div>


        </form>

    </div>


    <!-- ================= FOOTER MESSAGE ================= -->

    <div class="edit-footer">

        <span>📚</span>

        Keep your study plan updated and stay productive!

    </div>

</div>

</body>

</html>