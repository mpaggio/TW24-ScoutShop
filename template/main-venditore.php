<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link text-primary active fs-4" id="articles-tab" data-bs-toggle="tab"
            data-bs-target="#articles-tab-pane" type="button" role="tab" aria-controls="articles-tab-pane"
            aria-selected="true">Articoli</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link text-primary fs-4" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane"
            type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="false">Ordini</button>
    </li>
</ul>
<div class="tab-content h-100 overflow-hidden bg-light" id="myTabContent">
    <div class="h-100 tab-pane fade show active h-100 p-4 row justify-content-around" id="articles-tab-pane" role="tabpanel"
        aria-labelledby="articles-tab" tabindex="0">
        <section class="col-md-5 p-2 bg-light text-primary h-100 overflow-auto">
            <h2 class="d-none fs-1"></h2>
            <div class="d-none border border-dark border-2 p-3">
                <form class="row justify-content-between" enctype="multipart/form-data">
                    <div class="d-flex justify-content-end">
                        <input class="btn btn-secondary me-3 fs-5" type="reset" value="Chiudi" aria-label="Chiudi form" />
                        <input class="btn btn-primary fs-5" type="submit" value="Salva" aria-label="Salva form" />
                    </div>
                </form>
            </div>
        </section>
        <section class="h-100 col-md-5 overflow-auto p-2">
            <div class="d-flex justify-content-between mb-2">
                <form class="d-flex flex-grow-1 me-3 fs-4" role="search">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                </form>
                <button class="btn btn-primary fs-4">Aggiungi</button>
            </div>
            <div class="d-flex flex-wrap justify-content-between w-100">
                
            </div>
        </section>
    </div>
    <div class="tab-pane justify-content-center fade h-100 overflow-hidden p-3" id="orders-tab-pane" role="tabpanel"
        aria-labelledby="orders-tab" tabindex="0">
        <div class="container d-flex flex-column h-100 overflow-auto">
            <ul class="list-group list-group-flush align-items-center border border-dark border-2">
                
            </ul>
        </div>
    </div>
</div>