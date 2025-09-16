

# But : écrire une fonction buildArticle(array $row): array qui renvoie :
<?php

/*

function buildArticle(array $row): array{

    return [
        'title'     => isset($row['title']) ?? trim($row['title']= ''),
        'excerpt'   => isset($row['excerpt']) && trim($row['excerpt']) !== '' ? trim($row['excerpt']) : null,
        'views'     => isset($row['views']) ? max(0,(int)$row['views']) : 0 ,
        'published' => !empty($row['published']),
        'author'    => isset($row['author']) ? trim($row['author']) : ''
    ];

}


*/


$input = [
    'title'   => 'PHP 8 en pratique',
    'excerpt' => '',
    'views'   => '300',
    'author'  => 'Yassine'
];

$article = buildArticle2($input);
print_r($article);


#(Corrigé indicatif)

function buildArticle2(array $row): array {
    $row['title']     ??= 'Sans titre';
    $row['author']    ??= 'N/A';
    $row['published'] ??= false; # false not true

    $title   = trim((string)$row['title']);
    $excerpt = isset($row['excerpt']) ? trim((string)$row['excerpt']) : null;
    $excerpt = ($excerpt === '') ? null : $excerpt;

   # $views   = (int)($row['views'] ?? 0);
   # $views   = max(0, $views);

    $views = max(0,(int)($row['views'])) ??  0;

    return [
        'title'     => $title,
        'excerpt'   => $excerpt,
        'views'     => $views,
        'published' => (bool)$row['published'],
        'author'    => trim((string)$row['author']),
    ];
}

