<?php

$send = false;
if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
    if ($_FILES["image"]["size"] <= 3000000) {
        $nomImage = pathinfo($_FILES["image"]["name"]);
        $extensionImage = $nomImage["extension"];
        $extensionAutorisee = ["jpg", "png", "jpeg", "gif"];

        if (in_array($extensionImage, $extensionAutorisee)) {
            $imageName = rand() . "." . $extensionImage;
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $imageName);
            $send = true;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Files</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-png">
    <link rel="stylesheet" href="default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>

    <header>
        <a href="../">
            <span>ShareFiles</span>
        </a>
    </header>

    <section>
        <h1>
            <?php if ($send) { ?>
                <img src="uploads/<?= $imageName ?>" alt="Image Uploadé" width="75%">
                <input type="text" name="link" id="link" value="<?= "http://localhost/BELIEVEMY_PHP/PROJETS/SHARE_FILES/uploads/" . $imageName ?>">
            <?php } else { ?>
                <i class="fas fa-paper-plane"></i>
            <?php } ?>
        </h1>

        <form method="post" action="index.php" enctype="multipart/form-data">
            <p>
                <label for="image">Sélectionnez votre fichier</label><br>
                <input type="file" name="image" id="image">
            </p>
            <p id="send">
                <button type="submit">Envoyer <i class="fas fa-long-arrow-alt-right"></i></button>
            </p>
        </form>
    </section>

</body>

</html>