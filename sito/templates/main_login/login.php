<main>
    <input id="login" type="hidden" name="login" value="<?php echo $_GET["iscr"]; ?>"/>
    <div class="container-fluid p-0 overflow-hidden">
        <header>
            <div class="row">
                <div class="mt-2 col-12 col-lg-6 d-flex justify-content-center d-lg-block justify-content-lg-start" id="iscrivitiImg">
                    <img src="../../img/icon2x.svg" alt="Logo sito"/>
                </div>   
                <div class="col-12 col-lg-6 d-flex justify-content-center d-lg-block justify-content-lg-start" id="iscrivitiP">
                    <p class="pt-10 w-75 text-center text-lg-start">
                    <span class="text-uppercase fs-3 fw-bold">Accedi ora</span><span> al 1° social network italiano a tema universitario!</span>
                    </p>
                </div>
            </div>
            <div class="row">
                <div>
                    <h1 class="pt-3 text-center">ACCEDI</h1>
                </div>
            </div>
        </header>   
        <div class="row my-5">
            <div class="col-1 col-md-3"></div>
            <div class="col-10 col-md-6 text-center">
                <div id="alert" role="alert"></div>
                <section class="card">
                    <h2>Inserisci credenziali</h2>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form id="form_login" action="" method="POST">
                                <div class="row mt-4 mb-2">
                                    <div class="col-md-12 col-lg-4 my-auto">
                                        <label for="email">Email: </label>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <input type="email" id="email" name="email" required autofocus/>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-12 col-lg-4 my-auto">
                                        <label for="password">Password: </label>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <input type="password" id="password" name="password" required/>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-lg-12">
                                        <input id="btnAccedi" type="button" class="btn btn-outline-success" value="Accedi"/>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-lg-12">
                                        <input id="btnIscriviti" type="button" class="btn btn-outline-primary" value="Non ho un account">
                                    </div>
                                </div>
                            </form>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>
                </section>
            <div class="col-1 col-md-3"></div>
        </div>
    </div>
</main>