<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= $category->title ?><span
                class="caret"></span></a>
    <ul class="dropdown-menu">
        <?php foreach ($category->activeSubCategories as $category): ?>
            <li><a href="#"><?= $category->title ?></a></li>
        <?php endforeach ?>
    </ul>
</li>

