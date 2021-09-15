<?php require_once  __DIR__ . '/layout.php' ?>
<style>
    body {
        height: unset;
    }
</style>
<div style="text-align: center;">
    <img src="/assets/images/graphics/error.svg" style="margin-top: 3rem;max-width:500px">
    <h1 style="color:red"> CODE : <?= $code = $exception->getCode() ?> </h1>
    <h3 ><?= get_class($exception) ?> : <?= $exception->getMessage() ?> </h3>
    <button class="btn btn-link " onclick="history.back()">Go Back</button>
    |
    <a class="btn btn-link" style="margin-top: 1rem;" href="/">Go to Homepage </a>
</div>
<code style="margin: 3rem;font-size:12px;display:block">
    Stack trace:
    <pre style="white-space: pre-wrap;"><?= $exception->getTraceAsString() ?></pre>
    <p>Thrown in '<?=$exception->getFile()?>' on line "<?= $exception->getLine() ?>"</p>
</code>