<?php
function reverseWords($sentence) {
    // Split the sentence into words and punctuation marks
    preg_match_all('/\w+|[^\w\s]+|\s+/', $sentence, $matches);
    $words = $matches[0];

    print_r($words) ;

    // Initialize an empty array to store the reversed words
    $reversedWords = array();

    // Loop through each word
    foreach ($words as $word) {
        // Reverse the characters of the word (excluding punctuation marks)
        if (ctype_alpha($word)) {
            $reversedWord = strrev($word);
            echo $reversedWord."\n";
        } else {
            $reversedWord = $word;
            echo $reversedWord."\n";
        }
        
        // Add the reversed word to the array
        $reversedWords[] = $reversedWord;
    }

    // Combine the reversed words back into a sentence
    $reversedSentence = implode("", $reversedWords);

    return $reversedSentence;
}

// Example usage
$sentence = "I lov'e, programming.";
$result = reverseWords($sentence);
echo $result."\n";
?>
