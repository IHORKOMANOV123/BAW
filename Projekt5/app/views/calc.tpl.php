<?php include 'app/views/layout.tpl.php'; ?>

<section id="banner">
    <div class="inner">
        <h1>Witaj <?php echo htmlspecialchars(getUser()); ?>, możesz teraz skorzystać z kalkulatora.</h1>
        <ul class="actions">
            <li><a href="#calc" class="button big scrolly">Oblicz</a></li>
        </ul>
    </div>
</section>

<section id="calc" class="wrapper" style="background-color: #ffffff; color: #000000;">
    <div class="container">
        <div class="box" style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px;">
            <h2 style="color:#111; margin-bottom:20px;">Kalkulator kredytowy</h2>

            <?php if (!empty($messages)): ?>
                <div class="result-error">
                    <ul>
                        <?php foreach ($messages as $m): ?>
                            <li><?php echo $m; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (isset($rata)): ?>
                <div class="result-success">
                    Miesięczna rata: <strong><?php echo $rata; ?> PLN</strong>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?action=doCalc">
                <label for="kwota">Kwota kredytu (PLN):</label>
                <input type="number" name="kwota" id="kwota" step="0.01" required>

                <label for="procent">Oprocentowanie (%):</label>
                <input type="number" name="procent" id="procent" step="0.01" required>

                <label for="raty">Liczba rat (lat):</label>
                <input type="number" name="raty" id="raty" required>

                <br><br>
                <input type="submit" value="Oblicz" class="primary">
            </form>

            <p style="margin-top:20px;"><a href="index.php?action=logout">Wyloguj się</a></p>
        </div>
    </div>
</section>
