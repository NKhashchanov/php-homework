<?php
$continents = [
    'Africa' => ['Hexaprotodon liberiensis', 'Equus grevyi', 'Syncerus caffer'],
    'Europe' => ['Pusa hispida botnica', 'Sorex araneus', 'Lepus tanaiticus'],
    'Asia' => ['Panthera tigris corbetti', 'Caracal', 'Ratufa bicolor'],
    'Antarctica' => ['Leptonychotes weddellii', 'Balaenopteridae', 'Megaptera novaeangliae'],
    'Australia' => ['Thylacinus cynocephalus', 'Vombatidae', 'Dasyuromorphia'],
];
// Найдем всех животных, состоящих из двух слов.
$animalTwoWords = [];
$firstWord = [];
$secondWord = [];
foreach ($continents as $continent => $animals) {
    foreach ($animals as $animal){
        $allAnimals = [];
        $allAnimals = explode(' ', $animal);
        if (count($allAnimals) === 2){
            $animalTwoWords[] = implode(' ', $allAnimals);
            $firstWord[] = $allAnimals[0];
            $secondWord[] = $allAnimals[1];
            shuffle($secondWord);
        }
    }
}
echo '<pre>';
print_r($animalTwoWords);

// Создадим фантазийных животных
$fantasyAnimal = [];
for($i = 0; $i < count($animalTwoWords); $i++){
    $fantasyAnimal[]= $firstWord[$i] . ' ' . $secondWord[$i];
}
echo '<pre>';
print_r($fantasyAnimal);

// Выведем красивый список с принадлежностью к региону
foreach ($continents as $continent => $animals) {
    echo "<h2>$continent:</h2>";
    echo (implode (", ", $animals)) . ".";
}
// Выведем красивый фантазийный список с принадлежностью к региону
/*
сломался...
*/
?>