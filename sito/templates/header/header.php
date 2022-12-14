<?php
    $logged = isset($_SESSION["user"]);
    $margin = $logged ? "me-auto" : "ms-auto";
?>

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid justify-content-end text-end">
            <div class="bg-light border border-light image-wrapper-small wrapper-fixed-max ms-2 me-auto">
                <img src="images/icon-negative.svg" alt="Icona U-niversity">
            </div>
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2 ms-md-2">
                <ul class="navbar-nav <?=$margin?>">
                    <?php if ($logged): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="homepage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a id="navNotifiche" class="nav-link" href="notifications.php">Notifiche</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php?id=<?= $_SESSION["user"]; ?>">Profilo</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Signup</a>
                        </li>
                    <?php endif; ?>
                    </ul>
                </div>
                <div class="md-auto order-0">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".dual-collapse2">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            </div>
            <?php if ($logged): ?>
                <div class="navbar-collapse collapse order-4 order-md-0 dual-collapse2">
                    <form id="form_search" class="d-flex justify-content-end" >
                        <label for="cerca" class="d-flex align-middle text-white"><span class="align-self-center mx-1">Cerca:</span></label>
                            <input id="cerca" size="16" type="search" name="search" placeholder="Cerca nome utente" aria-label="Search"/>
                        
                        <button class="btn btn-3" type="submit">Cerca</button>
                    </form>
                </div>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php">Impostazioni</a>
                        </li>
                        <li class="nav-item">
                            <a id="esci" class="nav-link" href="#">Esci</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>
