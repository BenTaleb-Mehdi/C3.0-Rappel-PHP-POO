# But : écrire une fonction buildArticle(array $row): array qui renvoie :


<?php

#(Corrigé indicatif)

function buildArticle(array $row): array {
    $row['title']     ??= 'Sans titre';
    $row['author']    ??= 'N/A';
    $row['published'] ??= true; 

    $title   = trim((string)$row['title']);
    $excerpt = isset($row['excerpt']) ? trim((string)$row['excerpt']) : null;
    $excerpt = ($excerpt === '') ? null : $excerpt;

     $views   = (int)($row['views'] ?? 0);
     $views   = max(0, $views);


    return [
        'title'     => $title,
        'excerpt'   => $excerpt,
        'views'     => $views,
        'published' => (bool)$row['published'],
        'author'    => trim((string)$row['author']),
    ];
}

// ----------------
// TESTS MANUELS
// ----------------

$tests = [

    # Exemple 1
    [
        'title'   => 'PHP 8 en pratique',
        'excerpt' => '',
        'views'   => '300',
        'author'  => 'Yassine'
    ],

    # Exemple 2 (tout est vide)
    [
        'title'   => '',
        'excerpt' => '',
        'views'   => '',
        'author'  => ''
    ],

    # Exemple 3 (titre avec espaces, vues négatives)
    [
        'title'   => '   Hello   ',
        'excerpt' => 'Résumé...',
        'views'   => '-5',
        'author'  => '   Mehdi   ',
        'published' => false
    ],

    # Exemple 4 (manque le champ excerpt)
    [
        'title'   => 'Laravel Framework',
        'views'   => '1200',
        'author'  => 'Ahmed'
    ],

    # Exemple 5 (aucune donnée → array vide)
    []
];

# ----------------
# BOUCLE D’AFFICHAGE
# ----------------
foreach ($tests as $i => $test) {
    echo "Test #" . ($i+1) . "\n";
    $result = buildArticle($test);
    print_r($result);
    echo "------------------\n\n";
}

