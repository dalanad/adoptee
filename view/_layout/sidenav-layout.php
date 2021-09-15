<?php require_once  __DIR__ . '/layout.php' ?>
<style>
    .admin-header {
        padding: .6rem 1rem;
        border-bottom: 1px solid var(--gray-3);
        display: flex;
        height: 3rem;
        box-sizing: border-box;
    }

    .side-nav-container {
        display: flex;
        height: calc(100vh - 3rem);
    }

    .side-nav {
        width:  4rem;
        height: 100%;
        border-right: 1px solid var(--gray-3);
    }
</style>
<div>
    <div class="admin-header">
        <img src="/assets/images/logo_vector.svg" style="height:35px">
    </div>
    <div class="side-nav-container">
        <div class="side-nav">
            <a class="side-link" href="#"><i class="fa fa-cog"></i></a>
        </div>
        <div class="content"></div>
    </div>
</div>