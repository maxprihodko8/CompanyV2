<h2>Категории</h2>
<ul class="list-group" >
    <a href="/admin/company/index" class="list-group-item">Компании<span class="badge">
            <?= isset($CompanyCount) ? $CompanyCount : "" ?></span></a>
    <a href="/admin/tender/index" class="list-group-item">Тендера<span class="badge">
            <?= isset($tenderCount) ? $tenderCount : "" ?></span></a>
    <a href="/admin/bid/index" class="list-group-item">Запросы<span class="badge">
            <?= isset($bidCount) ? $bidCount : "" ?></span></a>

</ul>