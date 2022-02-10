<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $title ?? "Centro de estudiantes de la Confederacion Suiza" ?></title>
    <link href="http://cecs.localhost/cdn/bootstrap.min.css" rel="stylesheet">
    <script src="http://cecs.localhost/cdn/bootstrap.bundle.min.js" ></script>
    <link href="http://cecs.localhost/cdn/tailwind.min.css" rel="stylesheet">
    <script src="http://cecs.localhost/cdn/sweetalert2@11.js" defer></script>
    <link rel="shortcut icon" href="favicon.ico">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="http://cecs.localhost/cdn/ionicons.js"></script>
    <?php /*
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <link rel="shortcut icon" href="favicon.ico">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    
    */ ?>


    <style>
    ion-icon{
        margin-top: 5px;
        font-size: 24px;
    }
    </style>
    <link href="/css/footer.css" rel="stylesheet">
    <script id="vars">
        <?php
        if (isset ($jsvars)){
            foreach($jsvars as $varname=>$varval){
                ?>
        var <?= $varname ?> = <?= is_numeric($varval) ? $varval : ( is_array($varval) ? '`'.str_replace("`", "\`",addslashes(json_encode($varval))).'`' : '`'.str_replace("`", "\`",addslashes($varval)).'`' ) ?>;
                <?php
            }
        }
        ?>
        console.log("variables from php loaded");
    </script>
    <?= $headertags ?? "" ?>

    <script>
        function CheckError(response) {
            if (response.status >= 200 && response.status <= 299) {
                return response.json();
            } else {
                throw Error(response.statusText);
            }
        }
    </script>
</head>
<body>