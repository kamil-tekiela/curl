# About

The purpose of this GIT is to demonstrated what a CUrl class could look like in PHP. This is not a functional shim to be put in place. A native implementation would be much better and could solve some implementation problems. 

As of this moment in PHP 7.4 we only have `CURLFile` class. 

# Usage
The usage follows the same principle as the `curl_*` functions, but uses objects instead. 

```
$curl = new CUrl('http://example.org');
$curl->setopt(CURLOPT_RETURNTRANSFER, true)
	->setopt(CURLOPT_HEADER, false)
	->exec();
```

There has been a hack added to `CUrlShare` and `CUrlMulti` using `getInstance` method.

```
$shCUrl = new CUrlShare();
$CUrl = new CUrl();
$CUrl->setopt(CURLOPT_SHARE, $shCurl->getInstance());
```
This is to avoid exposing the private property. 

# Syntax sugar
`setopt_array` method has been added to both `CUrlShare` and `CUrlMulti`. This option is not available in vanilla PHP. 

`run_blocking_loop` was added to `CUrlMulti` as an experiment of what could be improved and simplified. 