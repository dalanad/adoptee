<?php require_once  __DIR__ . './layout.php' ?>
<style>
    body {
        height: unset;
    }
</style>
<div style="text-align: center;">
    <h1 style="font-size:3em;margin-top:20vh;margin-bottom:0;font-weight:500;color:red">
        ERROR : <?= $code = $exception->getCode() ?>
    </h1>
    <h3 style="margin-top: 1rem;"><?= get_class($exception) ?> : <?= $exception->getMessage() ?> </h3>
    <button class="btn btn-link " onclick="history.back()">Go Back</button>
    |
    <a class="btn btn-link" style="margin-top: 1rem;" href="/">Go to Homepage </a>
</div>
<code style="margin:  3rem;font-size:12px;display:block">
    Stack trace:
    <pre style="white-space: pre-wrap;"><?= $exception->getTraceAsString() ?></pre>
    <p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>
</code>