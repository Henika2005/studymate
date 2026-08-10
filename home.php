<?php
session_start();
include "db.php";
// Dashboard Statistics

$totalTasks = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tasks"));

$completedTasks = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks WHERE status='Completed'"));

$pendingTasks = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks WHERE status!='Completed'"));

$overdueTasks = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks
WHERE study_date < CURDATE()
AND status != 'Completed'"));

// Progress Percentage

if($totalTasks > 0)
{
    $progress = round(($completedTasks / $totalTasks) * 100);
}
else
{
    $progress = 0;
}

if(!isset($_SESSION['fullname']))
{
    header("Location: login.php");
    exit();
}

if(isset($_POST['addTask']))
{
    $subject = $_POST['subject'];
    $task = $_POST['task'];
    $study_date = $_POST['due_date'];
    $priority = $_POST['priority'];

    $sql = "INSERT INTO tasks(subject, task, study_date, priority)
            VALUES('$subject', '$task', '$study_date', '$priority')";

    mysqli_query($conn, $sql);

    header("Location: home.php?added=1");
    exit();
}

if(isset($_GET['complete']))
{
    $id = $_GET['complete'];

    mysqli_query($conn,
        "UPDATE tasks SET status='Completed' WHERE id='$id'"
    );

    header("Location: home.php?completed=1");
    exit();
}
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM tasks WHERE id='$id'");

    header("Location: home.php?deleted=1");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyMate - Dashboard</title>

    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>


<div class="container">

    <div class="header">

    <div class="logo-section">

        
           <div class="logo-icon">📚</div>
        

        <div>

            <h1>StudyMate</h1>

            <p>Your Smart Study Planner</p>

        </div>

    </div>

    <div class="header-right">

        <div class="user-info">

            <span>👋 Welcome,</span>

            <strong><?php echo $_SESSION['fullname']; ?></strong>

        </div>

        <a href="logout.php" class="logout-btn">
            Logout
        </a>

    </div>

</div>
    <div class="hero">

    <div class="hero-left">

        <span class="welcome-badge">
            👋 Welcome Back
        </span>

        <h2>
            Hello,
            <?php echo $_SESSION['fullname']; ?>
        </h2>

        <p>
            Stay organized, complete your study goals, and improve your productivity with StudyMate.
        </p>

        <div class="live-info">

    <div class="info-box">
        📅 <span id="currentDate"></span>
    </div>

    <div class="info-box">
        🕒 <span id="currentTime"></span>
    </div>

</div>

        <div class="hero-buttons">

            <a href="#add-task" class="hero-btn">
    📚 Start Studying
</a>

            <a href="#progress" class="hero-outline-btn">
    📈 View Progress
</a>
        </div>

    </div>

    <div class="hero-right">

       <div class="hero-image">
        <img src="img/studymate-logo.jpg" alt="StudyMate Logo">
    </div>

    </div>

</div>
   
<div class="stats fade-up">

    <div class="card total-card">

        <div class="card-top">
            <span class="card-icon">📚</span>
            <span class="card-title">Total Tasks</span>
        </div>

        <h2><?php echo $totalTasks; ?></h2>

    </div>

    <div class="card completed-card">

        <div class="card-top">
            <span class="card-icon">✅</span>
            <span class="card-title">Completed</span>
        </div>

        <h2><?php echo $completedTasks; ?></h2>

    </div>

    <div class="card pending-card">

        <div class="card-top">
            <span class="card-icon">⏳</span>
            <span class="card-title">Pending</span>
        </div>

        <h2><?php echo $pendingTasks; ?></h2>

    </div>

    <div class="card overdue-card">

    <div class="card-top">
        <span class="card-icon">🔴</span>
        <span class="card-title">Overdue</span>
    </div>

    <h2><?php echo $overdueTasks; ?></h2>

</div>

</div>

