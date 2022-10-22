<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = '8419f0110a5cdcb473041f119cf908ba11cf2e1ae8034c0a90742f213ea2388131f8ff34e272979151366350c1a86a8a771cefa1568b369c416edd66dec1eddebe4d626cc06e7ff69dea6150bfa9196f8488109c25f420a92e6bcc466f9ba17b3ef74e4216048e06830904dac76f051f6df9768dec64757770566d8c021868a3';

        $client = new Client([
            'base_uri' => 'http://localhost:1337/api/'
        ]);
    
        $headers = [
          'Authorization' => 'Bearer ' . $token,        
          'Accept'   => 'application/json',
      ];
  
      $response = $client->request('GET', 'books?pagination[pageSize]=66', [
          'headers' => $headers
      ]);
    
        $body = $response->getBody();
        $decoded_response = json_decode($body);
        return $decoded_response;
   
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