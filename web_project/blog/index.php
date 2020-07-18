<?php 

include("path.php");
include(ROOT_PATH . "/app/controllers/categories.php");



$posts = array();
$postsTitle = 'Recent Posts';

if (isset($_GET['t_id'])) {
    $posts = getCategoryPosts($_GET['t_id']);
    $postsTitle = 'Searched Category: \'' . $_GET['name'] . '\'';
} else if (isset($_POST['search-matches'])) {
    $postsTitle = 'Searched for: \'' . $_POST['search-matches'] . '\'';
    $posts = searchPosts($_POST['search-matches']);
} else {
    $posts = getPublishedPosts();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />    <link rel="stylesheet" href="materials/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">
    
    <title>Laert Blog</title>
</head>

<body>
    
<?php include(ROOT_PATH . "/app/includes/header.php")?>
<?php include(ROOT_PATH . "/app/includes/messages.php")?>


    <div class="page-wrapper">
        <div class="post-slider">
            <h1 class="slider-title">Popular Posts</h1>
            <i class="fas fa-chevron-left prev"></i>
            <i class="fas fa-chevron-right next"></i>
            
            <div class="post-wrapper">

                <?php foreach (array_slice($posts, 0, 5, true) as $post): ?>
            
                <div class="post">
                    <img src="<?php echo BASE_URL . "/materials/images/" . $post['image']; ?>" alt="" class="slider-image">
                    <div class="post-info">
                        <h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h4>
                        <i class="far fa-user"> <?php echo $post['username'];?></i>
                        &nbsp;
                        <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($post['created_ad'])); ?></i>
                    </div>
                </div>

                <?php endforeach; ?>

            </div>
        </div>
        <div class="content clearfix">

            <div class="main-content">
                <h1 class="recent-post-title"><?php echo $postsTitle; ?></h1>
                <?php foreach ($posts as $post): ?>
                
                <div class="post clearfix">
                    <img src="<?php echo BASE_URL . "/materials/images/" . $post['image']; ?>" alt="" class="post-image">
                    <div class="post-preview">
                        <h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
                        <i class="far fa-user"> <?php echo $post['username'];?></i>
                        &nbsp;
                        <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($post['created_ad'])); ?></i>
                        <p class="preview-text">
                            <?php echo html_entity_decode(substr($post['body'], 0, 150) . "..."); ?>
                        </p>
                        <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Read More</a>
                    </div>
                </div>
                <?php endforeach; ?>

                <center>
                    <a href=<?php echo BASE_URL . "/index.php?page=1" ; ?> class="fa fa-angle-double-left" ></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    
                    <a href=<?php echo BASE_URL . "/index.php?page=2"?> class="fa fa-angle-double-right"></a>
                </center>

                <br>
                <center><p>Or <a href=<?php echo BASE_URL . "/index.php"?>>View All</a></p></button></center>

            </div>

            <div class="sidebar">

                <div class="section search">
                    <h2 class="section-title">Search</h2>
                    <form action="index.php" method="post">
                        <input type="text" name="search-matches" class="text-input" placeholder="Search...">
                    </form>
                </div>

                <div class="section categories">
                    <h2 class="section-title">Categories</h2>
                    <ul>
                    <?php foreach ($categories as $key => $category): ?>
                        <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $category['id'] . '&name=' .$category['name']; ?>"><?php echo $category['name']; ?></a></li>
                    <?php endforeach; ?>

                    </ul>
                </div>
            
            </div>
        </div>
    </div>

    <?php include(ROOT_PATH . "/app/includes/footer.php")?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="materials/js/script.js"></script>

</body>

</html>