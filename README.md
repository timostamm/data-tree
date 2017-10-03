PHP Tree data structure
=======================

This library provides a tree structure via discrete Traits. 

It is intended to be used by other libraries.  


### ChildrenTrait

Add, acces and remove child nodes using this trait.

### LookupTrait

Optional methods to inspect the tree.

### AttributesTrait

Optional attributes per node.

### ToStringTrait

Optional `__toString()` implementation that outputs the nodes class name and its attributes.

### NodeTrait

Combines all of the above traits

### Protected Access

The sub-namespace `ProtectedAccess` contains versions of `ChildrenTrait`, `LookupTrait` and `AttributesTrait` where all methods are protected. This allows fine control over the public API when using the Traits in a library.


## Example

```php
// Create a simple tree.
$root = new Node();
$root->setAttribute('name', 'root');

$a = new Node();
$a->setAttribute('name', 'a');
$root->addChild($a);

$b = new Node();
$b->setAttribute('name', 'b');
$root->addChild($b);

$c = new Node();
$c->setAttribute('name', 'c');
$root->addChild($c);


// Find a descendant with the name=b
$bAgain = $root->descendant(function ($node) {
	return $node->getAttribute('name') === 'b';
});

// Get the root node of any node
$rootAgain = $bAgain->findRootNode();

// Remove a node
$bAgain->remove();
$root->removeChild($a);
$root->removeChildAt(0);
```
