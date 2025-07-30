<?php
//author: TanHongIT

require('content/views/shared/header.php');

if (!empty($_POST)) {
    $comments = [
        'id' => 0,
        'product_id' => $_POST['product_id'],
        'author' => escape($_POST['author']),
        'email' => escape($_POST['email']),
        'phone' => escape($_POST['phone']),
        'content' => escape($_POST['content']),
        'status' => 1,
        'createDate' => gmdate('Y-m-d H:i:s', time() + 7*3600)
    ];
    save('comments', $comments);
    echo "<div class='alert alert-success'><strong>Done!</strong> You have successfully submitted your comment! <br>Please <a href='javascript: history.go(-1)'>return to the product</a> or <a href='index.php'>go to homepage</a></div>";
    echo "<script>alert('You have successfully posted your comment');</script>";
}

require('content/views/shared/footer.php');

// $input = json_decode(file_get_contents('php://input'), true);

// $productID = $input['productID'];
// $commentContent = $input['commentContent'];
// $userID = $input['userID'];
// $link_image = $input['link_image'];
// $author = $input['author'];
// $userID = $input['email'];

// $commentData = array(
//     'id' => 0,
//     'product_id' => intval($productID),
//     'email' => escape($email),
//     'author' => escape($author),
//     'content' => escape($commentContent),
//     'createDate' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
//     'user_id' => intval($userID),
//     'link_image' => escape($link_image)
// );
// save('comments', $commentData);

// $option = array('product_id' => intval($productID));

// $commentList = getAll('comments',$option);

// echo json_encode($commentList);
// echo 'aaaa';
