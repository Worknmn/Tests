<?php
//mb_detect_encoding() если нужно будет регистро-независимо, то определять видимо кодировку, т.к. не особо верю в корректность mb_strtolower 
function get5TopWords($str) {
  $a = array();
  $str = mb_strtolower($str);
  //preg_match_all("/\b(\w+)\b/ui", $string, $matches) сырец не пробован.
  //'#\PL+#u' utf8
  //'#\PL+#' no utf8 
  $words = preg_split('#\PL+#u', $str, -1, PREG_SPLIT_NO_EMPTY);
  foreach ($words as $key=>$word) {
    foreach ($words as $keyin=>$wordin) {
      if ($wordin==$word) {
        //$a[$word]+=1; // можно так, но будет Notice, не всегда же можно, да и не нужно думаю
        if (array_key_exists($word, $a)) {
          $a[$word]+=1;
        } else {
          $a = array_merge($a, array($word=>1));
        }
        unset($words[$keyin]);
      }
    }
  }
  arsort($a, SORT_NUMERIC);
  $a = array_slice($a, 0, 5);
  return $a;
}
//var_dump(get5TopWords(''));
//var_dump(get5TopWords(' '));
var_dump(get5TopWords(' weather is like This This el ninã. dsfsdf ываыв-аывава this ')); 