<div class="progress-card fade-up" id="progress">

    <div class="progress-header">

        <h2>📈 Study Progress</h2>

        <span><?php echo $progress; ?>%</span>

    </div>

    <div class="progress-bar">

        <div class="progress-fill"
             style="width: <?php echo $progress; ?>%;">

        </div>

    </div>

    <p>
    <?php echo $completedTasks; ?> of
    <?php echo $totalTasks; ?> tasks completed.

    <?php
    if($totalTasks == 0)
    {
        echo " — Start by adding your first task! 🚀";
    }
    elseif($progress == 100)
    {
        echo " — Amazing! All tasks completed! 🎉";
    }
    elseif($progress >= 75)
    {
        echo " — Great progress! Keep going! 💪";
    }
    elseif($progress >= 50)
    {
        echo " — You're halfway there! 🔥";
    }
    else
    {
        echo " — Keep studying and stay consistent! 📚";
    }
    ?>
</p>

</div>

<!-- ================= QUICK ACTIONS ================= -->

<div class="quick-actions fade-up">

    <div class="quick-actions-header">
        <h2>⚡ Quick Actions</h2>
        <p>Manage your study tasks quickly</p>
    </div>

    <div class="quick-actions-grid">

        <a href="#add-task" class="quick-action">
            <div class="quick-icon">➕</div>
            <div>
                <h3>Add New Task</h3>
                <p>Create a new study task</p>
            </div>
        </a>

        <a href="#tasks" class="quick-action">
            <div class="quick-icon">📋</div>
            <div>
                <h3>View Tasks</h3>
                <p>Check your study tasks</p>
            </div>
        </a>

        <a href="#progress" class="quick-action">
            <div class="quick-icon">📈</div>
            <div>
                <h3>View Progress</h3>
                <p>Check your study progress</p>
            </div>
        </a>

        <a href="#search" class="quick-action">
            <div class="quick-icon">🔍</div>
            <div>
                <h3>Search Tasks</h3>
                <p>Find a specific task</p>
            </div>
        </a>

    </div>

</div>

<hr>

<div class="today-study fade-up">

    <h2>📅 Today's Study Plan</h2>

    <div class="study-list">

        <?php

        $today = date("Y-m-d");

        $todayResult = mysqli_query(
            $conn,
            "SELECT * FROM tasks
             WHERE study_date='$today'
             ORDER BY priority='High' DESC"
        );

        if(mysqli_num_rows($todayResult) > 0)
        {
            while($todayTask = mysqli_fetch_assoc($todayResult))
            {
        ?>

            <div class="study-card">

                <div class="study-icon">
                    📚
                </div>

                <h3>
                    <?php echo $todayTask['subject']; ?>
                </h3>

                <p>
                    <?php echo $todayTask['task']; ?>
                </p>

                <?php

                if($todayTask['priority']=="High")
                {
                    echo "<span class='priority high'>🔴 High</span>";
                }
                elseif($todayTask['priority']=="Medium")
                {
                    echo "<span class='priority medium'>🟡 Medium</span>";
                }
                else
                {
                    echo "<span class='priority low'>🟢 Low</span>";
                }

                ?>

            </div>

        <?php
            }
        }
        else
        {
        ?>

            <div class="no-study">

                <div>🎉</div>

                <h3>No tasks for today!</h3>

                <p>
                    You're all caught up. Great job!
                </p>

            </div>

        <?php
        }

        ?>

    </div>

</div>
<hr>

<div class="task-form fade-up" id="add-task">

    <h2>Add New Study Task</h2>

    <form method="POST">

    <div class="form-grid">

        <div class="form-group">
            <label>Subject</label>

            <input
                type="text"
                name="subject"
                placeholder="Enter Subject"
                required>
        </div>


        <div class="form-group">
            <label>Task</label>

            <input
                type="text"
                name="task"
                placeholder="Enter Task"
                required>
        </div>


        <div class="form-group">
            <label>Due Date</label>

            <input
                type="date"
                name="due_date"
                required>
        </div>


        <div class="form-group">
            <label>Priority</label>

            <select name="priority" required>

                <option value="High">
                    🔴 High
                </option>

                <option value="Medium" selected>
                    🟡 Medium
                </option>

                <option value="Low">
                    🟢 Low
                </option>

            </select>
        </div>

    </div>


    <button
        type="submit"
        name="addTask"
        class="add-btn">

        + Add Task

    </button>

</form>
</div>
<div class="task-table fade-up" id="tasks">

<div class="table-header">

    <h2>📋 My Study Tasks</h2>

    <form method="GET" class="search-form" id="search">

        <input
            type="text"
            name="search"
            placeholder="Search by subject or task..."
            value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

        <button type="submit" class="search-btn">
    🔍 Search
