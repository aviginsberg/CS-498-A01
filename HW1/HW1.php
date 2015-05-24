<?php
/**
 * User: aviginsberg
 * IDE: PhpStorm.
 * Date: 5/24/15
 */

//require our main functions class
require("HW1Functions.php");

//instantiate the functionsclass
$HW1F = new HW1Functions();


//Sort our first file
if($HW1F->Sort_File_Ascending("pure_animals_unsorted.txt","pure_animals_sorted.txt")){
    echo "File was sorted successfully.\n";
}else{
    echo "There was an error sorting the file.\n";
}


//Sort our second file
if($HW1F->Sort_File_Ascending("hybrid_animals_unsorted.txt","hybrid_animals_sorted.txt")){
    echo "File was sorted successfully.\n";
}else{
    echo "There was an error sorting the file.\n";
}

//Merge our files
if($HW1F->Merge_2_Sorted_Ascending("pure_animals_sorted.txt","hybrid_animals_sorted.txt","all_animals_sorted_merged.txt")){
    echo "Files were merged successfully.\n";
}else{
    echo "There was an error merging the files.\n";
}
