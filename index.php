<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<script>
    data = '1';

    function endArticles() {
        console.log('Конец');
    }

    function renderArticles(json) {
        console.log(json);
    }

    $.ajax({
        url: '/handler.php',
        method: 'POST',
        data: `category= ${data}`,
        success: function (response) {
            // Response values:
            // response === ‘end’ - нет статей в заданной категории
            // response : [ {title: ‘article_title’, description: ‘article_description’, image: ‘article_image’

            if (response === 'end') {
                endArticles();
                return;
            }

            renderArticles(JSON.parse(response));

        }

});

</script>
</body>
</html>