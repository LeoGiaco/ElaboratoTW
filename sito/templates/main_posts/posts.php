<main>
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row my-3">
            <div class="col-12 col-md-12">
                <section>
                    <header>
                        <h1 class="text-center">Bacheca</h1>
                    </header>
                    <button class="btn btn-primary rounded-circle" id="btnTop">^</button>
                    <div class="container py-2">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12 col-lg-10 col-xl-8">
                                <section>
                                    <header>
                                        <h2>Crea post</h2>
                                    </header>    
                                    <div class="card">
                                        <div id="alert" role="alert"></div>
                                        <div class="card-body">
                                            <div class="d-flex flex-start align-items-center">
                                                <img id="userImage" class="rounded-circle shadow-1-strong mr-2 me-2" src="images/profile_img/profilo.jpg" alt="avatar user" width="60" height="60" />
                                                <div>
                                                    <p class="fw-bold mb-1 text-left"><?php echo $_SESSION["user"] ?></p>
                                                </div>
                                            </div>
                                            <form id="formPost">
                                                <div class="mt-3 mb-1 pb-2">
                                                    <div class="form-outline w-100">
                                                        <label for="textAreaTitolo">Titolo: </label>
                                                        <textarea class="form-control" id="textAreaTitolo" rows="1" name="titolo" placeholder="Inserisci titolo" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-1 pb-2">
                                                    <div class="form-outline w-100">
                                                        <label for="textAreaTesto">Testo: </label>
                                                        <textarea class="form-control" id="textAreaTesto" rows="4" name="testo" placeholder="Inserisci testo del post" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="image" class="form-label">Seleziona immagine</label>
                                                    <input class="form-control form-control-sm" id="image" type="file" name="immagine" accept="image/*"/>
                                                </div>
                                                <div class="mt-2 pt-1">
                                                    <label for="slcGenere">Tipologia post:</label>
                                                    <select class="form-select form-select-sm" name="tipo" id="slcGenere"></select>
                                                </div>
                                                <div class="float-end mt-2 pt-1">
                                                    <input id="btnAggiungi" type="button" class="btn btn-primary btn-sm" value="Aggiungi"/>
                                                    <input id="btnCancella" type="button" class="btn btn-outline-primary btn-sm" value="Cancella">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </section>
                                <section id="sctId">
                                    <header>
                                        <h2>ULTIMI POST</h2>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="allPost">
                                            <label class="form-check-label" for="allPost">Visualizza solo i post dei seguiti</label>
                                        </div>
                                    </header>
                                    <div id="contPosts">
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
            <div class="col-1 col-md-3"></div>
        </div>
    </div>
</main>