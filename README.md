# Nested Layout

**Transclusion for PHP partials**

## What is it?

+ It's a simple class to make server-side partials reusable, by providing a **yield/outlet/transclusion** pattern, so they can act as nested layouts, too.
+ You can also pass local variables into a partial, allowing for decoupled view code.

## How do I use it?

#### Preparation
1. Put all your partials in a `/partials` subfolder.
2. Mark any outlets with a `{{outlet}}` declaration.
3. Mark any local variables with the key of what you'll pass into them, e.g. `array('title' => 'Foo')` will get converted to `$foo`.

#### Calling nested layouts
Here's an example call to the `layout` function, where you can optionally pass in local variables, and an outlet.

```php
	<?php $inner = layout('my-inner-layout', array('title' => 'And this is my inner layout')) ?>
		This content will replace the {{outlet}} in the partials/my-inner-layout.php file.
	<?php $inner->end() ?>
```

#### Calling basic partials
To keep a clean API, anything that doesn't need a nested layout can be called like this:

```php
	<?php partial('my-partial', array('text' => 'And this is my partial!')) ?>
```

#### Demo

You can look in the `demo.php` file included in this repository for an example of how to nest the calls.

#### Variable scope

All variables are completely scoped locally. They are deleted immediately after rendering the template, and won't be accessible from within sub-partials. (Undecided as to whether this is a good feature, or not.)

## Why make it?

There's a lot of templating libraries out there, but I wanted to make one that was geared solely around the idea of showing reusability of markup. The idea of a "layout" is everywhere. In Ember.js for example, every view is essentially a layout, using the `{{outlet}}` declaration. I wanted to use this idea, and apply it to server-side partials.


This stuff is pretty much possible in Ruby (and mainly Rails), but I wanted something more lightweight and portable. Something that you can use just to show your **intent of reusability**, even if it's not used in the final codebase.

## Who made it?

+ Joe Critchley (@joecritchley)
+ Inspired by Ember.js & Rails
