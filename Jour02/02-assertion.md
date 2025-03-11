# Assertions :
https://docs.phpunit.de/en/9.6/assertions.html


```php

assertSame();  // mm valeur et mm type
assertEqual();  // mm valeur 2 et "2"
assertEmpty();  // "" 0 [] null
assetContains(); // [1,2,3,4] ==> chercher dans le tableau il ya un chiffre 3
assertStringContainsString()  // "Texte Alain"  ==> chercher dans le string il ya "Alain"
assertException();  // est ce que il y a une exception déclenchée

```