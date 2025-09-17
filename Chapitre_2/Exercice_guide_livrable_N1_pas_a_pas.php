<?php
declare(strict_types=1);

$articles = [
  ['id'=>1,'slug'=>'intro-laravel','views'=>120,'author'=>'Amina','category'=>'php', 'published' => true],
  ['id'=>2,'slug'=>'php-8-nouveautes','views'=>300,'author'=>'Yassine','category'=>'php' , 'published' => true],
  ['id'=>3,'slug'=>'css-grid-guide','views'=>180,'author'=>'Mehdy','category'=>'css' , 'published' => false],
  ['id'=>4,'slug'=>'javascript-promises','views'=>250,'author'=>'Sara','category'=>'javascript' , 'published' => true],
];


# for test pub
$published = array_values(array_filter($articles,fn($a) => $a['published'] ?? false));


$normalizier = array_map (
     fn($a) => [
        'id' => $a['id'],
        'slug' => $a['slug'],
        'views' => $a['views'],
        'author' => $a['author'],
        'category' => $a['category']
     ],

     $published
    );

    print_r($normalizier);
   


usort($normalizier,fn($x , $y) => $y['views'] <=> $x['views']);

$summary = array_reduce(
    $published,
    function(array $acc,array $a ) : array{
        # get count articles ------------------------------------
        $acc['count'] = ($acc['count'] ?? 0 ) + 1;
        # get sum views articles ------------------------------------
        $acc['sum_views'] = ($acc['sum_views'] ?? 0) + $a['views'];
        # get sum categorys articles ------------------------------------
        $cat = $a['category'];
        $acc['by_cat'][$cat] = ($acc['by_cat'][$cat] ?? 0) + 1;

        return $acc;

    },
    ['count'=>0, 'sum_views'=>0, 'by_cat'=>[]]
);

print_r($summary);
