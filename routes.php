<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type:application/json",true);
// header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

$app->group('/api', function () use ($app) {
    

   // Retrieve game all record use fetchAll()     
   $app->get('/category', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM category ORDER BY category_id");
    $sth->execute();
    $data = $sth->fetchAll();
    $categorys = array("categorys"=>$data);
    return $this->response->withJson($categorys);
});  
$app->get('/category/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM category_id WHERE category_id=:id");
    $sth->execute();
    $data = $sth->fetchAll();
    $categorys = array("categorys"=>$data);
    return $this->response->withJson($categorys);
});  






$app->get('/rentalroom', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM `rentalroom` INNER JOIN picture ON rentalroom.rentalroom_id = picture.rentalroom_id INNER JOIN category ON rentalroom.rentalroom_id = category.category_id;");
    $sth->execute();
    $data = $sth->fetchAll();
    $rentalroom = array("rentalroom"=>$data);
    return $this->response->withJson($rentalroom);
}); 

$app->get('/rentalroom/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM rentalroom WHERE rentalroom_id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $data = $sth->fetchObject();
    $rentalroom = array("rentalroom"=>array($data));
    return $this->response->withJson($rentalroom);
});
  // Search for todo with given search term in their name
  $app->get('/rentalroom/search/[{query}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM rentalroom WHERE UPPER(rentalroom_name) LIKE :query ORDER BY rentalroom_id");
    $query = "%".$args['query']."%";
    $sth->bindParam("query", $query);
    $sth->execute();
    $data = $sth->fetchAll();
    $rentalroom = array("rentalroom"=>$data);
    return $this->response->withJson($rentalroom);
});

$app->post('/rentalroom', function ($request, $response) {
    $input = $request->getParsedBody();
    $newfileName = "";        
    if($input['picture'] != 'no_image'){
        try{
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $ext = pathinfo($target_file,PATHINFO_EXTENSION);
            $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
            $newfileNameAndPath = $target_dir . $newfileName;
            $uploadOk = 1;
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                    //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                    $uploadOk = 1;               
                } else {
                    //echo "Sorry, there was an error uploading your file.";
                    $newfileName = "";
                    
                }
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
                $newfileName = "";
            }
        }catch(Exception $ex){
            return $this->response->withJson($ex);
        }
    }        
    //--- insert data to db
    $sql = "INSERT INTO rentalroom (rentalroom_id,rentalroom_name,rentalroom_price,rentalroom_name_location,picture,rentalroom_latitude,rentalroom_longitude,rentalroom_phone,rentalroom_limitedroom_sex,rentalroom_approve,rentalroom_facilities) 
    VALUES (:rentalroom_id,:rentalroom_name,:rentalroom_price,:rentalroom_name_location,:picture,:rentalroom_latitude,:rentalroom_longitude,:rentalroom_phone,:rentalroom_limitedroom_sex,:rentalroom_approve,:rentalroom_facilities)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("rentalroom_id", $input['rentalroom_id']);
    $sth->bindParam("rentalroom_name", $input['rentalroom_name']);
    $sth->bindParam("rentalroom_price", $input['rentalroom_price']);
    $sth->bindParam("rentalroom_name_location", $input['rentalroom_name_location']);
    //$sth->bindParam("game_img", $input['game_img']);
    $sth->bindParam("picture", $newfileName);
    $sth->bindParam("rentalroom_latitude", $input['rentalroom_latitude']);  
    $sth->bindParam("rentalroom_longitude", $input['rentalroom_longitude']);  
    $sth->bindParam("rentalroom_phone", $input['rentalroom_phone']);  
    $sth->bindParam("rentalroom_limitedroom_sex", $input['rentalroom_limitedroom_sex']);  
    $sth->bindParam("rentalroom_approve", $input['rentalroom_approve']);  
    $sth->bindParam("rentalroom_facilities  ", $input['rentalroom_facilities  ']);
    
    try{
        $sth->execute();
        $count = $sth->rowCount();
        return $this->response->withJson($count);
    }catch(PDOException $e){
        //echo($e);
        return $this->response->withJson(0);
    }
});    

