---
title: A feature preview of Sharp 8.
description: >-
  Quick review on what’s coming on the next major version of Sharp 8 for Laravel. 
date: 2023-05-30
thumbnail: /assets/img/posts/a-feature-preview-of-sharp-8/thumbnail.png
author: philippe
---

We, at [Code 16](https://code16.fr), are currently developing on the next major version of [Sharp](https://sharp.code16.fr) for Laravel. Here’s a preview of some new features we’re working on:

## Bulk commands

This is a feature we’ve been asked for a long time... The idea is simple: to be able to select multiple instances in a list and to apply a command on them. We tried to keep thing really straightforward for the project code; here’s an example:

```php
class BulkPublishPostsCommand extends EntityCommand
{
    public function label(): ?string
    {
        return 'Publish all selected posts';
    }

    public function buildCommandConfig(): void
    {
        $this->configureDescription('Bulk command to publish posts')
            ->configureInstanceSelectionRequired();
    }

    public function execute(array $data = []): array
    {
        Post::whereIn('id', $this->selectedIds())
            ->get()
            ->each(fn (Post $post) => $post->update(['state' => 'published']));

        return $this->reload();
    }
}
```

The code needs two small changes to allow bulk selection:
 - First, add a `configureInstanceSelectionRequired()` call in the `buildCommandConfig()` method.
 - Then, in the `execute()` method, use the `selectedIds()` method to get the list of selected instances.

That’s it: Sharp will take this into account and add a “Select” button + checkboxes to pick instances in the list. We've added an alternative `configureInstanceSelectionAllowed()` to allow commands to be either called with a selection or on the whole (filtered) list, like in v7 and before.

## New dashboard layout (sections!)

Dashboards are pretty easy to create in Sharp, but sometimes they are difficult to organize: to tackle this we added a way to define sections, with titles — very much like we already do in Show Pages. Better, Sharp will allow to directly attach to section a command (also already available for Show Pages), and even a filter: we think it can clarify things a lot for the end user.

Here’s an example of a dashboard with sections, and with commands and a filter attached to the second:

![](/assets/img/posts/a-feature-preview-of-sharp-8/dashboard-sections.png)

The code should look familiar to anyone who already created a Show Page:

```php
class DemoDashboard extends SharpDashboard
{

    protected function buildWidgets(WidgetsContainer $widgetsContainer): void
    {
        // [...]
    }

    protected function buildDashboardLayout(DashboardLayout $dashboardLayout): void
    {
        $dashboardLayout
            ->addSection('Posts', function (DashboardLayoutSection $section) {
                // [...]
            })
            ->addSection('Stats', function (DashboardLayoutSection $section) {
                $section
                    ->setKey('stats-section')
                    ->addRow(function (DashboardLayoutRow $row) {
                        // [...]
                    });
            });
    }

    public function getFilters(): ?array
    {
        return [
            'stats-section' => [
                PeriodRequiredFilter::class,
            ],
        ];
    }

    public function getDashboardCommands(): ?array
    {
        return [
            'stats-section' => [
                ExportStatsAsCsvCommand::class,
            ],
        ];
    }

    // [...]
}
```

## UI improvements, and more

We also plan to improve the UI of Sharp, mainly regarding the top bar, the user menu and some button positions — but this is too WIP to show anything now.

On the small-but-useful side, we added a way to configure middleware used by Sharp, and a more elegant and quicker syntax to write an Entity List, with its columns and layout defined at the same time. We are planing more goodies, including a big one, but it’s too early to blog about that... 

As always, feel free to [catch me on twitter](https://twitter.com/dvlpp) for any comment or question on this.
