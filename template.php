<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modern PHP</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/7f8f824712.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1><i class="fas fa-comment-dots"></i> VoteR</h1>
  </header>
  <main>
    <section>
      <h2>#<?= $dayOfYear ?> <?= $data['question'] ?>?</h2>
      <form method="POST">
        <ul>
          <?php foreach ($data['answers'] as $answer => $votes) : ?>
            <li>
              <label>
                <input type="radio" name="vote" value="<?= $answer ?>"><?= $answer ?>
              </label>
              <span><i style="color:<?= setRankColor($totalVotes, $votes) ?>" class="fas fa-heart"></i><?= calculatePercent($totalVotes, $votes) ?>%</span>
            </li>
          <?php endforeach; ?>
          <li>
            <input type="text" name="new-option" placeholder="saját válasz hozzáadása">
          </li>
        </ul>
        <input type="submit" value="Szavazok">
      </form>
    </section>
  </main>
</body>

</html>