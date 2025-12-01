---
title: 'Bulk uploads in Sharp, the right way'
description: >-
  We just released version 6.3 of Sharp for Laravel, with a feature that was
  expected since a long time: the ability to upload multiple files…
date: 2021-06-13
thumbnail: /assets/img/posts/bulk-uploads-in-sharp-the-right-way/thumbnail.png
author: philippe
---

![](/assets/img/posts/bulk-uploads-in-sharp-the-right-way/thumbnail.png)

We just [released version 6.3](https://github.com/code16/sharp/releases/tag/v6.3.0) of [Sharp for Laravel](https://sharp.code16.fr), with a feature that was expected since a long time: the ability to upload multiple files at once.

This feature seems pretty straightforward, at first: it is very common and implemented in many CMS. But Sharp isn’t a CMS, really, so let’s start with what we didn’t want:

## Unwanted solution #1: add a “media library” of some kind

We could have a space somewhere where we can upload and organize files, to be afterwards browsed and chosen in entities. But this is not the way Sharp is designed: we don’t want to force any kind of organization, of data storage… Sharp is a tool that the developer can use the way he wants for the project he’s working on: and if he needs a root “media library” entity with files, browsable through an autocomplete elsewhere, and it can be built.

## Unwanted solution #2: add a new dedicated form field

A new form field seems to be a simple solution. Maybe it could be named`SharpFormUploadListField` , with an item which contains only one field, an Upload. After all, there is already a field like that, `SharpFormAutocompleteListField` (see [here](https://sharp.code16.fr/docs/guide/form-fields/autocomplete-list.html#autocompletelist)), but in fact the use case is very different. What if we need for each item a visual and a legend, which is a very common pattern? This would have been a solution quite easy to implement, but not very useful.

## Chosen solution: just add a configuration method

Finally, the held solution is to use a regular `SharpFormListField`, and to add a coupe of API methods to configure the bulk option:

```php
SharpFormListField::make("pictures")
  ->setLabel("Additional pictures")
  ->setRemovable()
  ->setSortable()
  ->setAddable()
  ->allowBulkUploadForField("file")
  ->setBulkUploadFileCountLimitAtOnce(6)
  ->setOrderAttribute("order")
  ->addItemField(
    SharpFormUploadField::make("file")
      ->setFileFilterImages()
      ->setStorageDisk("local")
      ->setStorageBasePath("data/Spaceship/{id}/Pictures")
      ->setMaxFileSize(3)
  )
  ->addItemField(
    SharpFormTextField::make("legend")
      ->setLabel("Legend")
  );
```    

The two important methods are:

*   `allowBulkUploadForField("file")`: the argument must be the key of an upload field of the item.
*   `setBulkUploadFileCountLimitAtOnce(6)`: optionally, we can set the limit on parallel uploads (default is 10).

And then, Sharp will render the list like this:

<p>
    <iframe src="https://giphy.com/embed/SntgQqMwbrw0ooRV5i" width="100%" height="350" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
</p>

This solution seems quite good to us, since it’s:

*   customizable: you could choose the upload field, it would work even for items with two uploads for instance.
*   Respecting Sharp way of doing things: from the Sharp project code perspective, the fact the user use bulk upload or not to fill is form does not change anything.
*   Backward compatible with previous configuration methods: max items count, file filters…
*   And very straightforward to use both as a Sharp developer and as a Sharp user, thanks to the work of [aguingand](https://github.com/aguingand) on the frond end code and UX.

The related [documentation is here](https://sharp.code16.fr/docs/guide/form-fields/list.html#allowbulkuploadforfield-string-itemfieldkey); if you need more information of Sharp itself, [start here](https://sharp.code16.fr), and as always feel free [to reach me on twitter](https://twitter.com/dvlpp) if you have questions or remarks.
