Tc Front Matter
===============

> An adapter based front matter parser/dumper for php

Installation
------------

```shell
composer require tc/front-matter
```

Adapters
--------

- YAML
- JSON

Example Usage
-------------

```php
<?php

use Tc\FrontMatter\FrontMatter;
use Tc\FrontMatter\Adapter\JsonAdapter;

// sample yaml front matter
$fileContent = '---
title: A Title
slug: a-slug
created: 2017-01-01 12:00
---
This is some sample content
';

// create a new parser/dumper
$frontMatter = new FrontMatter();

// parse file contents
$document = $frontMatter->parse($fileContent);

// get data
$document->getData();

// get content
$document->getContent();

// dump the document back to front matter string
$dump = $frontMatter->dumpDocument($document);

// dump data and content back to front matter string
$dump = $frontMatter->dump(['foo' => 'bar'], 'Hello World');

// parse JSON front matter
$jsonAdapter = new JsonAdapter();

// create new parser/dumper using the json adaptor
$frontMatter = new FrontMatter($jsonAdapter);

// sample json front matter
$fileContent = '---
{
    "title": "A Title",
    "slug": "a-slug",
    "created": "2017-01-01 12:00"
}
---
This is some sample content
';

// parse file contents
$document = $frontMatter->parse($fileContent);
```

Symfony Integration
-------------------

To enable symfony integration add the bundle to your kernel

```
new Tc\FrontMatter\Bridge\Symfony\TcFrontMatterBundle(),
```

Now you have access to the front matter service's:

- YAML `tc.front_matter` or `tc.front_matter.yaml`
- JSON `tc.front_matter.json`

Example:

```php
<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $file = file_get_contents('./path/to/front-matter-file');
        $document = $this->get('tc.front_matter')->parse($file);

        return $this->render('default/index.html.twig', [
            'content' => $document->getContent(),
            'data' => $document->getData()
        ]);
    }
}
```

Custom Adapters
---------------

You can create your own custom adapters to parse and dump front matter.

All you need to do is implement `Tc\FrontMatter\Adapter\AdapterInterface`

You can then create a new instance of front matter using your adapter. e.g.

```php
<?php

$myFrontMatter = new FrontMatter(new FooAdapter());
```

If you are using symfony you can register your adapters as a service,
and tag them. e.g.

```
foo_adapter:
    class: 'AppBundle\Adapter\FooAdapter'
    tags:
        - {name: tc.front_matter.adapter, adapter_name: foo}
```

The front matter bundle will then auto generate a front matter service for you: `tc.front_matter.foo`


License
-------

Tc Front Matter is licensed with the MIT license.

See LICENSE for more details.
