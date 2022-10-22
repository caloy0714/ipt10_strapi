<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = 'e45b446f5f3ed1c7f012de79a42b04fbe08cb7402d9e581e0b1771ab7c8519e2ba5fa5394dafa2174d509cfdc9db243ae6f5d0f6533d03022f315657ad42f5d106e4badbf34c4b114a2eca469e955b7cab3a499ffa2f20addbabcae594fd3b0d70cddcad88ea0fbbca5bb1f7ed2a9426cb19cac9c8968cfe14f5562b847d42e8';

        $client = new Client([
            'base_uri' => 'http://localhost:1337/'
        ]);
    
        $headers = [
          'Authorization' => 'Bearer ' . $token,        
          'Accept'   => 'application/json',
      ];
  
      $response = $client->request('GET', 'books?pagination[pageSize]=66', [
          'headers' => $headers
      ]);
    
        $body = $response->getBody();
        $response = json_decode($body);
        return $response;
   
}

$books = getBooks();
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>BIBLE</title>
    </head>
    <body>
        <div class = "container">
            <div class = "row">
                <div class = "col-10">
                    <table class="table table-striped">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                        </tr>
                        <?php
                            foreach($books->data as $bookCon) {
                            $book = $bookCon->attributes;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $bookCon->id; ?></td>
                            <td><?php echo $book->name; ?></td>
                            <td><?php echo $book->author; ?></td>
                            <td><?php echo $book->category; ?></td>
                        </tr>
                        
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>