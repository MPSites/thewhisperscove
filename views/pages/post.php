<?php

    if(isset($_GET['post_id']) && !empty($_GET['post_id'])){

        $post_id = $_GET['post_id'];

        $sql = "SELECT p.*, c.category_name, concat(u.first_name, ' ', u.last_name) AS full_name, u.avatar_img FROM posts p INNER JOIN users u ON p.user_id = u.user_id INNER JOIN category_post cp on p.post_id = cp.post_id INNER JOIN categories c ON cp.category_id = c.category_id WHERE p.post_id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":id", $post_id);

        $stmt->execute();

        $post = $stmt->fetchAll();

        ?>
            <div class="main-content">
                <div id="main-post-area">
                    <?php foreach($post as $row) : ?>
                        <?php $newDate = date("d-m-Y", strtotime($row->post_date)); ?>
                            <div class="post-row">
                                <div class="blog-post">
                                    
                                    <div class="blog-post-inner">
                                        <a href="#" class="post-about">	
                                            <div class="post-member">
                                                <img src="assets/img/user_images/<?= $row->avatar_img ?>" alt="avatar-image">
                                                <span class="post-user"><?= $row->full_name ?></span>
                                            </div>
                                        </a>
                                        <div class="post-content">
                                            <h2 class="blog-post-title"><?= $row->title ?></h2>
                                            <p><?= $row->content ?></p>
                                        </div>
                                    </div>
                                    <div class="post-date">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <?= $newDate; ?>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>


        <?php

    }else{
        echo "<div class='main-content'> <p>Can't find your post, it's maybe somewhere else? <a href='index.php?page=forum'>Go back</a></p></div> </div>";
    }

    //var_dump($post);


    