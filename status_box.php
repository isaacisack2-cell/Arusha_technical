<p id="status_box" style="width: 100%;padding: 0;height: fit-content;background-color: rgba(200, 190, 195, 0.8);margin: 5px;background-color: #008a00;">
    <?php if(isset($message)): ?>
        <p class="message_box" style="color: #00FF00;font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;font-weight: 500;padding: 7px;border: 2px solid #1cc33a;">
            <?= $message; ?></p>
    <?php elseif(isset($error)): ?>
        <p class="error_box" style="border: 1px solid #a02109;color: #FF0000;font-weight: 600;padding:8px;font-size:20px;">
            <?= $error; ?></p>
    <?php endif; ?>
</p>