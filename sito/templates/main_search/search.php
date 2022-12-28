<main>
    <input id="textSearch" type="hidden" name="search" value="<?php if(isset($_GET["search"])){echo $_GET["search"];}?>" />
    <section class="container-fluid p-0 overflow-hidden">
        <header>
            <h1 class="text-center">Ricerca</h1>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <section class="box shadow-sm rounded bg-white my-2">
                        <header class="box-title border-bottom p-3">
                            <h2 class="m-0">Risultati</h2>
                        </header>
                        <div class="box-body p-0">
                            <ul id="ricercaList" class="list-group list-group-light">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Nessun risultato per la ricerca corrente.
                                </li>                          
                            </ul>
                        </div>
                    </section>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section>
</main>