<?php
// Include header
include 'components/header.php';

// Include navbar
include 'components/navbar.php';
?>

<!-- Main Content -->
<main class="container mx-auto px-4 pt-20">
    <?php
    include 'components/sections/landing.php';
    
    include 'components/sections/login.php';
    include 'components/sections/about.php';
    include 'components/sections/breathing.php';
    include 'components/sections/meditation.php';
    include 'components/sections/music.php';
    include 'components/sections/drawing.php';
    include 'components/sections/photos.php';
    include 'components/sections/feedback.php';
    include 'components/sections/contact.php';
    ?>
</main>

<?php
// Include footer
include 'components/footer.php';
?> 