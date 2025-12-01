---
title: Sharp 9.10 brings major improvements to the Editor and more
description: >-
  Quick recap on all the new features added since version 9.5  
date: 2025-10-14
thumbnail: /assets/img/posts/sharp-9-10-brings-major-improvements-ti-the-editor-and-more/thumb.jpg
author: philippe
---

Since [this post on new features of Sharp 9.5](https://code16.fr/posts/notification-badges-and-more-in-sharp-9-5/), Sharp 9 development continued at a steady pace, bringing new features and improvements. Here’s a quick recap of the most notable changes.

## The Editor field is better than ever

The Editor field in Sharp 9 was already powerful: configurable toolbars, native image uploads, and full support for custom embeds made it a strong WYSIWYG option out of the box. We’ve made it even better:

- Added full-screen mode
- Custom embeds can now be copied, cut, pasted, or even drag-and-dropped
- Custom embeds can appear directly in the toolbar with their own icons
- Introduced *automatic text input replacements* (currently in beta for 9.10)

That last one is especially handy for writers — for example, French authors can now automatically insert non-breaking spaces around certain punctuation marks, or replace quotes `""` with guillemets `« »`:

```php
class PostForm extends SharpForm
{
    public function buildFormFields(FieldsContainer $formFields): void
    {
        $formFields
            ->addField(
                SharpFormEditorField::make('content')
                    ->setLabel('Post content')
                    ->setTextInputReplacements([
                        EditorTextInputReplacementPreset::frenchTypography(locale: 'fr', guillemets: true),
                    ])
                    ->allowFullscreen()
                    ->setHeight(300, 0)
            );
    }
    
    // ...
}
```

You can try all these new Editor features directly in the Post form on the [Sharp demo site](https://sharp.code16.fr/sharp/s-list/post).

## Live-refreshing HTML field

HTML fields [can now be live-refreshed](https://sharp.code16.fr/docs/guide/form-fields/html#setliverefresh-bool-liverefresh-true-array-linkedfields-null), to display some dynamic content based on other field values.

<video width="539" height="643" controls style="margin: 20px auto">
    <source src="/assets/img/posts/sharp-9-10-brings-major-improvements-ti-the-editor-and-more/html-live-refresh.mp4" type="video/mp4">
</video>

You can find the code behind this example in the [Sharp demo codebase](https://github.com/code16/sharp/blob/204cf99f0caf543ad4bdca6ef00e74ae25888fa0/demo/app/Sharp/Posts/PostForm.php#L117).

## Custom presets for DateRangeFilter

The `DateRangeFilter` was able to display a list of default presets (today, yesterday, last week, last month, etc.); its is now possible to mix these defaults with your own custom presets:

```php
class PeriodFilter extends DateRangeFilter
{
    public function buildFilterConfig(): void
    {
        $this->configureLabel('Period')
            ->configureShowPresets(presets: [
                DateRangePreset::thisMonth(),
                DateRangePreset::make(today()->subDays(3), today(), 'Last 3 days'),
            ]);
    }
}
```

See [related documentation](https://sharp.code16.fr/docs/guide/filters#configuration).

## Data sanitization for safer inputs

Sharp now lets you sanitize text field content before saving it to the database — a simple but effective way to prevent XSS attacks or remove unwanted HTML.

```php
class PostForm extends SharpForm
{
    public function buildFormFields(FieldsContainer $formFields): void
    {
        $formFields
            ->addField(
                SharpFormTextField::make('title')
                    ->setLabel('Title')
                    ->setSanitizeHtml()
                    ->setMaxLength(150)
            );
    }
    
    // ...
}
```

This security feature is also available for text fields on Show Pages.

## What’s next

We are not done with Sharp 9 features... in fact, a big one is coming: adding a possibility to embed Dashboards in Show Pages.

If you’d like to get involved, you’re welcome to join the [Discord server](https://discord.com/invite/sFBT5c3XZz), or to contribute directly on GitHub. And if you have questions or feedback, feel free to email me at philippe [at] code16.fr.