// DELETE a game with given id
$app->delete('/rentalroom/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM rentalroom WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $count = $sth->rowCount();
    return $this->response->withJson($count);
});

// Update game with given id // put method is does not work!!!! use post instead
// $app->post('/rentalroom/[{id}]', function ($request, $response, $args) {
//     $input = $request->getParsedBody();
//     $newfileName = "";        
//     if($input['picture'] != 'no_image'){
//         try{
//             $target_dir = "images/";
//             $target_file = $target_dir . basename($_FILES["photo"]["name"]);
//             $ext = pathinfo($target_file,PATHINFO_EXTENSION);
//             $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
//             $newfileNameAndPath = $target_dir . $newfileName;
//             $uploadOk = 1;
//             $check = getimagesize($_FILES["photo"]["tmp_name"]);
//             if($check !== false) {
//                 //echo "File is an image - " . $check["mime"] . ".";
//                 $uploadOk = 1;
//                 if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
//                     //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
//                     $uploadOk = 1;               
//                 } else {
//                     //echo "Sorry, there was an error uploading your file.";
//                     $newfileName = ""; 
//                 }
//             } else {
//                 //echo "File is not an image.";
//                 $uploadOk = 0;
//                 $newfileName = "";
//             }
//         }catch(Exception $ex){
//             return $this->response->withJson($ex);
//         }
// rentalroom_facilities
//     if($newfileName != ""){
//         $sql = "UPDATE rentalroom SET rentalroom_name=:rentalroom_name, rentalroom_price=:rentalroom_price, rentalroom_name_location=:rentalroom_name_location, picture=:picture, rentalroom_latitude=:rentalroom_latitude, rentalroom_phone=:rentalroom_phone , rentalroom_limitedroom_sex=:rentalroom_limitedroom_sex, rentalroom_approve=:rentalroom_approve, rentalroom_facilities=:rentalroom_facilities WHERE id=:id";
//     }else{
//         $sql = "UPDATE rentalroom SET rentalroom_name=:rentalroom_name, rentalroom_price=:rentalroom_price, rentalroom_name_location=:rentalroom_name_location, rentalroom_latitude=:rentalroom_latitude , rentalroom_phone=:rentalroom_phone , rentalroom_limitedroom_sex=:rentalroom_limitedroom_sex, rentalroom_approve=:rentalroom_approve, rentalroom_facilities=:rentalroom_facilities WHERE id=:id";
//     }
    
//     $sth = $this->db->prepare($sql);
//     $sth->bindParam("id", $args['id']);
//     $sth->bindParam("rentalroom_name", $input['rentalroom_name']);
//     $sth->bindParam("rentalroom_price", $input['rentalroom_price']);
//     $sth->bindParam("rentalroom_name_location", $input['rentalroom_name_location']);
//     $sth->bindParam("rentalroom_phone", $input['rentalroom_phone']); 
//     $sth->bindParam("rentalroom_limitedroom_sex", $input['rentalroom_limitedroom_sex']); 
//     $sth->bindParam("rentalroom_approve", $input['rentalroom_approve']); 
//     $sth->bindParam("rentalroom_facilities", $input['rentalroom_facilities']); 
//     if($newfileName != ""){
//         $sth->bindParam("picture", $newfileName);
//     }

