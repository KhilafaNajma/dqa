<?php
// Dapatkan nama folder proyek dari path
$project_folder = basename(dirname($_SERVER['PHP_SELF']));
?>
<header>
    <div class="menu-icon" id="menu-icon">&#9776;</div>
    <nav id="navbar">
        <ul>
            <li><a href="/dqa/index.php">Home</a></li>
            <li><a href="/dqa/submit.php">Submit Quote</a></li>
        </ul>
    </nav>
</header> 