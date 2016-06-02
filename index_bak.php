<?php
    function processURL($url)
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2
        ));

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    $tag = 'tinyplanet';
    $token = '187207740.c91b5f8.74f03550fb08466390f553d353b94877';
    $client_id = "c91b5f8b136c4342805fd2a94a464fbe";
    // $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;
    $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=187207740.c91b5f8.74f03550fb08466390f553d353b94877';

    $all_result  = processURL($url);
    $decoded_results = json_decode($all_result, true);

    // foreach($decoded_results['data'] as $item){
    //     $image_link = $item['images']['thumbnail']['url'];
    //     echo '<a href="#"><img src="'.$image_link.'" /></a>';
    // }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Automatic Image Montage with jQuery</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
        <style type="text/css" media="screen">
            .grid-item { width: 20%; }
        </style>
    </head>
    <body>

        <div class="grid">
            <?php
            foreach($decoded_results['data'] as $item){
                $image_link = $item['images']['thumbnail']['url']; ?>
                <div class="grid-item"><a href="#"><img width="100%" src="<?php echo $image_link ?>" /></a></div>
            <?php }
             ?>
        </div>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
        <script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // init Masonry
                var $grid = $('.grid').masonry({
                  itemSelector: '.grid-item',
                });
                // layout Masonry after each image loads
                $grid.imagesLoaded().progress( function() {
                  $grid.masonry('layout');
                });
            });
        </script>
    </body>
</html>
