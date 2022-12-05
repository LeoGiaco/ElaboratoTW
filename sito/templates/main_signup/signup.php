<main>
    <div class="container-fluid p-0 overflow-hidden">
        <header>
            <div class="row">
                <div class="mt-2 col-12 col-lg-6 d-flex justify-content-center d-lg-block justify-content-lg-start" id="iscrivitiImg">
                    <img src="../../img/icon2x.svg" alt="Logo sito"/>
                </div>   
                <div class="col-12 col-lg-6 d-flex justify-content-center d-lg-block justify-content-lg-start" id="iscrivitiP">
                    <p class="pt-10 w-75 text-center text-lg-start">
                    <span class="text-uppercase fs-3 fw-bold">Registrati ora</span><span> al 1° social network italiano a tema universitario!</span>
                    </p>
                </div>
            </div>
            <div class="row">
                <div>
                    <h1 class="pt-3 text-center">ISCRIVITI</h1>
                </div>
            </div>
        </header>   
        <div class="row my-5">
            <div class="col-1 col-md-3"></div>
            <div class="col-10 col-md-6 text-center">
                <form id="form_sign">
                    <div class="card">
                        <div id="alert" ìrole="alert"></div>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="row mt-4 mb-2">
                                    <div class="col-md-12 col-lg-4 my-auto">
                                        <label for="nome">Nome: </label>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <input type="text" id="nome" name="nome" required autofocus/>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-12 col-lg-4 my-auto">
                                        <label for="cognome">Cognome: </label>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <input type="text" id="cognome" name="cognome" required/>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-12 col-lg-4 my-auto">
                                        <label for="email">Email: </label>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <input type="email" id="email" name="email" required/>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-12 col-lg-4 my-auto">
                                        <label for="nascita">Data di nascita: </label>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <input type="date" id="nascita" name="nascita" required/>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-12 col-lg-4 my-auto">
                                        <label for="genere">Genere: </label>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <label><input class="mx-1" type="radio" value="M"  name="genere"/>Uomo</label>
                                        <label class="mx-1"><input class="mx-1" type="radio" value="F" name="genere"/>Donna</label>
                                        <label><input class="mx-1" type="radio" value="A" name="genere"/>Altro</label>
                                    </div>
                                </div>
                                <div class="row mx-4 my-3 border-bottom"></div>
                                <div class="row my-2">
                                    <div class="col-md-12 col-lg-4 my-auto">
                                        <label for="username">Username: </label>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <input type="username" id="username" name="username" required/>
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
                                        <button id="button" class="btn btn-outline-success" type="button">Crea nuovo account</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-1 col-md-3"></div>
        </div>
    </div>
</main>