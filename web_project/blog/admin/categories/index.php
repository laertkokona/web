<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/categories.php"); adminOnly(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />    <link rel="stylesheet" href="materials/css/style.css">
    <link rel="stylesheet" href="../../materials/css/style.css">
    <link rel="stylesheet" href="../../materials/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">
    <title>Admin Section - Manage Category</title>
</head>

<body>
    
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php") ?>

    <div class="admin-wrapper">

        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php") ?>

        <div class="admin-content">
            

            <div class="content">
                <h2 class="page-title">Manage Categories</h2>

                <?php include(ROOT_PATH . "/app/includes/messages.php")?>

                <table>
                    <thead>
                        <th></th>
                        <th>Name</th>
                        <th colspan="2"><center>Action</center></th>
                    </thead>
                    <tbody>

                        <?php foreach ($categories as $key => $category): ?>
                            <tr>
                                <td><?php echo $key +1; ?></td>
                                <td><?php echo $category['name']; ?></td>
                                <td><a href="edit.php?id=<?php echo $category['id']; ?>" class="edit">Edit</a></td>
                                <td><a href="index.php?del_id=<?php echo $category['id']; ?>" class="delete">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>

                        
                        
                    </tbody>
                </table>
            </div>
            <center><div class="button-group">
                <a href="create.php" class="btn btn-big">Add Category</a>
                <a href="index.php" class="btn btn-big">Manage Categories</a>
            </div></center>
        </div>

    </div>

    <div class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h1 class="logo-text"><span>Laert</span>Blog</h1>
                <p>
                    Hello!
                    My name is Laert. This is my project for the Web System Development course.
                    Thank you!
                </p>
                <div class="contact">
                    <span><i class="fas fa-phone"></i> &nbsp; +355 69 531 7731</span>
                    <span><i class="fas fa-envelope"></i> &nbsp; laerti98@gmail.com</span>
                </div>
                <div class="socials">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-section links">
                <h2>Quick Links</h2>
                <br>
                <ul>
                    <a href="#">
                        <li>Events</li>
                    </a>
                    <a href="#">
                        <li>Team</li>
                    </a>
                    <a href="#">
                        <li>Mentores</li>
                    </a>
                    <a href="#">
                        <li>Gallery</li>
                    </a>
                    <a href="#">
                        <li>Terms and Conditions</li>
                    </a>
                </ul>
            </div>
            <div class="footer-section contact-form">
                <h2>Contact Me</h2>
                <br>
                <form action="index.php" method="post">
                    <input type="email" name="email" class="text-input contact-input" placeholder="Your email address">
                    <textarea rows="4" name="message" class="text-input contact-input"
                        placeholder="Your message..."></textarea>
                    <button type="submit" class="btn btn-big contact-btn">
                        <i class="fas fa-envelope"></i>
                        Send
                    </button>
                </form>
            </div>
        </div>


        <div class="footer-bottom">
            &copy; Designed by Laert Kokona

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/19.1.1/classic/ckeditor.js"></script>

    <script src="../../materials/js/script.js"></script>

</body>

</html>