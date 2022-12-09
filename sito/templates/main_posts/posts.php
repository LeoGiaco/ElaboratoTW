<main>
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row my-3">
            <div class="col-12 col-md-12">
                <section>
                    <header>
                        <h1 class="text-center">Bacheca</h1>
                    </header>
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
                                                <img class="rounded-circle shadow-1-strong mr-2 me-2" src="../../img/profilo.jpg" alt="avatar user" width="60" height="60" />
                                                <div>
                                                    <p class="fw-bold text-primary mb-1 text-left"><?php echo $_SESSION["user"] ?></p>
                                                </div>
                                            </div>
                                            <form id="formPost">
                                                <div class="mt-3 mb-1 pb-2">
                                                    <div class="form-outline w-100">
                                                        <textarea class="form-control" id="textAreaExample" rows="1" name="titolo" placeholder="Inserisci titolo" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-1 pb-2">
                                                    <div class="form-outline w-100">
                                                        <textarea class="form-control" id="textAreaExample" rows="4" name="testo" placeholder="Inserisci testo del post" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="image" class="form-label">Seleziona immagine</label>
                                                    <input class="form-control form-control-sm" id="image" type="file" name="immagine" accept="image/*"/>
                                                </div>
                                                <div class="float-start mt-2 pt-1">
                                                    <label for="slcGenere">Tipologia post:</label>
                                                    <select name="tipo" id="slcGenere"></select>
                                                </div>
                                                <div class="float-end mt-2 pt-1">
                                                    <input id="btnAggiungi" type="button" class="btn btn-primary btn-sm" value="Aggiungi"/>
                                                    <input id="btnCancella" type="button" class="btn btn-outline-primary btn-sm" value="Cancella">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>

                <section style="background-color: #eee;">
                    <div class="container my-5 py-5">
                        <div class="row d-flex justify-content-center">
                        <div class="col-md-12 col-lg-10 col-xl-8">
                            <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-start align-items-center">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60"
                                    height="60" />
                                <div>
                                    <h6 class="fw-bold text-primary mb-1">
                                    Lily Coleman
                                    </h6>
                                    <p class="text-muted small mb-0">
                                    Shared publicly - Jan 2020
                                    </p>
                                </div>
                                </div>

                                <p class="mt-3 mb-4 pb-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                consequat.
                                </p>

                                <div class="small d-flex justify-content-start">
                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="far fa-thumbs-up me-2"></i>
                                    <p class="mb-0">Like</p>
                                </a>
                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="far fa-comment-dots me-2"></i>
                                    <p class="mb-0">Comment</p>
                                </a>
                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="fas fa-share me-2"></i>
                                    <p class="mb-0">Share</p>
                                </a>
                                </div>
                            </div>
                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                <div class="d-flex flex-start w-100">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40"
                                    height="40" />
                                <div class="form-outline w-100">
                                    <textarea class="form-control" id="textAreaExample" rows="4"
                                    style="background: #fff;"></textarea>
                                    <label class="form-label" for="textAreaExample">Message</label>
                                </div>
                                </div>
                                <div class="float-end mt-2 pt-1">
                                <button type="button" class="btn btn-primary btn-sm">
                                    Post comment
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    Cancel
                                </button>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
            <div class="col-1 col-md-3"></div>
        </div>
    </div>
</main>