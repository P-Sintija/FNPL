
A small app to get first non repeating, first least repeating and first most repeating character in a txt file witch contaions only lower case alphabet ASCII letters, punctuations and symbols.

# SET UP

> **composer install**

>create local database *fly_test*

>rename file *.env.example* to *.env*

> **php artisan key:generate**

> **php artisan migrate**


# CLI

> **php artisan script app\Scripts\Script.php** and add willing conditions

### conditions: 
1) -i= or --input=*path
2) -f= or --format=**recurrence
3) ***characters

*path (paths to an existing txt file);

**recurrence (one must be provided): 
non-repeating 
least-repeating 
most-repeating

***characters (at least one must be provided):
-L or --include-letter
-P or --include-punctuation
-S or --include-symbol

#### example:
*php artisan script app\Scripts\Script.php -i=storage\files\file.txt -f=non-repeating -L -P -S*

Will output first non repeating letter, punctuation and symbol.

# BROWSER

> php artisan serve
 
Open the app in browser. There you can add a *.txt file and set your willing conditions to get the recurrence of characters in the given file.
Conditions are the same as for CLI.

# Error message meaning
Error code: 1 - If there is no -i= or --input= flag, or the file path provided does not exist;

Error code: 2 - If the file does not contain any lower case alphabet ASCII letters, punctuations and symbols or has other forms of characters;

Error code: 3 - If there is no -f= or --format= flag provided, or the provided recurrence value does not meet the specified values;

Error code: 4 - If none of the character flags are provided;