//     try{
//         $sth->execute();
//         $count = $sth->rowCount();
//         return $this->response->withJson($count);
//     }catch(PDOException $e){
//         return $this->response->withJson(0);
//     }
// });
///




    // Retrieve game all record use fetchAll()     
    $app->get('/game', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM game ORDER BY game_id");
        $sth->execute();
        $data = $sth->fetchAll();
        $games = array("games"=>$data);
        return $this->response->withJson($games);
   });    

    // Retrieve todo with id (get 1 record) use fetchObject()
    $app->get('/game/[{id}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM game WHERE game_id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $data = $sth->fetchObject();
        $games = array("games"=>array($data));
        return $this->response->withJson($games);
    });

    // Search for todo with given search term in their name
    $app->get('/game/search/[{query}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM game WHERE UPPER(game_name) LIKE :query ORDER BY game_id");
        $query = "%".$args['query']."%";
        $sth->bindParam("query", $query);
        $sth->execute();
        $data = $sth->fetchAll();
        $games = array("games"=>$data);
        return $this->response->withJson($games);
    });
        
    $app->post('/game', function ($request, $response) {
        $input = $request->getParsedBody();
        $newfileName = "";        
        if($input['game_img'] != 'no_image'){
            try{
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $ext = pathinfo($target_file,PATHINFO_EXTENSION);
                $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
                $newfileNameAndPath = $target_dir . $newfileName;
                $uploadOk = 1;
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                        //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                        $uploadOk = 1;               
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                        $newfileName = "";
                        
                    }
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                    $newfileName = "";
                }
            }catch(Exception $ex){
                return $this->response->withJson($ex);
            }
        }        
        //--- insert data to db
        $sql = "INSERT INTO game (game_id,game_name,game_price,game_detail,game_img,game_stock) VALUES (:game_id,:game_name,:game_price,:game_detail,:game_img,:game_stock)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam("game_id", $input['game_id']);
        $sth->bindParam("game_name", $input['game_name']);
        $sth->bindParam("game_price", $input['game_price']);
        $sth->bindParam("game_detail", $input['game_detail']);
        //$sth->bindParam("game_img", $input['game_img']);
        $sth->bindParam("game_img", $newfileName);
        $sth->bindParam("game_stock", $input['game_stock']);  

        try{
            $sth->execute();
            $count = $sth->rowCount();
            return $this->response->withJson($count);
        }catch(PDOException $e){
            //echo($e);
            return $this->response->withJson(0);
        }
    });    

    // DELETE a game with given id
    $app->delete('/game/[{id}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("DELETE FROM game WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $count = $sth->rowCount();
        return $this->response->withJson($count);
    });

    // Update game with given id // put method is does not work!!!! use post instead
    $app->post('/game/[{id}]', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $newfileName = "";        
        if($input['game_img'] != 'no_image'){
            try{
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $ext = pathinfo($target_file,PATHINFO_EXTENSION);
                $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
                $newfileNameAndPath = $target_dir . $newfileName;
                $uploadOk = 1;
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                        //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                        $uploadOk = 1;               
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                        $newfileName = ""; 
                    }
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                    $newfileName = "";
                }
            }catch(Exception $ex){
                return $this->response->withJson($ex);
            }
        }

        if($newfileName != ""){
            $sql = "UPDATE game SET game_name=:game_name, game_price=:game_price, game_detail=:game_detail, game_img=:game_img, game_stock=:game_stock WHERE id=:id";
        }else{
            $sql = "UPDATE game SET game_name=:game_name, game_price=:game_price, game_detail=:game_detail, game_stock=:game_stock WHERE id=:id";
        }
        
        $sth = $this->db->prepare($sql);
        $sth->bindParam("id", $args['id']);
        $sth->bindParam("game_name", $input['game_name']);
        $sth->bindParam("game_price", $input['game_price']);
        $sth->bindParam("game_detail", $input['game_detail']);
        $sth->bindParam("game_stock", $input['game_stock']); 
        if($newfileName != ""){
            $sth->bindParam("game_img", $newfileName);
        }

        try{
            $sth->execute();
            $count = $sth->rowCount();
            return $this->response->withJson($count);
        }catch(PDOException $e){
            return $this->response->withJson(0);
        }
    });



    $app->post('/user', function ($request, $response) {
        $input = $request->getParsedBody();
        $sql = "SELECT * FROM login WHERE username=:username AND password=:password";
        $sth = $this->db->prepare($sql);
        $sth->bindParam("username", $input['username']);
        $sth->bindParam("password", $input['password']);
        $sth->execute();
        $count = $sth->rowCount();
        if($count==0){
            $message = (object)array('username' => 'failed', 'password' => 'failed'); 
            return $this->response->withJson($message);
        }else{
            $user = $sth->fetchObject();
            return $this->response->withJson($user);
        }
    });
});