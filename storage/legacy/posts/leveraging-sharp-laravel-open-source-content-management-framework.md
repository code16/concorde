---
title: Leveraging Sharp, an open source content management framework, in a Laravel project
description: "A full tour of Sharp for Laravel"
thumbnail: /assets/img/posts/leveraging-sharp-laravel-open-source-content-management-framework/thumbnail2.png
date: 2022-05-25
author: philippe
---

*This article was published in the [German publication phpmagazin](https://entwickler.de/magazine-ebooks/php-magazin/php-magazin-42022), as a first look at Sharp. Since I think it’s a good introduction to the tool, I decided to publish it in this blog also.*

---

To state the obvious: content management is hard. For a typical web project, this applies to both sides: it can be difficult to build an adapted tool as a developer, and it is sometimes a pain to use it as a content manager. I think this is why Wordpress, along with smaller projects based on the same idea, were and still are very popular: it’s fairly easy for a developer to adapt to any type of content, and the client may already know the tool and feel comfortable with the interface. But these solutions come with a lot of drawbacks: a constrained data model, difficulties on maintenance and updates, the need to hijack the UI to match domain data, and… many more, to be honest.

## Sharp’s quick backstory

As many essential but hard to resolve topics, content management is addressed by a lot of packages, SaaS projects and tools. But when I met Laravel (it was in its early days, around version 3), the field was quite empty, and I felt the need to build something. The idea of Sharp was born, and to be clear it was at first very messy. I tried to create something that could apply to regular content websites and to management apps (CRM, ticketing systems…), and this was kind of working, but a pain to maintain and adapt to new versions of Laravel. I didn't give up though: after tons of refactorings and rewritings, and with the great help of others developers, we manage to publish a decent product around 2017 — it was Sharp 4, back then (current version in 7). We had right in the beginning four basic but crucial rules in mind:

- The public section of the website should not have any knowledge of Sharp: the tool is a part of the system, not the center of it. In fact, removing the tool should not have any effect on the project.
- Content administrators should work with their data and terminology, not CMS terms.
- Developers should not have to work on the front-end development for the CMS.
- The CMS should not have any expectations from the persistence layer.

Since the first version of Sharp, many things happen in the Laravel content management field: the emergence of great paid products ([Laravel Nova](https://nova.laravel.com), [Statamic](https://statamic.com), [October CMS](https://octobercms.com)…), or the rise of [headless CMS](https://en.wikipedia.org/wiki/Headless_content_management_system), among other things. But Sharp is still a very relevant choice to us (and others), being stable on its core rules, very flexible, fairly easy to work with as a non-technical user, allowing developers to quickly build complex and testable features, and, of course, being an open source and free package.

In our web company, we use it on almost all our projects: websites, mobile apps, SPA... Here's a few examples, illustrating the diversity of usages:

- in the e-commerce field, we developed in Sharp for a client a full product and order management, allowing partial changes and state updates, preserving full history, syncing with external APIs, presenting sales and todo dashboards, managing the actual website content, and more.
- We had to develop websites really focused on the frontend, with various types of content (images, videos, external embeds, rich texts...): for this kind of projects, Sharp 7's new Editor field is a bless.
- For mobile apps which require an API, Sharp is leveraged to handle the content, sometimes to keep track of connections, or to handle API keys.
- We also use Sharp as a side tool, to quickly add a way to handle users, permissions or configuration on existing apps which already had an admin section less flexible.

To present Sharp, I think the best way is to go through an example; and even if we miss and ignore a lot of features in the process, it may be more helpful to actually see code rather than read a feature list.

## Diving in! first step, list things

If you install [code16/sharp](https://github.com/code16/sharp) on your Laravel Project (as a composer dependency), the only thing you’ll get is a new `/sharp` route, with a login form. Everything after this login must be configured and developed, leveraging Sharp’s API.

Here's our scenario: we are asked to present on a website the products of a local shop. The product listing comes from an external feed provided by some inventory management software. We must display in the admin section of the website the detailed product list (ref, price, whatever). For this, we are going to declare a `ProductEntity` (in Sharp, an Entity is a manageable thing; it’s typically a Model, but it can be anything), and develop a `ProductList`.

```php
class ProductEntity extends \Code16\Sharp\Utils\Entities\SharpEntity
{
  protected ?string $list = ProductList::class;
}
```

The `ProductList` code could be written like this:

```php
// use statements striped for readability

class ProductList extends SharpEntityList
{
  public function __construct(protected ProductApiClient $productApiClient)
  {
  }
  
  public function buildListConfig(): void
  {
    $this->configureDefaultSort('reference');
  }

  protected function buildListFields(EntityListFieldsContainer $fieldsContainer): void
  {
    $fieldsContainer
      ->addField(
        EntityListField::make('reference')
            ->setLabel('Ref.')
            ->setSortable(),
      )
      ->addField(
        EntityListField::make('name')
            ->setLabel('Name'),
      )
      ->addField(
        EntityListField::make('price')
            ->setLabel('Price')
            ->setSortable(),
      );
  }

  protected function buildListLayout(EntityListFieldsLayout $fieldsLayout): void
  {
    $fieldsLayout
      ->addColumn('ref', 2)
      ->addColumn('name', 6)
      ->addColumn('price', 4);
  }

  public function getListData(): array|Arrayable
  {
    return $this
      ->setCustomTransformer('price', function($value, $product) {
        return "€ " . number_format($value, 2);
      })
      ->transform(
        $this->productApiClient->fetchProducts([
          'sort' => [
            $this->queryParams->sortedBy(), 
            $this->queryParams->sortedDir()
          ]
        ])
      );
  }
}
```

Let's review this code with a quick breakdown:

- `buildListField()` and `buildListLayout()` contains the structure, and how we present it; in this case, this is a list, therefore fields are columns: we declare three of them, two of which are `sortable`.
- `getListData()` does the hard work: this method must return an array version of each product, in a global array (or a Paginator, which obviously would be pertinent here, but let's keep it simple). Here we use some `ProductApiClient` injected in the constructor (this class is supposed to call the external inventory management software), passing a `$sort` parameter retrieved via `$this->queryParams`, which is an object that Sharp  keep in sync with the user request. Also note that we make use of a transformation API built in Sharp which simplifies the work in many ways.

With this, our list is working. In real world, beside pagination, we would add a search field to quickly find a product, and filters to maybe only show sale products, or out-of-stock ones: all of this is quite simple to implement.

<img width="1115" alt="list" src="https://user-images.githubusercontent.com/973325/159024834-d9b0fe15-9219-488f-94b9-3c17f6fdb1fc.png">

I also choose to skip how the menu on the left is built, as it's pretty straightforward, and we have more to see.

## Building a form to update a Product

The project evolves, and now we must provide a way to partially update products in the website: a detailed description and a list of visuals. To this end, we made the decision to replace our simple `ProductApiClient` with a more sophisticated scheduled job which would fill a local products table in the project database. This means we now have a `Product` Model.

In the `ProductList`, we now leverage Eloquent to fetch our products. This should only change the `getListData()` code:

```php
class ProductList extends SharpEntityList
{
  // [...]

  public function getListData(): array|Arrayable
  {
    return $this
      ->setCustomTransformer('price', function($value, $product) {
        return "€ " . number_format($value, 2);
      })
      ->transform(
        Product::query()
          ->orderBy($this->queryParams->sortedBy(), $this->queryParams->sortedDir())
          ->get()
      );
  }
}
```

Once again, in the real world, we would probably add a column with the visuals, and an excerpt of the product description, maybe under the name. Anyway, here's the code of the `ProductForm` implementation, in charge of displaying the update form and, of course, updating the Product:

```php
class ProductForm extends SharpForm
{
  use WithSharpFormEloquentUpdater;

  public function buildFormFields(FieldsContainer $formFields): void
  {
    $formFields
      ->addField(
        SharpFormEditorField::make('description')
          ->setLabel('Web description')
          ->setToolbar([
              SharpFormEditorField::B,
              SharpFormEditorField::I,
          ])
      );
  }

  public function buildFormLayout(FormLayout $formLayout): void
  {
    $formLayout
      ->addColumn(6, function (FormLayoutColumn $column) {
        $column->withSingleField('description');
      });
  }

  public function find(mixed $id): array
  {
    return $this->transform(
      Product::findOrFail($id)
    );
  }

  public function update(mixed $id, array $data)
  {
    $this->save(Product::findOrFail($id), $data);
    return $id;
  }

  public function delete(mixed $id): void
  {
    throw new SharpApplicativeException('Not allowed');
  }
}

```

The code should be pretty much self-explanatory, since Sharp try to expose a descriptive API.

Notice that we use a special `$this->save()` method, provided by the optional `WithSharpFormEloquentUpdater` trait, which handles all the store / update stuff, if the data is an Eloquent model; this includes all relations, of any type. This powerful help is only available for Eloquent, and of course you can ignore it any other case and write your own update code.

I reduced this example to only one field, to keep the code short; here's the result with just two other fields:

<img width="1115" alt="form" src="https://user-images.githubusercontent.com/973325/159252999-b818ee45-a351-4152-b989-e81d002eb79a.png">

## Write commands to implement functional tasks

Commands are a powerful way to expose functional tasks to the user, either for an instance, a selection of instances or at entity level. In this last scope, let's define a command to manually trigger the product synchronization (from the fictional external API):

```php
class SynchronizeProducts extends EntityCommand
{
  public function buildCommandConfig(): void
  {
    $this->configureConfirmationText('Launch a product synchronization, as a background task?');
  }

  public function label(): ?string
  {
    return 'Synchronize products...';
  }

  public function execute(array $data = []): array
  {
    ProductSynchronizer::dispatch();
    
    return $this->info('Synchronization queued. Should be finished in a few minutes.');
  }
}
```

The command code must implement an `execute()` method, which calls some `ProductSynchronizer` job from the project codebase (Sharp's commands should rely on the codebase when possible, to avoid repetitions and to benefit from a code which may already be tested). This method has an optional `$data` argument, filled by Sharp when the command defines a form; in fact, let's write one, to be able to add a precision on what products should be concerned:

```php
class SynchronizeProducts extends EntityCommand
{
  // [...]

  public function buildFormFields(FieldsContainer $formFields): void
  {
    $formFields
      ->addField(
        SharpFormCheckField::make('all', 'Sync all products')
      )
      ->addField(
        SharpFormDateField::make('start')
          ->setLabel('Sync products updated after')
          ->addConditionalDisplay('!all')
      );
  }

  public function execute(array $data = []): array
  {
    $this->validate($data, [
      'start' => [
        'required_if:all,false',
        'after:now',
      ]
    ]);

    ProductSynchronizer::dispatch($data['all'] ? null : $data['start']);

    return $this->info('Synchronization queued. Should be finished in a few minutes.');
  }
}
```

Now we can type a start date and pass it to the job, to be used as a starting point for synchronization. As you can see, forms in command are declared with the same API seen before, and are equally powerful. For demonstration purpose, I added a conditional display on the date field, based on the check, and some validation before executing the task.

The next step is to declare this command in our List:

```php
class ProductList extends SharpEntityList
{
  // [...]

  protected function getEntityCommands(): ?array
  {
    return [
      SynchronizeProducts::class,
    ];
  }

  // [...]
}
```

And here's the result:

<img width="1148" alt="command-form" src="https://user-images.githubusercontent.com/973325/159680218-fe85782e-201b-49a5-b9c6-3e218380ffb6.png">

We can restrict this command to some users, via authorizations, but I've chosen to keep this aside for now.

Another common use case in website administration is to provide a way to preview an entity, to prepare its publication. Let's see how we can implement this, as an instance command this time, for a Product:

First write the command:

```php
class PreviewProduct extends InstanceCommand
{
  public function label(): ?string
  {
    return 'Preview...';
  }
  
  public function execute(mixed $instanceId, array $data = []): array
  {
    return $this->view('products.show', [
      'product' => Product::find($instanceId)
    ]);
  }
}
```

Note that the `$instanceId` parameter is available, in case of an instance command, and that we return `$this->view()` here: a command can display a message or a full view, reload partially or entirely the current list, or even return a file, as a stream or a download.
We need then to attach the command to the products list, very much like before:

```php
class ProductList extends SharpEntityList
{
  // [...]

  protected function getInstanceCommands(): ?array
  {
    return [
      PreviewProduct::class
    ];
  }

  // [...]
}
```

And with that we now have a simple way to preview a product. A third useful command would be to allow to change a product publication state (online / draft for instance): this is typically handled via a `StateHandler` implementation in Sharp, but as this is quite similar let's skip this part and move on to a whole new feature: show pages.

## Create a show page for Orders

Of course Order instances will be created, in an e-commerce project, by customers in the public section of the website. In the admin section, we will need a paginated list of them, plus a detailed page for each one with customer details, ordered products... In Sharp, this detailed page is named a Show page, and can look like this:

<img width="1148" alt="order-show" src="https://user-images.githubusercontent.com/973325/159716471-626b5673-0cc3-4a53-928b-940cb19a13b8.png">

Here's the full code for this page (like before, this is very educational code, and very not production ready code):

```php
class OrderShow extends SharpShow
{
  protected function buildShowFields(FieldsContainer $showFields): void
  {
    $showFields
      ->addField(
        SharpShowTextField::make('ref')
          ->setLabel('Reference')
      )
      ->addField(
        SharpShowTextField::make('created_at')
          ->setLabel('Date')
      )
      ->addField(
        SharpShowTextField::make('customer:name')
          ->setLabel('Name')
      )
      ->addField(
        SharpShowTextField::make('customer:email')
          ->setLabel('Email')
      )
      ->addField(
        // [...] More fields, cut for brevity
      )
      ->addField(
        SharpShowEntityListField::make('rows', 'product')
          ->setLabel('Rows')
          ->showCreateButton(false)
          ->hideEntityCommand([SynchronizeProducts::class])
          ->hideFilterWithValue('order', function ($instanceId) {
            return $instanceId;
          })
      );
  }

  public function buildShowConfig(): void
  {
  }

  protected function buildShowLayout(ShowLayout $showLayout): void
  {
    $showLayout
      ->addSection('Order', function (ShowLayoutSection $section) {
        $section
          ->addColumn(6, function (ShowLayoutColumn $column) {
            $column
              ->withSingleField('ref')
              ->withSingleField('created_at');
          })
          ->addColumn(6, function (ShowLayoutColumn $column) {
            $column
              ->withFields('total|6', 'shipping_cost|6');
          });
      })
      ->addSection('Customer', function (ShowLayoutSection $section) {
          // [...] More fields, cut for brevity
      })
      ->addEntityListSection('rows');
  }

  protected function find(mixed $id): array
  {
    return $this
      ->setCustomTransformer('created_at', function ($value, Order $order) {
        return $order->created_at->isoFormat('LLLL');
      })
      ->transform(Order::findOrFail($id));
  }
}
```

For the `SharpShowEntityListField`, which is responsible for displaying the rows sublist, we re-use the already implemented "product" list simply adding an "order" filter (which must be now added as a where clause in the product list's query).

In a real world application, we probably would not be able to do that, we'll need for this at least a pivot table, but that's not the point: with this kind of pages, you can provide to your users good-looking detailed pages with embedding sublists, which have the same functionalities as regular lists: you can navigate through them (and take advantage of the breadcrumb) to another show or form, add entity or instance commands, filters, search field...

## Add a Dashboard to track activity

As a final step in this educational project, we could add a welcome dashboard, mixing quick-links for current required tasks and stats:

<img width="1187" alt="dashboard" src="https://user-images.githubusercontent.com/973325/159724287-27139de7-2630-4bc9-b871-65cbc1c5a30f.png">
(This screenshot was taken (and edited) from a real project, to explain the changes on the left menu.)

The code is similar to a Show page, so I will spare you the details. Here's a small sample to show how to easily add a panel with a count and a custom link to some page (a list, here):

```php
class Dashboard extends SharpDashboard
{
  protected function buildWidgets(WidgetsContainer $widgetsContainer): void
  {
    $widgetsContainer
      ->addWidget(
          SharpPanelWidget::make('incoming_orders')
            ->setInlineTemplate('<h1>{{count}}</h1> incoming orders')
            ->setLink(
              LinkToEntityList::make('orders')
                ->addFilter(StateFilter::class, 'ongoing')
                ->setSort('created_at', 'desc')
            )
      );
      
    // [...]
  }
  // [...]
}
```

Dashboards can include filters and commands: a common use case is to add a command to download a CSV version of the figures, for instance.

## So what have we learned?

With that we implemented a basic CRUD, added functional commands to work with products, developed a page to manage orders, and a dashboard to present aggregated data; all of this was done respecting our 4 initial rules: no code adherence between website and CMS, clean terminology, no front-end development, and free choice of persistence layer — using a clean and documented API. Many features were ignored in this article (data localization, authorizations and policies, wizard commands, editor field with custom embeds, custom test assertions...), but I feel this is already a big introduction to the tool.

Laravel is a very (very) great framework, in many aspects; one of them is that it's a good fit for almost any type of projects, small or big, with a web frontend or JSON based... Sharp tries to be similar on this point, as a general purpose tool with built-in fast paths for standard needs. I think the real big advantage of Sharp comes with a bit of experience, and that's productivity: at some point it is fast to build complex features on top of a simple CRUD, mainly focusing of the functionality itself, without losing control over the code nor compromising the project architecture, thanks to a solid front-end code and clear and documented APIs. And because it features a simple and consistent UI (yes, you can change that blue color and add your logo), the administrators and content managers will also hopefully appreciate Sharp.

You can find a complete documentation and a fully testable demo on [Sharp's website](https://sharp.code16.fr), and all its code is available on [Github](https://github.com/code16/sharp). The code of the example developed for this article is not available (it's too messy, to be honest), but if you want you can browse the code of a more complete demo project directly in Sharp's repository, under the `demo` folder.

