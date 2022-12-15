<main>
    <header>
        <h1>Profilo Utente</h1>
    </header>
    <section>
        <input id="user" type="hidden" value="<?php echo $_GET["id"]; ?>"/>
        <div class="row d-flex">
            <div class="col-md-1"></div>
            <div class="col-12 col-md-10">
                <div class="card by-1">
                    <div class="text-white bg-dark">
                        <div class="row">
                            <div class="col-3 col-md-2">
                                <img id="imgUtente" src=""
                                    alt="Immagine profilo utente" class="img-fluid img-thumbnail mx-2 my-2 w-100 h-90">
                            </div>
                            <div class="col-6 col-md-7 d-flex align-items-start flex-column">
                                <p id="nominativo" class="mt-auto mb-2">Nome e cognome</p>
                                <p id="username" class="mb-2">Username</p>
                            </div>
                            <div class="col-3 col-md-3 d-flex flex-row-reverse">
                                <button type="button" class="btn btn-outline-light mt-auto mb-auto mx-2">Segui</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-2 text-black">
                        <section>
                            <header>
                                <h2>Informazioni</h2>
                            </header>
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-2">
                                        <div class="p-1">
                                            <p id="sesso" class="font-italic mb-1"><strong>Sesso:</strong></p>
                                            <p id="nascita" class="font-italic mb-1"><strong>Nascita:</strong></p>
                                            <p id="interessi" class="font-italic mb-0"><strong>Interessi:</strong></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end text-center py-1">
                                        <div class="px-3">
                                            <p id="nSeguaci" class="mb-1 h5">---</p>
                                            <p class="small text-muted mb-0">Seguaci</p>
                                        </div>
                                        <div>
                                            <p id="nSeguiti" class="mb-1 h5">---</p>
                                            <p class="small text-muted mb-0">Seguiti</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="mb-2">
                            <header>
                                <h2>Amicizie</h2>
                            </header>
                            <div class="container mw-100 mt-3 mr-1 p-1">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header">
                                            <a id="btnSeguaci" class="collapsed btn w-100" data-bs-toggle="collapse" aria-expanded="false" href="#collapseOne">
                                                    <span class="list-item-title">Seguaci</span>
                                                    <img class="icon icon-primary" alt="Espandi seguaci" src="../../img/expand.svg"/>
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="collapse" data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <ul id="seguaci" class="list-group list-group-light">
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <a id="btnSeguiti" class="collapsed btn w-100" data-bs-toggle="collapse" aria-expanded="false" href="#collapseTwo">
                                                <span class="list-item-title">Seguiti</span>
                                                <img class="icon icon-primary" alt="Espandi seguaci" src="../../img/expand.svg"/>
                                            </a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <ul id="seguiti" class="list-group list-group-light">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                        <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                                                            class="rounded-circle" />
                                                        <div class="ms-1">
                                                            <p class="fw-bold mb-1">Username</p>
                                                        </div>
                                                        </div>
                                                        <a class="btn btn-outline-primary btn-rounded btn-sm" href="#" role="button">View</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h2>Post recenti</h2>
                            <div id="contPosts">
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </section>
</main>