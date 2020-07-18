<?php
include("path.php")?>
<?php
include(ROOT_PATH . '/app/controllers/posts.php');

if (isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);
}

$categories = selectAll('categories');

$posts = selectAll('posts', ['published' => 1]);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie-edge"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />    <link rel="stylesheet" href="materials/css/style.css">
    <link rel="stylesheet" href="materials/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">
    <title><?php echo $post['title']; ?> | LaertBlog</title>
</head>

<body>
    <?php include(ROOT_PATH . "/app/includes/header.php")?>

    <div class="page-wrapper">

        
        <div class="content clearfix">
            
            <div class="main-content-wrapper">
                <div class="main-content single">
                <h1 class="post-title"><?php echo $post['title']; ?></h1>

                <div class="post-content">
                    <?php echo html_entity_decode($post['body']); ?>
                </div>

                </div>
            </div>
            <!-- <div class="main-content comments">
                <h2 class="section-title">Comments</h2>
                <ul>
                    <li><a>Comment 1</a></li>
                    <li><a>Comment 2</a></li>
                    <li><a>Comment 3</a></li>
                    <li><a>Comment 4</a></li>
                    <li><a>Comment 5</a></li>
                    <li><a>Comment 6</a></li>
                    <li><a>Comment 7</a></li>
                </ul>

                <textarea rows="4" name="comment" class="text-input contact-input" placeholder="Your message..."></textarea>
                
                <button type="submit" name="add-comment" class="btn btn-big">
                    <i class="fas fa-envelope"></i>
                    Comment
                </button>
            
            </div> -->
            <div class="sidebar single">

                <div class="section popular">
                    <h2 class="section-title">Popular</h2>

                    <?php foreach($pposts as $po): ?>

                        <div class="post clearfix">
                            <img src="<?php echo BASE_URL . '/materials/images/' . $po['image']; ?>" alt="">
                            <a href="single.php?id=<?php echo $po['id']; ?>" class="title">
                                <h4><?php echo $po['title']; ?></h4>
                            </a>
                        </div>

                    <?php endforeach; ?>
                    
                </div>

                <div class="section categories">
                    <h2 class="section-title">Categories</h2>
                    <ul>

                        <?php foreach($categories as $category): ?>

                            <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $category['id'] . '&name=' .$category['name']; ?>"><?php echo $category['name']; ?></a></li>

                        <?php endforeach; ?>    
                        
                    </ul>
                </div>
            
            </div>

            

        </div>
        
    </div>

    <?php include(ROOT_PATH . "/app/includes/footer.php")?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="materials/js/script.js"></script>

</body>

</html>