</button>

    </form>

</div>
<div class="filter-buttons">

    <a href="home.php"
       class="filter-btn <?php
       if(!isset($_GET['status']))
       {
           echo 'active-filter';
       }
       ?>">
        📋 All
    </a>

    <a href="home.php?status=Pending"
       class="filter-btn <?php
       if(isset($_GET['status']) && $_GET['status']=="Pending")
       {
           echo 'active-filter';
       }
       ?>">
        ⏳ Pending
    </a>

    <a href="home.php?status=Completed"
       class="filter-btn <?php
       if(isset($_GET['status']) && $_GET['status']=="Completed")
       {
           echo 'active-filter';
       }
       ?>">
        ✅ Completed
    </a>

</div>
<table>

<tr>
    <th>Subject</th>
    <th>Task</th>
    <th>Study Date</th>
    <th>Due Status</th>
    <th>Priority</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php

if(isset($_GET['search']) && $_GET['search'] != "")
{
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $result = mysqli_query(
        $conn,
        "SELECT * FROM tasks
        WHERE subject LIKE '%$search%'
        OR task LIKE '%$search%'"
    );
}
elseif(isset($_GET['status']))
{
    $status = mysqli_real_escape_string($conn, $_GET['status']);

    $result = mysqli_query(
        $conn,
        "SELECT * FROM tasks
        WHERE status='$status'"
    );
}
else
{
    $result = mysqli_query($conn, "SELECT * FROM tasks");
}

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

    <!-- SUBJECT -->
    <td>
        <?php echo $row['subject']; ?>
    </td>


    <!-- TASK -->
    <td>
        <?php echo $row['task']; ?>
    </td>


    <!-- STUDY DATE -->
    <td>
        <?php echo $row['study_date']; ?>
    </td>


    <!-- DUE STATUS -->
    <td>

        <?php

        $today = date("Y-m-d");

        if($row['study_date'] < $today)
        {
            echo "<span class='due overdue'>🔴 Overdue</span>";
        }
        elseif($row['study_date'] == $today)
        {
            echo "<span class='due today'>🟢 Today</span>";
        }
        else
        {
            echo "<span class='due upcoming'>🔵 Upcoming</span>";
        }

        ?>

    </td>


    <!-- PRIORITY -->
    <td>

        <?php

        if($row['priority'] == "High")
        {
            echo "<span class='priority high'>🔴 High</span>";
        }
        elseif($row['priority'] == "Medium")
        {
            echo "<span class='priority medium'>🟡 Medium</span>";
        }
        else
        {
            echo "<span class='priority low'>🟢 Low</span>";
        }

        ?>

    </td>


    <!-- STATUS -->
    <td>

        <?php

        if($row['status'] == "Completed")
        {
            echo "<span class='status completed'>Completed</span>";
        }
        else
        {
            echo "<span class='status pending'>Pending</span>";
        }

        ?>

    </td>


    <!-- ACTION -->
    <td>

        <a href="home.php?complete=<?php echo $row['id']; ?>"
           class="complete-btn">
            Complete
        </a>

        <a href="edit.php?id=<?php echo $row['id']; ?>"
           class="edit-btn">
            Edit
        </a>

        <a href="home.php?delete=<?php echo $row['id']; ?>"
           class="delete-btn"
           onclick="return confirm('Are you sure you want to delete this task?')">
            Delete
        </a>

    </td>

</tr>

<?php
}
?>
</table>
</div>
<br>


</div>


<!-- ================= BACK TO TOP ================= -->

<button id="topBtn" title="Go to top">
    ↑
</button>

<div id="toast"></div>

<script src="script.js"></script>

<?php

if(isset($_GET['added']))
{
?>
<script>
    showToast("✅ Task added successfully!");
</script>
<?php
}

if(isset($_GET['updated']))
{
?>
<script>
    showToast("✏️ Task updated successfully!");
</script>
<?php
}
if(isset($_GET['completed']))
{
?>
<script>
    showToast("✅ Task completed successfully!");
</script>
<?php
}

if(isset($_GET['deleted']))
{
?>
<script>
    showToast("🗑️ Task deleted successfully!");
</script>
<?php
}


?>

</body>
</html>