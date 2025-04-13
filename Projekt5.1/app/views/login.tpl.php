<?php include 'app/views/layout.tpl.php'; ?>

<section id="banner">
    <div class="inner">
        <h1>Cześć, musisz się zalogować, aby skorzystać z kalkulatora.</h1>
        <ul class="actions">
            <li><a href="#login" class="button big scrolly">Login</a></li>
        </ul>
    </div>
</section>

<section id="login" class="wrapper style1 special fade-up" style="background-color: #0b1f3a;">
    <div class="container">
        <div class="box" style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px;">
            <h2 style="color:#111; margin-bottom:20px;">Zaloguj się</h2>

            <?php if (!empty($error)): ?>
                <div style="color:red; margin-bottom: 20px;"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?action=doLogin">
                <label for="login">Login:</label>
                <input type="text" name="login" id="login" required>

                <label for="pass">Hasło:</label>
                <input type="password" name="pass" id="pass" required>

                <br><br>
                <input type="submit" value="Zaloguj się" class="primary">
            </form>
        </div>
    </div>
</section>
