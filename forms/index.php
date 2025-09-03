<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulare</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="card">

        <?php
            if (filter_has_var(INPUT_GET, 'errors')) {
                $errors = filter_input(INPUT_GET, 'errors', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            }
        ?>

        <h1>Kontaktformular</h1>

        <form method="post" action="submit.php">
            <table>
                <tr<?php if (isset($errors['name'])) { echo ' class="error"'; } ?>>
                    <th><label for="name">Name</label></th>
                    <td>
                        <input type="text" name="name" id="name" placeholder="John Doe" value="<?php echo filter_input(INPUT_GET, 'name') ?? '' ?>">
                        <?php
                        if (isset($errors['name'])) {
                            echo '<div class="error">' . htmlspecialchars($errors['name']) . '</div>';
                        }
                        ?>
                    </td>
                </tr>
                <tr<?php if (isset($errors['email'])) { echo ' class="error"'; } ?>>
                    <th><label for="email">E-Mail-Adressse</label></th>
                    <td>
                        <input type="email" name="email" id="email" placeholder="john@doe.com" value="<?php echo filter_input(INPUT_GET, 'email') ?? '' ?>">
                        <?php
                        if (isset($errors['email'])) {
                            echo '<div class="error">' . htmlspecialchars($errors['email']) . '</div>';
                        }
                        ?>
                    </td>
                </tr>
                <tr<?php if (isset($errors['message'])) { echo ' class="error"'; } ?>>
                    <th><label for="message">Deine Nachricht</label></th>
                    <td>
                        <textarea name="message" id="message"><?php echo filter_input(INPUT_GET, 'message') ?></textarea>
                        <?php
                        if (isset($errors['message'])) {
                            echo '<div class="error">' . htmlspecialchars($errors['message']) . '</div>';
                        }
                        ?>
                    </td>
                </tr>
                <tr class="submit">
                    <td colspan="2"><input type="submit" name="submit" value="absenden" class="btn"></td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>
